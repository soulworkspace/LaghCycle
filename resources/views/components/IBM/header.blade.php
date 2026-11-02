<!-- ================= 1. القائمة الجانبية المخصصة للهاتف (Custom Offcanvas) ================= -->
<div class="custom-offcanvas-overlay" id="customOffcanvasOverlay"></div>

<aside class="custom-offcanvas" id="customOffcanvas" dir="rtl">
    <!-- زر الإغلاق -->
    <button type="button" class="custom-offcanvas__close" id="customOffcanvasClose" aria-label="إغلاق القائمة">&times;</button>
    
    <!-- الشعار داخل القائمة -->
    <div class="custom-offcanvas__logo">
        <a href="{{ url('/') }}">
            <img src="{{ asset('logolagh.png') }}" alt="Laghouat Cycle">
        </a>
    </div>

    <!-- روابط الملاحة للهاتف -->
    <nav class="custom-offcanvas__nav">
        <ul>
            <li class="{{ Request::is('/') ? 'active' : '' }}"><a href="{{ url('/') }}">الرئيسية</a></li>
            <li class="{{ Request::is('category*') ? 'active' : '' }}"><a href="{{ url('/#categories') }}">الفئات</a></li>
            <li><a href="{{ url('/#about') }}">من نحن</a></li>
<li class="{{ Request::is('ads*') ? 'active' : '' }}"><a href="{{ url('/ads') }}">الدراجات والمعرض</a></li>
<li><a href="https://wa.me/213699606970" target="_blank">تواصل معنا</a></li>
        </ul>
    </nav>

    <!-- إجراءات إضافية -->
    <div class="custom-offcanvas__actions">
        <a href="https://wa.me/213699606970" target="_blank" class="custom-btn custom-btn--whatsapp">
            <i class="fa fa-whatsapp"></i> تواصل عبر واتساب
        </a>
    </div>

    <!-- شبكات التواصل الاجتماعي -->
    <div class="custom-offcanvas__social">
        <a href="https://www.instagram.com/laghouat_cycle_03/" target="_blank" aria-label="Instagram"><i class="fa fa-instagram"></i></a>
        <a href="https://wa.me/213699606970" target="_blank" aria-label="WhatsApp"><i class="fa fa-whatsapp"></i></a>
    </div>

    <!-- معلومات الاتصال -->
    <div class="custom-offcanvas__info">
        <p><i class="fa fa-bicycle"></i> بيع وتوزيع الدراجات والسكوتر - الأغواط</p>
        <p><i class="fa fa-phone"></i> <a href="tel:0699606970" class="en-text">0699 60 69 70</a></p>
    </div>
</aside>


<!-- ================= 2. الهيدر الرئيسي (Custom Header) ================= -->
<header class="custom-header" dir="rtl">
    <!-- الشريط العلوي -->
    <div class="custom-header__topbar">
        <div class="custom-header__container">
            <div class="custom-header__topbar-wrapper">
                <div class="custom-header__tagline">
                    <i class="fa fa-bicycle"></i> عالم الدراجات النارية والكهربائية والهوائية - الأغواط
                </div>
                <div class="custom-header__contacts">
                    <div class="custom-header__phone">
                        <i class="fa fa-phone"></i>
                        <a href="tel:0699606970" class="en-text">0699 60 69 70</a>
                    </div>
                    <div class="custom-header__social">
                        <a href="https://www.instagram.com/laghouat_cycle_03/" target="_blank" aria-label="Instagram"><i class="fa fa-instagram"></i></a>
                        <a href="https://wa.me/213699606970" target="_blank" aria-label="WhatsApp"><i class="fa fa-whatsapp"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- الشريط الرئيسي -->
    <div class="custom-header__main">
        <div class="custom-header__container">
            <div class="custom-header__main-wrapper">
                
                <!-- اللوجو (يمين) -->
                <div class="custom-header__logo">
                    <a href="{{ url('/') }}">
                        <img src="{{ asset('logolagh.png') }}" alt="Laghouat Cycle">
                    </a>
                </div>

                <!-- القائمة الرئيسية (للشاشات الكبيرة) -->
                <nav class="custom-header__nav d-none-mobile">
                    <ul>
                        <li class="{{ Request::is('/') ? 'active' : '' }}"><a href="{{ url('/') }}">الرئيسية</a></li>
                        <li class="{{ Request::is('category*') ? 'active' : '' }}"><a href="{{ url('/#categories') }}">الفئات</a></li>
                        <li><a href="{{ url('/#about') }}">من نحن</a></li>
                        <li class="{{ Request::is('products*') ? 'active' : '' }}"><a href="{{ url('/products') }}">الدراجات المعروضة</a></li>
                        <li><a href="https://wa.me/213699606970" target="_blank">تواصل معنا</a></li>
                    </ul>
                </nav>

                <!-- الأزرار والبحث (للشاشات الكبيرة) -->
                <div class="custom-header__widgets d-none-mobile">
                    <button type="button" class="custom-header__search-btn search-switch" aria-label="بحث">
                        <i class="fa fa-search"></i>
                    </button>
                    <a href="https://wa.me/213699606970" target="_blank" class="custom-btn custom-btn--primary">
                        واتساب
                    </a>
                </div>

                <!-- زر قائمة الموبايل (يسار في الهواتف) -->
                <button type="button" class="custom-header__toggle d-show-mobile" id="customOffcanvasToggle" aria-label="فتح القائمة">
                    <i class="fa fa-bars"></i>
                </button>

            </div>
        </div>
    </div>
