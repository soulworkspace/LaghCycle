<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use App\Models\Ad;
use App\Models\Category;

class AdListing extends Component
{
    use WithPagination;

    #[Url(except: '')]
    public $search = '';

    #[Url(except: null)]
    public $category = null;

    #[Url(except: null)]
    public $minPrice = null;

    #[Url(except: null)]
    public $maxPrice = null;

    #[Url(except: null)]
    public $city = null;

    #[Url(except: null)]
    public $condition = null;

    #[Url(except: 'latest')]
    public $sortBy = 'latest';

    public function mount(string $slug): void
    {
        $this->category = $slug;
    }

    public function updated($propertyName)
    {
        if (in_array($propertyName, ['search', 'category', 'minPrice', 'maxPrice', 'city', 'condition', 'sortBy'])) {
            $this->resetPage();
        }
    }

    #[Layout('layouts.app')]
    public function render()
    {
        // 1. بناء الاستعلام الأساسي
        $query = Ad::active()
            ->when($this->search, fn($q) => $q->where('title', 'like', '%' . $this->search . '%'))
            ->when($this->category, fn($q) => $q->whereHas('category', fn($sq) => $sq
                ->where('slug', $this->category)
                ->orWhereHas('parent', fn($parent) => $parent->where('slug', $this->category))))
            ->when($this->minPrice, fn($q) => $q->where('price', '>=', $this->minPrice))
            ->when($this->maxPrice, fn($q) => $q->where('price', '<=', $this->maxPrice))
            ->when($this->city, fn($q) => $q->where('city', $this->city))
            ->when($this->condition, fn($q) => $q->where('condition', $this->condition));

        // 2. الترتيب
        $query = match($this->sortBy) {
            'price_asc'  => $query->orderBy('price', 'asc'),
            'price_desc' => $query->orderBy('price', 'desc'),
            'oldest'     => $query->oldest(),
            default      => $query->latest(),
        };

        // 3. جلب البيانات الحقيقية
        $ads = $query->with(['category', 'user', 'images', 'attributes:id,name,label'])->paginate(30);

        return view('livewire.ad-listing', [
            'ads' => $ads,
            'categories' => Category::root()->active()->menu()->get(),
        ]);
    }
}