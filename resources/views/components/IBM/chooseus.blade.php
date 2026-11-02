<!-- Choose Us Section Begin -->
<section class="chooseus-custom py-5 bg-light overflow-hidden" dir="rtl">
    <div class="container">
        <div class="row align-items-center gy-4 flex-column-reverse flex-lg-row">
            
            <!-- Left Side: Image Container -->
            <div class="col-lg-6 col-md-12">
                <div class="chooseus-video-wrapper position-relative rounded-4 overflow-hidden shadow-lg w-100" style="min-height: 280px; max-height: 400px;">
                    <img src="{{ asset('2.jpg') }}" alt="لماذا تختارنا - Laghouat Cycle" class="w-100 h-100 d-block" style="object-fit: cover;">
                    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(26, 26, 26, 0.2);"></div>
                </div>
            </div>

            <!-- Right Side: Text Content -->
            <div class="col-lg-6 col-md-12">
                <div class="chooseus__text text-end pe-lg-3 ps-0">
                    <div class="section-title text-end mb-4">
                        <span class="d-block text-uppercase fw-bold mb-2" style="color: #C5A059; letter-spacing: 1px; font-size: 13px;">لماذا تختارنا</span>
                        <h2 class="fw-bold mb-3" style="color: #1A1A1A; font-size: clamp(1.5rem, 2.5vw, 2rem);">نقدم أفضل تجربة لخدمة وحلول الدراجات</h2>
                        <p class="text-muted" style="line-height: 1.7; font-size: 15px;">نحن ملتزمون بتقديم تجربة احترافية متكاملة لـ <strong>بيع وصيانة</strong> الدراجات والسكوترات بكل ثقة وراحة بال.</p>
                    </div>
                    
                    <ul class="list-unstyled p-0 mb-4 text-end">
                        <li class="d-flex align-items-center justify-content-start mb-3">
                            <i class="fa-solid fa-circle-check me-0 ms-2 fs-5" style="color: #C5A059;"></i>
                            <span style="color: #334155; font-size: 15px;">تشكيلة مميزة من الدراجات والسكوترات عالية الجودة.</span>
                        </li>
                        <li class="d-flex align-items-center justify-content-start mb-3">
                            <i class="fa-solid fa-circle-check me-0 ms-2 fs-5" style="color: #C5A059;"></i>
                            <span style="color: #334155; font-size: 15px;">ورشة صيانة متخصصة لتصليح كافة الأعطال الميكانيكية والكهربائية.</span>
                        </li>
                        <li class="d-flex align-items-center justify-content-start mb-3">
                            <i class="fa-solid fa-circle-check me-0 ms-2 fs-5" style="color: #C5A059;"></i>
                            <span style="color: #334155; font-size: 15px;">توفير قطع غيار أصلية ومستلزمات حماية معتمدة.</span>
                        </li>
                        <li class="d-flex align-items-center justify-content-start mb-3">
                            <i class="fa-solid fa-circle-check me-0 ms-2 fs-5" style="color: #C5A059;"></i>
                            <span style="color: #334155; font-size: 15px;">فريق متخصص ومستعد لتقديم التوجيه والنصح الفني مجاناً.</span>
                        </li>
                    </ul>

                    <a href="{{ url('/#Trusted') }}" class="btn chooseus-custom-btn text-decoration-none d-inline-block">من نحن</a>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- Choose Us Section End -->

<style>
    /* كسر محاذاة اليسار المفروضة من style.css */
    .chooseus__text, 
    .chooseus__text .section-title {
        text-align: right !important;
    }

    section.chooseus-custom {
        background-color: #f8fafc !important;
    }

    .chooseus-custom-btn {
        background-color: #C5A059 !important;
        border-color: #C5A059 !important;
        color: #1A1A1A !important;
        padding: 12px 32px;
        border-radius: 6px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        transition: all 0.3s ease-in-out !important;
    }

    .chooseus-custom-btn:hover {
        background-color: #1A1A1A !important;
        border-color: #1A1A1A !important;
        color: #ffffff !important;
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(197, 160, 89, 0.3);
    }
</style>