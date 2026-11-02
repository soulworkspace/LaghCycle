<!-- Hero Section Begin -->
<section class="hero spad set-bg d-flex align-items-center" data-setbg="{{ asset('2.jpg') }}" dir="rtl" style="min-height: 100vh; padding: 80px 0; background-size: cover; background-position: center; position: relative;">
    <!-- Dark Overlay for Readability -->
    <div style="position: absolute; top:0; left:0; width:100%; height:100%; background: rgba(0,0,0,0.65); z-index: 1;"></div>

    <div class="container" style="position: relative; z-index: 2;">
        <div class="row align-items-center gy-5">
            
            <!-- Hero Text Content -->
            <div class="col-lg-8 col-12 text-center text-lg-right">
                <div class="hero__text" style="max-width: 100%;">
                    <div class="hero__text__title mb-4">
                        <span class="d-block mb-2" style="text-transform: uppercase; letter-spacing: 2px; font-weight: 700; color: #C5A059; font-size: calc(13px + 0.3vw);">
                            مرحباً بكم في Laghouat Cycle
                        </span>
                        <h1 class="mb-3" style="font-weight: 900; font-size: calc(28px + 1.5vw); line-height: 1.25; color: #ffffff;">
                            سوق الدراجات الهوائية والنارية
                        </h1>
                        <p class="text-white-50" style="font-size: 16px; max-width: 620px;">
                            اكتشف الدراجات الهوائية والنارية والسكوترات الكهربائية المعروضة للبيع من البائعين في الأغواط والجزائر.
                        </p>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="d-flex flex-column flex-sm-row justify-content-center justify-content-lg-start gap-3 mt-4" style="gap: 15px;">
                        <a href="#latest-bikes" class="primary-btn m-0 w-100 w-sm-auto text-center" style="font-weight: 700; background: #C5A059; border: 2px solid #C5A059; padding: 14px 30px; border-radius: 6px; color: #1A1A1A; transition: all 0.3s ease;">
                            تصفح المعرض
                        </a>
                        <a href="https://wa.me/213699606970" target="_blank" class="primary-btn more-btn m-0 w-100 w-sm-auto text-center" style="font-weight: 700; padding: 14px 30px; border-radius: 6px; background: transparent; border: 2px solid #ffffff; color: #ffffff; transition: all 0.3s ease;">
                            <i class="fa fa-whatsapp ms-1"></i> تواصل معنا
                        </a>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</section>

<!-- Inline CSS for Responsive Tab Behavior & Brand Colors -->
<style>
    .primary-btn:hover {
        background-color: #A88442 !important;
        border-color: #A88442 !important;
        color: #ffffff !important;
    }

    .more-btn:hover {
        background-color: #ffffff !important;
        color: #1A1A1A !important;
    }

    @media (max-width: 576px) {
        .hero {
            padding: 50px 0 !important;
        }
        .hero__text h1 {
            font-size: 26px !important;
        }
        .hero__tab {
            padding: 15px !important;
        }
        .nav-tabs .nav-link {
            padding: 10px 2px !important;
        }
    }
    
    .hero__tab .nav-tabs .nav-item .nav-link.active {
        color: #C5A059 !important;
        border-bottom-color: #C5A059 !important;
        background: transparent !important;
    }
    
    .hero__tab .nav-tabs .nav-item .nav-link {
        color: #c2c2c2;
        background: transparent;
    }
</style>
<!-- Hero Section End -->