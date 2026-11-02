@extends('layouts.main')

@section('title', 'دراجاتي - Laghouat Cycle')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex items-center justify-between mb-8">
        <h1 class="text-3xl font-black">دراجاتي</h1>
        <a href="{{ route('ads.create') }}" class="btn-premium px-6 py-3 rounded-xl">
            <i class="fa-solid fa-motorcycle ml-2"></i> إضافة دراجة جديدة
        </a>
    </div>

    @if($ads->count() > 0)
        <div class="card overflow-hidden">
            <table class="w-full">
                <thead class="bg-white/5">
                    <tr>
                        <th class="px-4 py-4 text-right font-bold">الدراجة</th>
                        <th class="px-4 py-4 text-right font-bold">السعر</th>
                        <th class="px-4 py-4 text-right font-bold">الحالة</th>
                        <th class="px-4 py-4 text-right font-bold">المشاهدات</th>
                        <th class="px-4 py-4 text-right font-bold">تاريخ النشر</th>
                        <th class="px-4 py-4 text-right font-bold">الإجراءات</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @foreach($ads as $ad)
                        <tr class="hover:bg-white/5 transition-colors">
                            <td class="px-4 py-4">
                                <div class="flex items-center gap-3">
                                    <img src="{{ $ad->primary_image_url }}"
                                         alt="{{ $ad->title }}" class="w-12 h-12 object-cover rounded-lg">
                                    <div>
                                        <p class="font-bold">{{ $ad->title }}</p>
                                        <p class="text-sm text-gray-500">{{ $ad->category?->name }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-4 text-emerald-400 font-bold">{{ number_format($ad->price, 0) }} د.ج</td>
                            <td class="px-4 py-4">
                                <span class="badge {{ $ad->status == 'active' ? 'badge-emerald' : ($ad->status == 'pending' ? 'badge-amber' : 'badge-rose') }}">
                                    {{ $ad->status == 'active' ? 'نشطة' : ($ad->status == 'pending' ? 'قيد المراجعة' : ($ad->status == 'rejected' ? 'مرفوضة' : $ad->status)) }}
                                </span>
                            </td>
                            <td class="px-4 py-4">{{ $ad->views_count }}</td>
                            <td class="px-4 py-4 text-sm text-gray-500">{{ $ad->created_at->format('Y-m-d') }}</td>
                            <td class="px-4 py-4">
                                <div class="flex gap-3">
                                    <a href="{{ route('ads.show', $ad->slug) }}" class="text-blue-400 hover:text-blue-300" title="عرض">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    <a href="{{ route('ads.edit', $ad) }}" class="text-amber-400 hover:text-amber-300" title="تعديل">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>
                                    <form action="{{ route('ads.destroy', $ad) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-rose-400 hover:text-rose-300" onclick="return confirm('هل أنت متأكد من حذف هذه الدراجة؟')" title="حذف">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-6">
            {{ $ads->links() }}
        </div>
    @else
        <div class="card p-12 text-center">
            <div class="w-20 h-20 rounded-full bg-emerald-500/10 flex items-center justify-center mx-auto mb-4">
                <i class="fa-solid fa-bicycle text-emerald-400 text-3xl"></i>
            </div>
            <h3 class="text-xl font-bold mb-2">لا توجد دراجات مضافة</h3>
            <p class="text-gray-500 mb-6">لم تقم بنشر أي إعلان لدراجة بعد على Laghouat Cycle</p>
            <a href="{{ route('ads.create') }}" class="btn-premium px-8 py-3 rounded-xl inline-block">
                إضافة دراجة جديدة
            </a>
        </div>
    @endif
</div>
@endsection