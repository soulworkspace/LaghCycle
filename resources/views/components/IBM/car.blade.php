@props(['ad'])

@php
    $adAttributes = $ad->attributes ?? collect();
    $attributeValue = fn (string $name) => $adAttributes->firstWhere('name', $name)?->pivot?->value;
    $isBicycle = $ad->category?->type === 'bicycle';
    $year = $attributeValue('year');
    $engineCc = $attributeValue('engine_cc');
    $transmission = $attributeValue('transmission');
    $fuelType = $attributeValue('fuel_type');
    $powerLabel = $isBicycle
        ? ($transmission ?: ($fuelType === 'electric' ? 'كهربائية' : 'هوائية'))
        : ($engineCc ? $engineCc . ' CC' : match ($transmission) {
            'automatic' => 'أوتوماتيك',
            'manual' => 'عادي',
            'semi-automatic' => 'نصف أوتوماتيك',
            default => 'غير محدد',
        });
    $energyLabel = match ($fuelType) {
        'gasoline' => 'بنزين',
        'electric' => 'كهربائية',
        'none' => 'هوائية',
        default => 'غير محدد',
    };

    // استخراج رابط الصورة الرئيسية
    $mainImageUrl = null;

    if ($ad->relationLoaded('images') && $ad->images->isNotEmpty()) {
        $firstImg = $ad->images->first();
        $path = trim((string) ($firstImg->image_path ?? ''));

        if (!blank($path)) {
            if (filter_var($path, FILTER_VALIDATE_URL)) {
                $mainImageUrl = $path;
            } elseif (Storage::disk('public')->exists($path)) {
                $mainImageUrl = Storage::disk('public')->url($path);
            } elseif (str_starts_with($path, 'storage/')) {
                $mainImageUrl = asset($path);
            } else {
                $mainImageUrl = asset('storage/' . ltrim($path, '/'));
            }
        }
    }

    $fallbackImg = asset('cover.jpg');
    $finalImg = $mainImageUrl ?? $fallbackImg;

    // تنظيف العنوان لمنع تكرار كلمة "دراجة" أو "سكوتر"
    $cleanTitle = preg_replace('/^(دراجة|سكوتر)\s+/ui', '', trim($ad->title));
@endphp

<div class="vehicle-card bg-white rounded-12 border overflow-hidden h-100 d-flex flex-column transition-all w-100 shadow-sm" dir="rtl">
    
    {{-- Container الصورة والشارات --}}
    <div class="card-img-wrapper position-relative overflow-hidden" style="aspect-ratio: 16 / 10; background-color: #121212;">
        <img src="{{ $finalImg }}" 
             alt="{{ $cleanTitle }}" 
             loading="lazy" 
             onerror="this.onerror=null; this.src='{{ $fallbackImg }}';"
             class="w-100 h-100 vehicle-img"
             style="object-fit: cover; transition: transform 0.4s ease;">

        {{-- شارة حالة الدراجة --}}
        @if($ad->condition)
            <span class="badge position-absolute" style="top: 12px; right: 12px; background: rgba(18, 18, 18, 0.88); color: #C5A059; border: 1px solid rgba(197, 160, 89, 0.4); font-weight: 700; padding: 6px 12px; border-radius: 6px; font-size: 11px;">
                {{ $ad->condition === 'new' ? 'جديدة (0 كم)' : ($ad->condition === 'used' ? 'مستعملة' : $ad->condition) }}
            </span>
        @endif

        {{-- شارة السعر --}}
        <div class="position-absolute bottom-0 start-0 m-2 px-3 py-1 rounded-6 text-white font-weight-bold shadow-sm" style="background: linear-gradient(135deg, #121212, #2A2A2A); font-size: 13px; border: 1px solid rgba(197, 160, 89, 0.3); color: #C5A059 !important;">
            {{ $ad->price !== null ? number_format((float) $ad->price, 0, '.', ' ') . ' د.ج' : 'عند الطلب' }}
        </div>
    </div>

    {{-- تفاصيل الدراجة --}}
    <div class="card-body p-3 d-flex flex-column justify-content-between flex-grow-1">
        <div>
            {{-- شارة معرّض Laghouat Cycle --}}
            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="font-weight-bold px-2 py-1 rounded-4" style="font-size: 11px; color: #8C6D37; background-color: rgba(197, 160, 89, 0.12); border: 1px solid rgba(197, 160, 89, 0.25);">
                    <i class="fa-solid {{ $isBicycle ? 'fa-bicycle' : 'fa-motorcycle' }} ms-1"></i> Laghouat Cycle
                </span>
                @if($ad->city)
                    <span class="text-muted small" style="font-size: 11px;">
                        <i class="fa-solid fa-location-dot text-danger ms-1"></i>{{ $ad->city }}
                    </span>
                @endif
            </div>

            {{-- عنوان الدراجة --}}
            <h5 class="font-weight-bold mb-3 text-dark mt-2" style="font-size: 15px; line-height: 1.4; height: 42px; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
                <a href="{{ route('ads.show', $ad->slug) }}" class="text-dark text-decoration-none card-title-hover">
                    {{ $cleanTitle }}
                </a>
            </h5>

            {{-- شريط المواصفات السريعة --}}
            <div class="d-flex align-items-center justify-content-between text-muted py-2 px-2 rounded-8 mb-3" style="background: #F8FAFC; border: 1px solid #E2E8F0; font-size: 12px; font-weight: 600;">
                <div title="سنة الصنع">
                    <i class="fa-regular fa-calendar-alt text-warning ms-1" style="color: #C5A059 !important;"></i>
                    <span>{{ $year ?? 'غير محدد' }}</span>
                </div>
                <div title="{{ $isBicycle ? 'عدد السرعات' : 'سعة المحرك' }}">
                    <i class="fa-solid fa-gauge-high text-warning ms-1" style="color: #C5A059 !important;"></i>
                    <span>{{ $powerLabel }}</span>
                </div>
                <div title="{{ $isBicycle ? 'نوع الدراجة' : 'نوع المحرك' }}">
                    <i class="fa-solid fa-bolt text-warning ms-1" style="color: #C5A059 !important;"></i>
                    <span>{{ $energyLabel }}</span>
                </div>
            </div>
        </div>

        {{-- زر التفاصيل --}}
        <div class="pt-2 border-top d-flex align-items-center justify-content-between mt-auto">
            <a href="{{ route('ads.show', $ad->slug) }}" class="btn btn-sm w-100 py-2 font-weight-bold d-flex align-items-center justify-content-center gap-2 btn-cycle-details">
                <span>عرض التفاصيل الكاملة</span>
                <i class="fa-solid fa-arrow-left" style="font-size: 11px;"></i>
            </a>
        </div>
    </div>
</div>

<style>
    .rounded-12 { border-radius: 12px !important; }
    .rounded-8 { border-radius: 8px !important; }
    .rounded-6 { border-radius: 6px !important; }
    .rounded-4 { border-radius: 4px !important; }

    .vehicle-card {
        border-color: #E2E8F0 !important;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .vehicle-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 25px rgba(0, 0, 0, 0.15) !important;
        border-color: #C5A059 !important;
    }
    .vehicle-card:hover .vehicle-img {
        transform: scale(1.06);
    }
    .card-title-hover:hover {
        color: #C5A059 !important;
    }
    .btn-cycle-details {
        background: #121212;
        color: #C5A059;
        border: 1px solid #C5A059;
        border-radius: 8px;
        font-size: 13px;
        transition: all 0.2s ease;
    }
    .btn-cycle-details:hover {
        background: #C5A059;
        color: #121212;
    }
</style>