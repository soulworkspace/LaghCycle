<div>
    @include('components.IBM.header')
    @include('components.IBM.hero')
    @include('components.IBM.services')
    @include('components.IBM.feature')

    <!-- قسم معرض الدراجات والسكوترات العالمية -->
    <section id="latest-bikes" class="latest-bikes-section py-4 py-md-5 position-relative overflow-hidden" style="background: #080C0E; color: #f4f7f8;" dir="rtl">
        
        {{-- إضاءة خلفية هادئة --}}
        <div class="position-absolute top-0 start-50 translate-middle-x w-100 h-100 opacity-25 pointer-events-none" 
             style="background: radial-gradient(circle at 50% 20%, rgba(197, 160, 89, 0.15) 0%, transparent 70%);"></div>

        <div class="container position-relative z-1 px-3 px-sm-4">
            
            {{-- ترويسة القسم متجاوبة بالكامل --}}
            <div class="d-flex flex-column flex-lg-row align-items-start align-items-lg-end justify-content-between mb-4 mb-md-5 pb-3 border-bottom border-secondary border-opacity-10 gap-3">
                <div class="w-100 w-lg-auto">
                    <div class="d-flex align-items-center gap-2 mb-2 flex-wrap">
                        <span class="badge rounded-pill px-2 px-sm-3 py-1 text-uppercase fw-bold" 
                              style="background: rgba(197, 160, 89, 0.1); color: #C5A059; border: 1px solid rgba(197, 160, 89, 0.25); font-size: 10px; letter-spacing: .08em;">
                            <i class="fa-solid fa-gem ms-1"></i> المعرض المعتمد
                        </span>
                        <span class="text-secondary small" style="font-size: 11px;">• تم التحديث للتو</span>
                    </div>
                    <h2 class="fw-extrabold text-white mb-0 section-title">
                        أحدث الدراجات والسكوترات <span style="color: #C5A059;">المتاحة</span>
                    </h2>
                </div>

                {{-- أزرار تصفية سريعة مرنة وقابلة للتمرير على الهواتف --}}
                <div class="filter-pills-wrapper d-flex align-items-center gap-2 w-100 w-lg-auto overflow-x-auto pb-2 pb-lg-0">
                    <a href="{{ route('ads.index') }}" class="btn btn-filter-pill active text-nowrap text-decoration-none">
                        <i class="fa-solid fa-layer-group ms-1"></i> الكل
                    </a>
                    <a href="{{ route('ads.by-category', 'scooters') }}" class="btn btn-filter-pill text-nowrap text-decoration-none">
                        <i class="fa-solid fa-motorcycle ms-1"></i> سكوتر
                    </a>
                    <a href="{{ route('ads.by-category', 'motorcycles') }}" class="btn btn-filter-pill text-nowrap text-decoration-none">
                        <i class="fa-solid fa-gauge-high ms-1"></i> دراجات نارية
                    </a>
                    <a href="{{ route('ads.by-category', 'bicycles') }}" class="btn btn-filter-pill text-nowrap text-decoration-none">
                        <i class="fa-solid fa-bicycle ms-1"></i> دراجات هوائية
                    </a>
                </div>
            </div>

            {{-- شبكة عرض الدراجات بجميع المقاسات --}}
            <div class="row g-3 g-md-4">
                @forelse($recentAds as $ad)
                    <div class="col-12 col-sm-6 col-lg-4 col-xl-3 d-flex align-items-stretch">
                        <x-IBM.car :ad="$ad" />
                    </div>
                @empty
                    <div class="col-12 text-center text-secondary py-5 rounded-4 position-relative overflow-hidden" 
                         style="background: #0E151A; border: 1px dashed rgba(197, 160, 89, 0.3);">
                        <div class="py-4">
                            <div class="icon-circle mb-3 mx-auto d-flex align-items-center justify-content-center rounded-circle" 
                                 style="width: 70px; height: 70px; background: rgba(197, 160, 89, 0.1); border: 1px solid rgba(197, 160, 89, 0.2);">
                                <i class="fa-solid fa-motorcycle fs-2" style="color: #C5A059;"></i>
                            </div>
                            <h5 class="text-white fw-bold">لا توجد دراجات متاحة حالياً</h5>
                            <p class="small text-secondary mb-3">عد لاحقاً أو أضف إعلان دراجتك إلى المعرض.</p>
                        </div>
                    </div>
                @endforelse
            </div>

            {{-- زر التحفيز السفلي --}}
            @if(count($recentAds) > 0)
                <div class="mt-4 mt-md-5 text-center">
                    <a href="{{ route('ads.index') }}" class="btn btn-outline-gold px-4 px-md-5 py-2 py-md-3 rounded-3 fw-bold fs-6">
                        <span>تصفح جميع الدراجات في المعرض</span>
                        <i class="fa-solid fa-arrow-left me-2"></i>
                    </a>
                </div>
            @endif

        </div>
    </section>

    @include('components.IBM.chooseus')

    {{-- تنسيقات التجاوب والتصميم المدمجة داخل العنصر الرئيسي --}}
    <style>
        .section-title {
            font-size: 1.5rem;
        }
        @media (min-width: 576px) {
            .section-title { font-size: 1.8rem; }
        }
        @media (min-width: 992px) {
            .section-title { font-size: 2.2rem; }
        }

        /* شريط التصفية على الهواتف */
        .filter-pills-wrapper::-webkit-scrollbar {
            display: none;
        }
        .filter-pills-wrapper {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .btn-filter-pill {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.08);
            color: #8b949e;
            border-radius: 30px;
            padding: 5px 14px;
            font-size: 11px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        @media (min-width: 576px) {
            .btn-filter-pill {
                padding: 6px 18px;
                font-size: 12px;
            }
        }

        .btn-filter-pill:hover {
            background: rgba(197, 160, 89, 0.1);
            color: #C5A059;
            border-color: rgba(197, 160, 89, 0.3);
        }

        .btn-filter-pill.active {
            background: #C5A059 !important;
            color: #080C0E !important;
            border-color: #C5A059 !important;
            font-weight: 700;
            box-shadow: 0 4px 15px rgba(197, 160, 89, 0.3);
        }

        .btn-outline-gold {
            border: 1px solid #C5A059;
            color: #C5A059;
            background: rgba(197, 160, 89, 0.02);
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .btn-outline-gold:hover {
            background: #C5A059;
            color: #080C0E;
            box-shadow: 0 10px 25px rgba(197, 160, 89, 0.25);
            transform: translateY(-2px);
        }
    </style>
</div>