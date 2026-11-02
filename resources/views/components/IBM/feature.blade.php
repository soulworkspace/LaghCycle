<!-- ================= قسم نقاط قوتنا (Laghouat Cycle) ================= -->
<section class="feature spad custom-trusted-section" id="Trusted" dir="rtl">
    <div class="container">
        <div class="row gy-5 align-items-center justify-content-between">
            
            <!-- النصوص والتعريف (جهة اليمين) -->
            <div class="col-lg-5 col-md-12 col-12">
                <div class="feature__text text-right">
                    <div class="section-title">
                        <span>نقاط قوتنا</span>
                        <h2>وجهتك الموثوقة لعالم الدراجات والسكوترات</h2>
                    </div>
                    <div class="feature__text__desc">
                        <p>في <strong>Laghouat Cycle</strong>، نلتزم بالشفافية التامة والاحترافية في كل عملية شراء، بيع، أو استبدال للدراجات والسكوترات.</p>
                        <p>نساعدك على اختيار دراجة مناسبة، مع معلومات واضحة عن حالتها ومواصفاتها قبل الشراء.</p>
                    </div>
                    <div class="feature__text__btn d-flex flex-wrap gap-2 pt-2">
                        <a href="{{ url('/#Trusted') }}" class="primary-btn">من نحن</a>
                        <a href="https://wa.me/213699606970" target="_blank" class="primary-btn partner-btn">تواصل معنا</a>
                    </div>
                </div>
            </div>
            
            <!-- شبكة أجزاء الفحص (جهة اليسار) -->
            <div class="col-lg-6 col-md-12 col-12">
                <div class="row g-3">
                    
                    <!-- Feature 1: المحرك -->
                    <div class="col-lg-4 col-md-4 col-6">
                        <div class="feature__item text-center">
                            <div class="feature__item__icon mb-2">
                                <i class="fa-solid fa-gauge-high" style="font-size: 2rem; color: #C5A059;"></i>
                            </div>
                            <h6>المحرك والأداء</h6>
                        </div>
                    </div>
                    
                    <!-- Feature 2: البطارية والنظام الكهربائي -->
                    <div class="col-lg-4 col-md-4 col-6">
                        <div class="feature__item text-center">
                            <div class="feature__item__icon mb-2">
                                <i class="fa-solid fa-charging-station" style="font-size: 2rem; color: #C5A059;"></i>
                            </div>
                            <h6>البطارية والكهرباء</h6>
                        </div>
                    </div>
                    
                    <!-- Feature 3: الهيكل والشاسي -->
                    <div class="col-lg-4 col-md-4 col-6">
                        <div class="feature__item text-center">
                            <div class="feature__item__icon mb-2">
                                <i class="fa-solid fa-shield-halved" style="font-size: 2rem; color: #C5A059;"></i>
                            </div>
                            <h6>سلامة الهيكل</h6>
                        </div>
                    </div>
                    
                    <!-- Feature 4: المساعدين ونظام التعليق -->
                    <div class="col-lg-4 col-md-4 col-6">
                        <div class="feature__item text-center">
                            <div class="feature__item__icon mb-2">
                                <i class="fa-solid fa-dharmachakra" style="font-size: 2rem; color: #C5A059;"></i>
                            </div>
                            <h6>نظام التعليق</h6>
                        </div>
                    </div>
                    
                    <!-- Feature 5: العجلات والإطارات -->
                    <div class="col-lg-4 col-md-4 col-6">
                        <div class="feature__item text-center">
                            <div class="feature__item__icon mb-2">
                                <i class="fa-solid fa-circle-dot" style="font-size: 2rem; color: #C5A059;"></i>
                            </div>
                            <h6>جودة الإطارات</h6>
                        </div>
                    </div>
                    
                    <!-- Feature 6: الفرامل والأمان -->
                    <div class="col-lg-4 col-md-4 col-6">
                        <div class="feature__item text-center">
                            <div class="feature__item__icon mb-2">
                                <i class="fa-solid fa-triangle-exclamation" style="font-size: 2rem; color: #C5A059;"></i>
                            </div>
                            <h6>نظام الفرامل</h6>
                        </div>
                    </div>
                    
                </div>
            </div>
            
        </div>
    </div>
</section>

<!-- ================= CSS الموحد والمعدل لهوية Laghouat Cycle ================= -->
<style>
    /* 1. إلغاء أي خلفية أو عناصر متموضعة مسبقاً من القالب القديم */
    #Trusted,
    #Trusted .feature__text,
    #Trusted .row {
        background-image: none !important;
    }

    #Trusted::before,
    #Trusted::after,
    #Trusted .feature__text::before,
    #Trusted .feature__text::after {
        display: none !important;
        content: none !important;
    }

    /* 2. ضبط اتجاه ومحاذاة القسم */
    #Trusted[dir="rtl"] {
        text-align: right !important;
        direction: rtl !important;
        position: relative;
        z-index: 1;
    }

    /* 3. تنسيق العناوين وحمايتها من التداخل */
    #Trusted .section-title {
        position: relative !important;
        z-index: 10 !important;
        text-align: right !important;
        direction: rtl !important;
    }

    #Trusted .section-title span {
        color: #C5A059 !important;
        display: block !important;
        font-weight: 700 !important;
        font-size: 15px !important;
        margin-bottom: 8px !important;
        text-align: right !important;
        direction: rtl !important;
    }

    #Trusted .section-title h2 {
        color: #1A1A1A !important;
        font-size: 28px !important;
        font-weight: 800 !important;
        line-height: 1.3 !important;
        margin-bottom: 15px !important;
        text-align: right !important;
        direction: rtl !important;
        position: relative !important;
        z-index: 10 !important;
    }

    #Trusted .feature__text__desc p {
        color: #666666;
        line-height: 1.7;
        margin-bottom: 12px;
    }

    /* 4. الأزرار الرئيسية والفرعية */
    #Trusted .feature__text__btn .primary-btn {
        display: inline-block;
        padding: 12px 28px;
        border-radius: 6px;
        font-weight: 700;
        text-decoration: none;
        text-align: center;
    }

    #Trusted .feature__text__btn .primary-btn:not(.partner-btn) {
        background: #C5A059 !important;
        border: 2px solid #C5A059 !important;
        color: #1A1A1A !important;
        transition: all 0.3s ease !important;
    }

    #Trusted .feature__text__btn .primary-btn:not(.partner-btn):hover {
        background: #1A1A1A !important;
        border-color: #1A1A1A !important;
        color: #ffffff !important;
    }

    #Trusted .feature__text__btn .partner-btn {
        background: transparent !important;
        border: 2px solid #cbd5e1 !important;
        color: #1A1A1A !important;
        transition: all 0.3s ease !important;
    }

    #Trusted .feature__text__btn .partner-btn:hover {
        border-color: #C5A059 !important;
        color: #C5A059 !important;
    }

    /* 5. بطاقات الميزات والأيقونات */
    #Trusted .feature__item {
        background: #ffffff;
        border: 1px solid #eaeeed;
        padding: 20px 10px;
        border-radius: 8px;
        transition: all 0.3s ease !important;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.02);
    }

    #Trusted .feature__item h6 {
        margin: 0;
        font-size: 14px;
        font-weight: 700;
        color: #1A1A1A;
        transition: color 0.3s ease;
    }

    #Trusted .feature__item:hover {
        border-color: #C5A059 !important;
        background: #faf8f5 !important;
        transform: translateY(-3px);
    }

    #Trusted .feature__item:hover h6 {
        color: #C5A059 !important;
    }
</style>