<!DOCTYPE html>
<html lang="ar" dir="rtl" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LAGHOUAT CYCLE — إنشاء حساب جديد</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@400;700;800&family=Montserrat:wght@400;500;600;700;900&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN & Palette Configuration -->
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
    @livewireStyles
    
    <style>
        svg { max-width: 100%; height: auto; }
        
        body, html {
            background-color: #0f1115 !important;
            color: #f3f4f6 !important;
            font-family: 'Almarai', sans-serif !important;
            margin: 0;
            padding: 0;
            min-height: 100vh;
        }

        .glass-card {
            background: rgba(26, 29, 35, 0.85) !important;
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(16, 185, 129, 0.15);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.8);
        }

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
    </style>
</head>
<body class="bg-[#0f1115] text-zinc-100 font-sans min-h-screen antialiased selection:bg-[#10b981] selection:text-black">

<div class="relative min-h-screen w-full flex items-center justify-center bg-[#0f1115] py-12 px-4 sm:px-6 lg:px-8 overflow-hidden">
    
    <!-- Ambient Background Glows متناسقة مع LC Pro -->
    <div class="absolute top-1/4 -right-32 w-96 h-96 bg-[#10b981]/10 rounded-full blur-[140px] pointer-events-none"></div>
    <div class="absolute bottom-1/4 -left-32 w-96 h-96 bg-[#10b981]/5 rounded-full blur-[140px] pointer-events-none"></div>

    <!-- Main Card Container -->
    <div class="relative w-full max-w-lg glass-card p-8 sm:p-10 rounded-3xl shadow-[0_30px_70px_-15px_rgba(0,0,0,0.9)] text-center my-auto transition-all duration-300">
        
        <!-- Header / Logo -->
        <div class="mb-8">
            <div class="inline-flex items-center justify-center py-2 px-6 rounded-2xl bg-[#16181d] border border-white/5 shadow-lg mb-4 mx-auto">
                <span class="font-international text-2xl font-black tracking-tighter text-white uppercase">
                    LC<span class="text-[#10b981]"> Pro</span>
                </span>
            </div>
            <h2 class="text-xl sm:text-2xl font-extrabold text-white tracking-tight">
                إنشاء حساب جديد
            </h2>
            <p class="text-xs text-gray-400 font-medium mt-1">مرحباً بك في منصة معرض ولوازم الدراجات - الأغواط سيكل</p>
        </div>

        <form wire:submit.prevent="register" class="space-y-4 text-right">
            
            <!-- Full Name -->
            <div class="space-y-1">
                <label class="text-[11px] font-bold text-gray-300 uppercase tracking-wider block mr-1">الاسم الكامل</label>
                <div class="relative">
                    <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none text-gray-500">
                        <svg style="width:16px; height:16px;" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <input wire:model="name" type="text" placeholder="الاسم واللقب" class="lc-input w-full py-3.5 pr-11 pl-4 rounded-xl text-sm font-medium">
                </div>
                @error('name') <span class="text-rose-400 text-xs mr-1 font-semibold block mt-1">{{ $message }}</span> @enderror
            </div>

            <!-- Phone & Email Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <!-- Phone Number -->
                <div class="space-y-1">
                    <label class="text-[11px] font-bold text-gray-300 uppercase tracking-wider block mr-1">رقم الهاتف</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none text-gray-500">
                            <svg style="width:16px; height:16px;" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                        </div>
                        <input wire:model="phone" type="text" placeholder="06XXXXXXXX" class="lc-input w-full py-3.5 pr-11 pl-4 rounded-xl text-sm font-medium">
                    </div>
                    @error('phone') <span class="text-rose-400 text-xs mr-1 font-semibold block mt-1">{{ $message }}</span> @enderror
                </div>

                <!-- Email Address -->
                <div class="space-y-1">
                    <label class="text-[11px] font-bold text-gray-300 uppercase tracking-wider block mr-1">البريد الإلكتروني</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none text-gray-500">
                            <svg style="width:16px; height:16px;" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <input wire:model="email" type="email" placeholder="example@email.com" class="lc-input w-full py-3.5 pr-11 pl-4 rounded-xl text-sm font-medium">
                    </div>
                    @error('email') <span class="text-rose-400 text-xs mr-1 font-semibold block mt-1">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Password -->
            <div class="space-y-1">
                <label class="text-[11px] font-bold text-gray-300 uppercase tracking-wider block mr-1">كلمة المرور</label>
                <div class="relative">
                    <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none text-gray-500">
                        <svg style="width:16px; height:16px;" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                    </div>
                    <input wire:model="password" type="password" placeholder="••••••••" class="lc-input w-full py-3.5 pr-11 pl-4 rounded-xl text-sm font-medium">
                </div>
                @error('password') <span class="text-rose-400 text-xs mr-1 font-semibold block mt-1">{{ $message }}</span> @enderror
            </div>

            <!-- Submit Button -->
            <button type="submit" class="lc-btn w-full mt-4 py-4 rounded-xl font-heavy text-xs uppercase tracking-[0.2em] shadow-xl cursor-pointer">
                إنشاء الحساب
            </button>
        </form>

        <!-- Footer Link -->
        <p class="mt-8 text-xs font-semibold text-gray-400">
            لديك حساب بالفعل؟ 
            <a href="{{ route('login') }}" class="text-[#10b981] hover:text-white underline underline-offset-4 decoration-[#10b981] transition-colors duration-200 mr-1 font-bold">
                تسجيل الدخول
            </a>
        </p>
        <p class="mt-3 text-xs font-semibold text-gray-400">
            تريد البيع؟ <a href="{{ route('seller.register') }}" class="text-[#10b981] underline">قدّم طلب حساب بائع مستقلاً</a>
        </p>
    </div>
</div>

@livewireScripts
</body>
</html>