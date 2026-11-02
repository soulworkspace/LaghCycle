<!-- Services Section Begin -->
<section class="services spad" id="services" dir="rtl">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title text-center">
                    <span>خدماتنا</span>
                    <h2>ماذا نقدم لك في Laghouat Cycle</h2>
                    <p>اكتشف خدماتنا الشاملة المصممة لشراء، بيع، واستبدال الدراجات والسكوترات بكل سهولة وسلاسة.</p>
                </div>
            </div>
        </div>
        
        <div class="row justify-content-center">
            <!-- Service 1: شراء الدراجات والسكوترات -->
            <div class="col-lg-4 col-md-6 col-sm-6 col-12 mb-4">
                <div class="services__item">
                    <div class="service-icon mb-3">
                        <i class="fa-solid fa-motorcycle" style="font-size: 2.5rem; color: #C5A059;"></i>
                    </div>
                    <h5>شراء الدراجات والسكوترات</h5>
                    <p>استكشف مجموعتنا الواسعة من الدراجات النارية والهوائية والسكوترات المفحوصة والمضمونة.</p>
                    <a href="#products"><i class="fa fa-long-arrow-left"></i></a>
                </div>
            </div>
            
            <!-- Service 2: بيع مبسط -->
            <div class="col-lg-4 col-md-6 col-sm-6 col-12 mb-4">
                <div class="services__item">
                    <div class="service-icon mb-3">
                        <i class="fa-solid fa-store" style="font-size: 2.5rem; color: #C5A059;"></i>
                    </div>
                    <h5>بيع مبسط</h5>
                    <p>اعرض دراجتك أو سكوترك للبيع في خطوات بسيطة وتواصل مباشرة مع المشتريين المهتمين.</p>
                    <a href="https://wa.me/213699606970" target="_blank"><i class="fa fa-long-arrow-left"></i></a>
                </div>
            </div>
            
            <!-- Service 3: استبدال سريع -->
            <div class="col-lg-4 col-md-6 col-sm-6 col-12 mb-4">
                <div class="services__item">
                    <div class="service-icon mb-3">
                        <i class="fa-solid fa-arrows-rotate" style="font-size: 2.5rem; color: #C5A059;"></i>
                    </div>
                    <h5>استبدال سريع</h5>
                    <p>استبدل دراجتك الحالية بدراجة أخرى بعد تقييم عادل ودقيق من فريقنا.</p>
                    <a href="https://wa.me/213699606970" target="_blank"><i class="fa fa-long-arrow-left"></i></a>
                </div>
            </div>
            
            <!-- Service 4: الذكاء الاصطناعي اختيار دراجتك -->
            <div class="col-lg-4 col-md-6 col-sm-6 col-12 mb-4">
                <div class="services__item position-relative overflow-hidden cursor-pointer" onclick="openAiChatDrawer()">
                    <!-- Beta Badge -->
                    <span class="ai-beta-badge">قيد التطوير 🧪</span>
                    
                    <div class="ai-icon-wrapper mb-2">
                        <i class="fa-solid fa-robot" style="font-size: 2.5rem; color: #C5A059;"></i>
                    </div>
                    <h5>المساعد الذكي للدراجات</h5>
                    <p>دع الذكاء الاصطناعي يساعدك في اختيار السكوتر أو الدراجة المثالية بناءً على ميزانيتك واحتياجاتك.</p>
                    <a href="javascript:void(0)" class="ai-btn" onclick="openAiChatDrawer(); event.stopPropagation();"><i class="fa-solid fa-wand-magic-sparkles"></i> جرب الآن</a>
                </div>
            </div>

            <!-- Service 5: دعم 24/7 -->
            <div class="col-lg-4 col-md-6 col-sm-6 col-12 mb-4">
                <div class="services__item">
                    <div class="service-icon mb-3">
                        <i class="fa-solid fa-headset" style="font-size: 2.5rem; color: #C5A059;"></i>
                    </div>
                    <h5>دعم 24/7</h5>
                    <p>يقوم فريقنا بإرشادك في كل خطوة لضمان معاملة آمنة وتقديم النصح الفني والتقني دائماً.</p>
                    <a href="https://wa.me/213699606970" target="_blank"><i class="fa fa-long-arrow-left"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Services Section End -->

<!-- AI Chat Drawer Backdrop -->
<div id="aiDrawerOverlay" class="ai-drawer-overlay" onclick="closeAiChatDrawer()"></div>

<!-- AI Chat Drawer Window -->
<div id="aiChatDrawer" class="ai-chat-drawer" dir="rtl">
    <div class="ai-drawer-header">
        <div class="d-flex align-items-center gap-2">
            <div class="ai-avatar">
                <i class="fa-solid fa-robot"></i>
            </div>
            <div>
                <h6 class="mb-0 fw-bold text-white">المساعد الذكي - Laghouat Cycle</h6>
                <small class="text-warning">قيد التطوير والاختبار</small>
            </div>
        </div>
        <button class="ai-close-btn" onclick="closeAiChatDrawer()">&times;</button>
    </div>

    <div class="ai-drawer-body">
        <div class="ai-message robot">
            <div class="msg-bubble">
                مرحباً بك! 👋 أنا مساعدك الذكي الخاص بـ <strong>Laghouat Cycle</strong>.
            </div>
        </div>

        <div class="ai-message robot">
            <div class="msg-bubble highlight">
                🚀 <strong>الميزة قادمة قريبًا جدًا!</strong><br>
                نعمل حالياً على تدريب وتجهيز النموذج الذكي لمساعدتك في التقييم واختيار السكوتر أو الدراجة الأنسب لاحتياجاتك وميزانيتك تلقائياً.
            </div>
        </div>
    </div>

    <div class="ai-drawer-footer">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="الميزة ستكون متاحة قريباً..." disabled>
            <button class="btn btn-gold" disabled><i class="fa-solid fa-paper-plane"></i></button>
        </div>
    </div>
