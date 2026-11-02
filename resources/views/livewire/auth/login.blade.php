<!DOCTYPE html>
<html lang="ar" dir="rtl" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LAGHOUAT CYCLE — تسجيل الدخول</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@400;700;800&family=Montserrat:wght@400;500;600;700;900&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Almarai', '"Plus Jakarta Sans"', 'sans-serif'],
                        international: ['Montserrat', 'sans-serif'],
                    },
                    colors: {
                        lc: {
                            emerald: '#10b981',
                            deep: '#064e3b',
                            bg: '#0f1115',
                            card: '#1a1d23',
                            border: '#2a2f3a'
                        }
                    }
                }
            }
        }
    </script>

    <style>
        body, html {
            background-color: #0f1115 !important;
            color: #f3f4f6 !important;
            font-family: 'Almarai', sans-serif !important;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            letter-spacing: -0.02em;
        }

        /* Glassmorphism Background Card متوافقة مع LC Pro */
        .glass-container {
            background: rgba(26, 29, 35, 0.85) !important;
            backdrop-filter: blur(20px) !important;
            -webkit-backdrop-filter: blur(20px) !important;
            border: 1px solid rgba(16, 185, 129, 0.15) !important;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.8) !important;
        }

        /* Input Form Styles */
        .lc-input {
            background-color: #12151a !important;
            border: 1px solid #2a2f3a !important;
            color: #ffffff !important;
            transition: all 0.2s ease-in-out !important;
            direction: ltr;
            text-align: right;
        }

        .lc-input:focus {
            border-color: #10b981 !important;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.15) !important;
            outline: none !important;
        }

        .lc-input::placeholder {
            color: #64748b !important;
        }

        /* Action Button (الزر الزمردي المميز) */
        .lc-btn {
            background-color: #10b981 !important;
            color: #000000 !important;
            font-weight: 800 !important;
            transition: all 0.3s ease-in-out !important;
            border: 1px solid #10b981 !important;
        }

        .lc-btn:hover {
            background-color: transparent !important;
            color: #10b981 !important;
            box-shadow: 0 0 20px rgba(16, 185, 129, 0.25) !important;
            transform: translateY(-1px) !important;
        }

        .lc-btn:active {
            transform: translateY(0) !important;
        }
    </style>
    @livewireStyles
</head>
<body>

<div class="relative min-h-screen w-full flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 overflow-hidden">
    
    <!-- Ambient Background Glows متناسقة مع اللوحات -->
    <div class="absolute top-1/4 -right-32 w-96 h-96 bg-[#10b981]/10 rounded-full blur-[140px] pointer-events-none"></div>
    <div class="absolute bottom-1/4 -left-32 w-96 h-96 bg-[#10b981]/5 rounded-full blur-[140px] pointer-events-none"></div>

    <!-- Main Card Container -->
    <div class="glass-container relative w-full max-w-md p-8 sm:p-10 rounded-3xl text-center my-auto transition-all duration-300">
        
        <!-- Header & Brand Logo (شعار LC Pro) -->
        <div class="mb-8">
            <div class="inline-flex items-center justify-center py-2 px-6 rounded-2xl bg-[#16181d] border border-white/5 shadow-lg mb-4 mx-auto">
                <span class="font-international text-2xl font-black tracking-tighter text-white uppercase">
                    LC<span class="text-[#10b981]"> Pro</span>
                </span>
            </div>
            <h2 class="text-xl sm:text-2xl font-heavy text-white tracking-tight mt-2">
                مرحباً بعودتك
            </h2>
            <p class="text-xs text-gray-400 font-medium mt-1">سجل الدخول إلى حسابك في منصة الأغواط سيكل</p>
        </div>

        @if (session('status'))
            <div class="mb-4 rounded-xl border border-emerald-500/20 bg-emerald-500/10 p-3 text-sm text-emerald-300" role="status">
                {{ session('status') }}
            </div>
        @endif

        <!-- Livewire Form -->
        <form wire:submit.prevent="authenticate" class="space-y-5 text-right">
            
            <!-- Email or Phone Field -->
            <div class="space-y-1.5">
                <label class="text-[11px] font-bold text-gray-300 uppercase tracking-wider block mr-1">
                    رقم الهاتف أو البريد الإلكتروني
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none text-gray-500">
                        <svg class="w-4 h-4" style="width:16px; height:16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <input wire:model="login" type="text" placeholder="06XXXXXXXX / example@email.com" class="lc-input w-full py-3.5 pr-11 pl-4 rounded-xl text-sm font-medium">
                </div>
                @error('login') <span class="text-rose-400 text-xs mr-1 font-semibold block mt-1">{{ $message }}</span> @enderror
            </div>

            <!-- Password Field -->
            <div class="space-y-1.5">
                <label class="text-[11px] font-bold text-gray-300 uppercase tracking-wider block mr-1">
                    كلمة المرور
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none text-gray-500">
                        <svg class="w-4 h-4" style="width:16px; height:16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                    </div>
                    <input wire:model="password" type="password" placeholder="••••••••" class="lc-input w-full py-3.5 pr-11 pl-4 rounded-xl text-sm font-medium">
                </div>
                @error('password') <span class="text-rose-400 text-xs mr-1 font-semibold block mt-1">{{ $message }}</span> @enderror
            </div>

            <!-- Submit Button -->
            <button type="submit" class="lc-btn w-full mt-4 py-4 rounded-xl font-heavy text-xs uppercase tracking-[0.2em] shadow-xl cursor-pointer">
                تسجيل الدخول الآمن
            </button>
        </form>

        <!-- Register Link -->
        <p class="mt-8 text-xs font-semibold text-gray-400">
            ليس لديك حساب؟ 
            <a href="{{ route('register') }}" class="text-[#10b981] hover:text-white underline underline-offset-4 decoration-[#10b981] transition-colors font-bold mr-1">
                إنشاء حساب جديد
            </a>
        </p>
        <p class="mt-4 text-xs font-semibold text-gray-400">
            بائع؟ <a href="{{ route('seller.login') }}" class="text-[#10b981] underline">دخول بوابة البائع</a>
            <span class="mx-1">·</span>
            <a href="{{ route('seller.register') }}" class="text-[#10b981] underline">طلب حساب بائع</a>
        </p>
    </div>
</div>

@livewireScripts
</body>
</html>