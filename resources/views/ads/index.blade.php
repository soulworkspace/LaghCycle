@extends('layouts.app')

@section('title', 'معرض الدراجات والسكوترات | Laghouat Cycle')

@section('content')
<section class="car-shop-section spad position-relative overflow-hidden" dir="rtl" style="background: #080C0E; color: #f4f7f8; min-height: 100vh;">
    
    {{-- إضاءة خلفية هادئة (Ambient Background Glow) --}}
    <div class="position-absolute top-0 start-50 translate-middle-x w-100 h-100 opacity-25 pointer-events-none" 
         style="background: radial-gradient(circle at 50% 20%, rgba(197, 160, 89, 0.15) 0%, transparent 70%);"></div>

    <div class="container position-relative z-1 py-4">
        
        {{-- Header & Total Count --}}
        <div class="row align-items-center mb-4">
            <div class="col-lg-8 col-md-8 text-center text-md-start">
                <div class="section-title">
                    <span class="badge-sub-title">
                        <i class="fa-solid fa-gem ms-1"></i> سوق الدراجات والسكوترات المعتمد
                    </span>
                    <h2 class="font-weight-bold text-white mt-2" style="font-size: 32px;">
                        معرض <span style="color: #C5A059;">Laghouat Cycle</span>
                    </h2>
                    <p class="mt-1" style="color: #8b949e; font-size: 14px;">
                        تصفح أفضل عروض الدراجات النارية والهوائية والسكوترات المتاحة للبيع والاستبدال.
                    </p>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 text-center text-md-end mt-3 mt-md-0">
                <div class="d-inline-flex align-items-center p-3 rounded-12 shadow-sm border" style="background: #141b22; border-color: rgba(255, 255, 255, 0.08) !important;">
                    <div class="p-3 rounded-circle ms-3" style="background: rgba(197, 160, 89, 0.15); color: #C5A059; border: 1px solid rgba(197, 160, 89, 0.3);">
                        <i class="fa-solid fa-motorcycle fa-lg"></i>
                    </div>
                    <div class="text-start">
                        <small class="d-block font-weight-bold" style="font-size: 11px; color: #8b949e;">الدراجات المتاحة</small>
                        <h4 class="font-weight-bold mb-0 text-white" style="font-size: 20px;">{{ number_format($ads->total()) }} دراجة</h4>
                    </div>
                </div>
            </div>
        </div>

        {{-- Call To Action Banner --}}
        <div class="direct-contact-banner mb-4 p-3 rounded-12 text-white" style="background: linear-gradient(135deg, #0d1117 0%, #141b22 100%); border: 1px solid rgba(197, 160, 89, 0.3);">
            <div class="row align-items-center text-center text-md-start">
                <div class="col-md-7 mb-2 mb-md-0">
                    <h5 class="mb-1 text-white font-weight-bold"><i class="fa-solid fa-headset text-warning ms-2" style="color: #C5A059 !important;"></i> هل ترغب في بيع أو استبدال دراجتك أو سكوترك؟</h5>
                    <small style="color: #8b949e;">تواصل مباشرة مع فريقنا للحصول على تقييم سريع ومناسب لعرضك.</small>
                </div>
                <div class="col-md-5 text-center text-md-end">
                    <a href="tel:0699606970" class="btn btn-sm me-1 btn-gold-outline" style="border-radius: 8px;">
                        <i class="fa-solid fa-phone ms-1"></i> 0699606970
                    </a>
                    <a href="https://wa.me/213699606970" target="_blank" class="btn btn-sm text-white" style="background-color: #25D366; border-radius: 8px; font-weight: 600;">
                        <i class="fa-brands fa-whatsapp ms-1"></i> واتساب
                    </a>
                </div>
            </div>
        </div>

        {{-- Filters & Sort Bar --}}
        <div class="p-3 rounded-12 shadow-sm border mb-4" style="background: #141b22; border-color: rgba(255, 255, 255, 0.08) !important;">
            <div class="row align-items-center justify-content-between g-3">
                <div class="col-lg-5 col-md-6">
                    <div class="position-relative">
                        <input type="text" class="form-control text-start shadow-none search-input-dark" placeholder="ابحث عن الماركة، الموديل، الفئة..." style="border-radius: 8px; height: 45px; padding-right: 40px; font-size: 14px;">
                        <i class="fa-solid fa-magnifying-glass position-absolute" style="right: 15px; top: 15px; color: #8b949e;"></i>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 text-md-end d-flex justify-content-md-end align-items-center gap-2">
                    <span class="small font-weight-bold" style="color: #8b949e;"><i class="fa-solid fa-arrow-down-wide-short me-1"></i> الترتيب:</span>
                    <select class="sorting-select form-select select-dark" style="max-width: 200px; border-radius: 8px; font-size: 13px;">
                        <option selected>أحدث الإعلانات</option>
                        <option>السعر: من الأقل للأعلى</option>
                        <option>السعر: من الأعلى للأقل</option>
                        <option>الأقل ممشى</option>
                    </select>
                </div>
            </div>
        </div>

        {{-- Bike listings --}}
        @if($ads->count() > 0)
            <div class="row g-3">
                @foreach($ads as $ad)
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                        <x-IBM.car :ad="$ad" />
                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="row mt-4">
                <div class="col-12 d-flex justify-content-center custom-car-pagination">
                    {{ $ads->links() }}
                </div>
            </div>

        @else
            {{-- Empty State Area --}}
            <div class="row">
                <div class="col-12 text-center py-5">
                    <div class="p-5 border rounded-12 shadow-sm mx-auto position-relative overflow-hidden" style="max-width: 500px; background: #0E151A; border: 1px dashed rgba(197, 160, 89, 0.3) !important;">
                        <div class="mb-3">
                            <i class="fa-solid fa-motorcycle fa-4x" style="color: #C5A059;"></i>
                        </div>
                        <h4 class="font-weight-bold mb-2 text-white">لا توجد دراجات معروضة حالياً</h4>
                        <p class="mb-4 small" style="color: #8b949e;">أضف دراجتك الهوائية أو النارية أو السكوتر إلى المعرض.</p>
                        <a href="https://wa.me/213699606970" target="_blank" class="btn text-dark px-4 py-2" style="background: #C5A059; font-size: 14px; font-weight: 700; border-radius: 8px;">
                            <i class="fa-brands fa-whatsapp ms-1"></i> تواصل لإضافة دراجتك
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>