</div>

<style>
    /* RTL Direction overrides */
    .services[dir="rtl"] {
        text-align: right;
    }

    .cursor-pointer {
        cursor: pointer;
    }

    /* Arrow and Icon Styling Override */
    .services__item a,
    .services__item a.active,
    .services__item.active a {
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        width: 42px !important;
        height: 42px !important;
        background: #1A1A1A !important;
        color: #C5A059 !important;
        border-radius: 50% !important;
        transition: all 0.3s ease !important;
        text-decoration: none !important;
    }

    .services__item:hover a {
        background: #C5A059 !important;
        color: #1A1A1A !important;
        box-shadow: 0px 4px 12px rgba(197, 160, 89, 0.35) !important;
    }

    /* Card Base Styling & Border Color Override */
    .services__item {
        background: #ffffff !important;
        border: 1px solid #eef2f6 !important;
        border-radius: 12px !important;
        padding: 30px 20px !important;
        text-align: center !important;
        transition: all 0.3s ease !important;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        align-items: center;
    }

    .services__item:hover {
        border-color: #C5A059 !important;
        transform: translateY(-5px) !important;
        box-shadow: 0 10px 25px rgba(26, 26, 26, 0.08) !important;
    }

    .services .section-title span {
        color: #C5A059 !important;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-weight: 600;
    }

    .services__item h5 {
        color: #1A1A1A !important;
        font-weight: 700 !important;
        margin-top: 18px !important;
        margin-bottom: 10px !important;
    }

    .services__item p {
        color: #6c757d !important;
        font-size: 14px !important;
        line-height: 1.6 !important;
    }

    /* AI Service Badge Custom Styling */
    .ai-beta-badge {
        position: absolute;
        top: 12px;
        left: 12px;
        background: rgba(197, 160, 89, 0.15);
        color: #8C6D37;
        font-size: 11px;
        font-weight: bold;
        padding: 4px 10px;
        border-radius: 20px;
        border: 1px solid rgba(197, 160, 89, 0.3);
    }

    .services__item a.ai-btn {
        width: auto !important;
        border-radius: 20px !important;
        padding: 0 18px !important;
        font-size: 13px;
        font-weight: 600;
        gap: 6px;
    }

    /* -------------------------------------------------------------
       AI Drawer & Side Chat Styles (Global & Responsive)
    ------------------------------------------------------------- */
    .ai-drawer-overlay {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.6);
        backdrop-filter: blur(4px);
        z-index: 1040;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
    }
    .ai-drawer-overlay.active {
        opacity: 1;
        visibility: visible;
    }

    .ai-chat-drawer {
        position: fixed;
        top: 0;
        bottom: 0;
        left: -420px; /* Hide to the left */
        width: 100%;
        max-width: 400px;
        background: #121212;
        box-shadow: 10px 0 30px rgba(0, 0, 0, 0.5);
        z-index: 1050;
        display: flex;
        flex-direction: column;
        transition: left 0.35s cubic-bezier(0.4, 0, 0.2, 1);
        border-right: 1px solid #2A2A2A;
    }

    .ai-chat-drawer.active {
        left: 0;
    }

    .ai-drawer-header {
        padding: 18px 20px;
        background: #1A1A1A;
        border-bottom: 1px solid #2A2A2A;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .ai-avatar {
        width: 40px;
        height: 40px;
        background: rgba(197, 160, 89, 0.15);
        color: #C5A059;
        border: 1px solid #C5A059;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
    }

    .ai-close-btn {
        background: transparent;
        border: none;
        color: #888;
        font-size: 1.8rem;
        cursor: pointer;
        line-height: 1;
        transition: color 0.2s;
    }
    .ai-close-btn:hover { color: #fff; }

    .ai-drawer-body {
        padding: 20px;
        flex-grow: 1;
        overflow-y: auto;
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .ai-message.robot {
        align-self: flex-start;
        max-width: 90%;
    }

    .msg-bubble {
        background: #1A1A1A;
        color: #e0e0e0;
        padding: 14px 16px;
        border-radius: 12px 12px 12px 2px;
        border: 1px solid #2A2A2A;
        font-size: 0.9rem;
        line-height: 1.6;
    }

    .msg-bubble.highlight {
        border-color: #C5A059;
        background: rgba(197, 160, 89, 0.08);
        color: #f4f7f8;
    }

    .ai-drawer-footer {
        padding: 15px 20px;
        background: #1A1A1A;
        border-top: 1px solid #2A2A2A;
    }

    .ai-drawer-footer input {
        background: #121212;
        border: 1px solid #2A2A2A;
        color: #fff;
    }
    .ai-drawer-footer input:focus {
        background: #121212;
        border-color: #C5A059;
        color: #fff;
        box-shadow: none;
    }

    .btn-gold {
        background: #C5A059;
        color: #121212;
        border: none;
        font-weight: bold;
    }

    @media (max-width: 576px) {
        .ai-chat-drawer {
            max-width: 100%;
            left: -100%;
        }
    }
</style>

<script>
    function openAiChatDrawer() {
        document.getElementById('aiChatDrawer').classList.add('active');
        document.getElementById('aiDrawerOverlay').classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeAiChatDrawer() {
        document.getElementById('aiChatDrawer').classList.remove('active');
        document.getElementById('aiDrawerOverlay').classList.remove('active');
        document.body.style.overflow = 'auto';
    }
</script>