</header>


<!-- ================= 3. التنسيقات الخالصة (Custom CSS) ================= -->
<style>
    /* Reset & Brand Variables */
    :root {
        --primary-color: #1A1A1A;      /* الأسود الداكن للشعار */
        --secondary-color: #C5A059;    /* الذهبي البرونزي للشعار */
        --secondary-hover: #A88442;
        --text-dark: #222222;
        --bg-light: #f8f9fa;
        --border-color: #333333;
    }

    /* Container */
    .custom-header__container {
        width: 100%;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 15px;
    }

    /* Helper Utility Classes */
    @media (min-width: 992px) {
        .d-none-mobile { display: flex !important; }
        .d-show-mobile { display: none !important; }
    }
    @media (max-width: 991px) {
        .d-none-mobile { display: none !important; }
        .d-show-mobile { display: flex !important; }
    }

    /* --- Topbar --- */
    .custom-header__topbar {
        background-color: var(--primary-color);
        color: #ffffff;
        padding: 8px 0;
        font-size: 13px;
        border-bottom: 1px solid rgba(197, 160, 89, 0.2);
    }
    .custom-header__topbar-wrapper {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
    }
    .custom-header__tagline i, .custom-header__phone i {
        color: var(--secondary-color);
        margin-left: 5px;
    }
    .custom-header__contacts {
        display: flex;
        align-items: center;
        gap: 20px;
    }
    .custom-header__phone a {
        color: #fff;
        text-decoration: none;
        font-weight: 600;
    }
    .custom-header__social {
        display: flex;
        gap: 12px;
    }
    .custom-header__social a {
        color: #fff;
        transition: color 0.3s;
    }
    .custom-header__social a:hover {
        color: var(--secondary-color);
    }

    /* --- Main Header --- */
    .custom-header__main {
        background: #ffffff;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        padding: 10px 0;
    }
    .custom-header__main-wrapper {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    /* Logo */
    .custom-header__logo img {
        max-width: 75px;
        height: auto;
        display: block;
    }

    /* Desktop Navigation */
    .custom-header__nav ul {
        display: flex;
        list-style: none;
        margin: 0;
        padding: 0;
        gap: 25px;
    }
    .custom-header__nav a {
        text-decoration: none;
        color: var(--text-dark);
        font-weight: 700;
        font-size: 15px;
        transition: color 0.3s;
        position: relative;
    }
    .custom-header__nav li.active a,
    .custom-header__nav a:hover {
        color: var(--secondary-color);
    }

    /* Widgets & Buttons */
    .custom-header__widgets {
        align-items: center;
        gap: 15px;
    }
    .custom-header__search-btn {
        background: none;
        border: none;
        font-size: 18px;
        color: var(--primary-color);
        cursor: pointer;
        transition: color 0.3s;
    }
    .custom-header__search-btn:hover {
        color: var(--secondary-color);
    }
    .custom-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 9px 20px;
        font-size: 14px;
        font-weight: 700;
        border-radius: 6px;
        text-decoration: none;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
    }
    .custom-btn--primary {
        background-color: var(--secondary-color);
        color: #1A1A1A;
    }
    .custom-btn--primary:hover {
        background-color: var(--secondary-hover);
        color: #ffffff;
    }
    .custom-btn--whatsapp {
        background-color: #25D366;
        color: #ffffff;
        width: 100%;
        gap: 8px;
    }

    /* Mobile Toggle Button */
    .custom-header__toggle {
        width: 42px;
        height: 42px;
        background: var(--bg-light);
        border: 1px solid #ddd;
        border-radius: 8px;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        color: var(--primary-color);
        cursor: pointer;
        transition: all 0.3s ease;
    }
    .custom-header__toggle:hover {
        background: var(--primary-color);
        color: var(--secondary-color);
    }

    /* --- Offcanvas Menu (Mobile) --- */
    .custom-offcanvas-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        background: rgba(0, 0, 0, 0.6);
        z-index: 9998;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
    }
    .custom-offcanvas-overlay.is-active {
        opacity: 1;
        visibility: visible;
    }

    .custom-offcanvas {
        position: fixed;
        top: 0;
        right: -320px;
        width: 300px;
        height: 100vh;
        background: #ffffff;
        z-index: 9999;
        padding: 30px 20px;
        box-shadow: -5px 0 15px rgba(0,0,0,0.2);
        display: flex;
        flex-direction: column;
        transition: right 0.4s cubic-bezier(0.25, 1, 0.5, 1);
        overflow-y: auto;
    }
    .custom-offcanvas.is-active {
        right: 0;
    }

    .custom-offcanvas__close {
        position: absolute;
        top: 15px;
        left: 20px;
        background: none;
        border: none;
        font-size: 32px;
        color: #888;
        cursor: pointer;
        line-height: 1;
    }
    .custom-offcanvas__close:hover {
        color: var(--secondary-color);
    }

    .custom-offcanvas__logo {
        text-align: center;
        margin-bottom: 25px;
    }
    .custom-offcanvas__logo img {
        max-width: 80px;
    }

    .custom-offcanvas__nav ul {
        list-style: none;
        padding: 0;
        margin: 0 0 25px 0;
    }
    .custom-offcanvas__nav li {
        border-bottom: 1px solid #eee;
    }
    .custom-offcanvas__nav a {
        display: block;
        padding: 12px 0;
        text-decoration: none;
        color: var(--text-dark);
        font-weight: 600;
        font-size: 15px;
    }
    .custom-offcanvas__nav li.active a,
    .custom-offcanvas__nav a:hover {
        color: var(--secondary-color);
    }

    .custom-offcanvas__social {
        display: flex;
        justify-content: center;
        gap: 15px;
        margin: 20px 0;
        font-size: 18px;
    }
    .custom-offcanvas__social a {
        color: var(--primary-color);
    }
    .custom-offcanvas__social a:hover {
        color: var(--secondary-color);
    }

    .custom-offcanvas__info {
        font-size: 13px;
        color: #666;
        border-top: 1px solid #eee;
        padding-top: 15px;
        margin-top: auto;
    }
    .custom-offcanvas__info p {
        margin-bottom: 8px;
    }
    .custom-offcanvas__info i {
        color: var(--secondary-color);
        margin-left: 5px;
    }
    .custom-offcanvas__info a {
        color: inherit;
        text-decoration: none;
    }

    /* Responsive Adjustments */
    @media (max-width: 767px) {
        .custom-header__topbar-wrapper {
            justify-content: center;
            text-align: center;
        }
        .custom-header__logo img {
            max-width: 60px;
        }
    }
</style>


<!-- ================= 4. الجافاسكريبت المخصص للفتح والإغلاق (JavaScript) ================= -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggleBtn = document.getElementById('customOffcanvasToggle');
        const closeBtn = document.getElementById('customOffcanvasClose');
        const overlay = document.getElementById('customOffcanvasOverlay');
        const offcanvas = document.getElementById('customOffcanvas');

        function openMenu() {
            offcanvas.classList.add('is-active');
            overlay.classList.add('is-active');
            document.body.style.overflow = 'hidden';
        }

        function closeMenu() {
            offcanvas.classList.remove('is-active');
            overlay.classList.remove('is-active');
            document.body.style.overflow = '';
        }

        if (toggleBtn) toggleBtn.addEventListener('click', openMenu);
        if (closeBtn) closeBtn.addEventListener('click', closeMenu);
        if (overlay) overlay.addEventListener('click', closeMenu);
    });
</script>