{{-- STYLES matching Laghouat Cycle Theme --}}
<style>
    .rounded-12 { border-radius: 12px !important; }
    .rounded-8 { border-radius: 8px !important; }

    .badge-sub-title {
        background: rgba(197, 160, 89, 0.12);
        color: #C5A059;
        font-weight: 700;
        font-size: 11px;
        padding: 5px 12px;
        border-radius: 20px;
        display: inline-block;
        border: 1px solid rgba(197, 160, 89, 0.25);
    }

    .btn-gold-outline {
        border: 1px solid #C5A059;
        color: #C5A059;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    .btn-gold-outline:hover {
        background: #C5A059;
        color: #0d1117;
    }

    /* Inputs Dark Styling */
    .search-input-dark, .select-dark {
        background-color: #0d1117 !important;
        border: 1px solid rgba(255, 255, 255, 0.1) !important;
        color: #f4f7f8 !important;
    }
    .search-input-dark:focus, .select-dark:focus {
        border-color: #C5A059 !important;
        box-shadow: none !important;
    }
    .search-input-dark::placeholder {
        color: #6e7681;
    }

    /* Pagination Tweaks */
    .custom-car-pagination nav ul {
        display: flex;
        padding-start: 0;
        list-style: none;
        gap: 6px;
    }
    .custom-car-pagination nav ul li a,
    .custom-car-pagination nav ul li span {
        display: inline-block;
        padding: 8px 14px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        background: #141b22;
        color: #f4f7f8;
        text-decoration: none;
        font-size: 13px;
        font-weight: 700;
        border-radius: 8px;
        transition: all 0.2s ease;
    }
    .custom-car-pagination nav ul li.active span {
        background: #C5A059 !important;
        border-color: #C5A059 !important;
        color: #0d1117 !important;
    }
    .custom-car-pagination nav ul li a:hover {
        border-color: #C5A059 !important;
        color: #C5A059 !important;
    }
</style>
@endsection