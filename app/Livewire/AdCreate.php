<?php

namespace App\Livewire;

use App\Models\Ad;
use App\Models\Attribute as AdAttribute;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithFileUploads;

class AdCreate extends Component
{
    use WithFileUploads;

    public string $title = '';
    public ?int $category_id = null;
    public ?int $year = null;
    public string $description = '';
    public ?float $price = null;
    public string $price_type = 'fixed';
    public string $condition = 'used';
    public string $mileage = '';
    public string $transmission = '';
    public string $fuel_type = 'gasoline';
    public string $engine_cc = ''; // تمت إضافة سعة المحرك هنا
    public string $city = '';
    public string $location = '';
    public string $contact_phone = '';
    public string $contact_whatsapp = '';
    public array $images = [];
    public int $primaryImage = 0;
    public $categories;

    protected function rules(): array
    {
        $categoryType = $this->selectedCategoryType;
        $isMotorcycle = $categoryType === 'motorcycle';
        $fuelTypes = match ($categoryType) {
            'bicycle' => ['none', 'electric'],
            'motorcycle' => ['gasoline', 'electric'],
            default => ['gasoline', 'electric', 'none'],
        };

        return [
            'title' => ['required', 'string', 'max:255'],
            'category_id' => [
                'required',
                'integer',
                Rule::exists('categories', 'id')
                    ->where('is_active', true)
                    ->whereNotNull('parent_id')
                    ->whereIn('type', ['bicycle', 'motorcycle']),
            ],
            'year' => ['required', 'integer', 'min:1900', 'max:' . (now()->year + 1)],
            'description' => ['required', 'string', 'min:10'],
            'price' => ['nullable', 'numeric', 'min:0'],
            'price_type' => ['required', 'in:fixed,negotiable,free'],
            'condition' => ['required', 'in:new,used,refurbished'],
            'mileage' => [$isMotorcycle ? 'required' : 'nullable', 'integer', 'min:0', 'max:2000000'],
            'transmission' => $isMotorcycle
                ? ['required', Rule::in(['automatic', 'manual', 'semi-automatic'])]
                : ['nullable', 'string', 'max:50'],
            'fuel_type' => ['required', Rule::in($fuelTypes)],
            'engine_cc' => ['nullable', 'integer', 'min:1', 'max:3000'],
            'city' => ['nullable', 'string', 'max:100'],
            'location' => ['nullable', 'string', 'max:255'],
            'contact_phone' => ['nullable', 'string', 'max:20'],
            'contact_whatsapp' => ['nullable', 'string', 'max:20'],
            'images' => ['required', 'array', 'min:1', 'max:12'],
            'images.*' => ['file', 'max:5120', 'mimes:jpg,jpeg,png,webp,gif,heic,svg,avif'],
        ];
    }

    public function mount(): void
    {
        $this->categories = Category::active()
            ->root()
            ->whereIn('type', ['bicycle', 'motorcycle'])
            ->with(['children' => fn ($query) => $query->active()->orderBy('sort_order')])
            ->orderBy('sort_order')
            ->get();
    }

    #[Computed]
    public function selectedCategoryType(): ?string
    {
        return Category::query()
            ->whereKey($this->category_id)
            ->where('is_active', true)
            ->whereNotNull('parent_id')
            ->whereIn('type', ['bicycle', 'motorcycle'])
            ->value('type');
    }

    public function updatedCategoryId(): void
    {
        $this->resetValidation(['category_id', 'engine_cc', 'fuel_type', 'mileage', 'transmission']);

        if ($this->selectedCategoryType === 'bicycle') {
            $this->engine_cc = '';
            $this->fuel_type = 'none';
            $this->transmission = '';
        } elseif ($this->selectedCategoryType === 'motorcycle') {
            $this->fuel_type = 'gasoline';
            $this->transmission = 'manual';
        }
    }

    public function updatedImages(): void
    {
        $this->validateOnly('images');
        $this->primaryImage = min($this->primaryImage, max(count($this->images) - 1, 0));
    }

    public function removeImage(int $index): void
    {
        if (! array_key_exists($index, $this->images)) {
            return;
        }

        unset($this->images[$index]);
        $this->images = array_values($this->images);
        $this->primaryImage = $this->images === [] ? 0 : min($this->primaryImage, count($this->images) - 1);
    }

    public function setPrimaryImage(int $index): void
    {
        if (array_key_exists($index, $this->images)) {
            $this->primaryImage = $index;
        }
    }

    public function save(): mixed
    {
        $validated = $this->validate();
        $user = auth()->user();

        if (! $user->canCreateMoreAds()) {
            $this->addError('title', 'لقد وصلت إلى الحد الأقصى من الإعلانات المسموح بها.');
            return null;
        }

        if ($validated['price_type'] !== 'free' && $validated['price'] === null) {
            throw ValidationException::withMessages(['price' => 'يرجى إدخال السعر أو اختيار بدون سعر.']);
        }

        $category = Category::query()
            ->whereKey($validated['category_id'])
            ->where('is_active', true)
            ->whereNotNull('parent_id')
            ->whereIn('type', ['bicycle', 'motorcycle'])
            ->firstOrFail();

        $ad = DB::transaction(function () use ($validated, $user, $category) {
            $ad = Ad::create([
                'title' => $validated['title'],
                'category_id' => $validated['category_id'],
                'description' => $validated['description'],
                'price' => $validated['price_type'] === 'free' ? null : $validated['price'],
                'price_type' => $validated['price_type'],
                'condition' => $validated['condition'],
                'city' => $validated['city'] ?: null,
                'location' => $validated['location'] ?: null,
                'contact_phone' => $validated['contact_phone'] ?: null,
                'contact_whatsapp' => $validated['contact_whatsapp'] ?: null,
                'user_id' => $user->id,
                'store_id' => $user->store?->id,
                'status' => 'pending',
                'template' => $category->type,
            ]);

            foreach ($this->images as $index => $image) {
                $path = $image->store('ads/' . $ad->id, 'public');
                $ad->images()->create([
                    'image_path' => $path,
                    'original_name' => $image->getClientOriginalName(),
                    'mime_type' => $image->getMimeType(),
                    'file_size' => $image->getSize(),
                    'is_primary' => $index === $this->primaryImage,
                    'sort_order' => $index,
                ]);
            }

            $attributes = [
                'year' => $validated['year'],
                'mileage' => $validated['mileage'],
                'transmission' => $validated['transmission'],
                'fuel_type' => $validated['fuel_type'],
                'engine_cc' => $category->type === 'motorcycle' ? $validated['engine_cc'] : null,
            ];

            foreach ($attributes as $name => $value) {
                if (!empty($value)) {
                    $attribute = AdAttribute::firstOrCreate(
                        ['category_id' => $validated['category_id'], 'name' => $name],
                        ['label' => ucfirst(str_replace('_', ' ', $name)), 'type' => 'text']
                    );
                    $ad->attributes()->syncWithoutDetaching([$attribute->id => ['value' => (string) $value]]);
                }
            }

            return $ad;
        });

        return redirect()->route('ads.show', $ad->slug)->with('success', 'تم إرسال الإعلان للمراجعة بنجاح.');
    }

    public function render()
    {
        return view('livewire.ad-create');
    }
}