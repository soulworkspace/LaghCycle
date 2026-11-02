<div class="min-h-screen bg-[#0a0a0a] py-12 text-white">
    <div class="container mx-auto px-4 lg:px-8">
        
        {{-- Header Section --}}
        <div class="flex flex-col md:flex-row justify-between items-center md:items-end mb-16 gap-8 text-center md:text-right">
            <div>
                <span class="text-emerald-500 font-black tracking-[0.4em] text-xs block uppercase mb-3">Laghouat Cycle</span>
                <h1 class="text-6xl md:text-7xl font-black uppercase italic tracking-tighter">
                    سوق <span class="text-emerald-500">الدراجات</span>
                </h1>
                <p class="text-zinc-500 mt-2 text-sm font-medium tracking-widest">دراجات هوائية ونارية وسكوترات للبيع</p>
            </div>
            
            {{-- Search & Filter --}}
            <div class="flex flex-col sm:flex-row gap-4 w-full md:w-auto">
                <div class="relative group">
                    <input wire:model.live.debounce.500ms="search" type="text" placeholder="ابحث عن دراجة أو سكوتر..." 
                           class="bg-white/5 border border-white/10 px-8 py-4 rounded-full text-sm w-full md:w-80 outline-none focus:border-emerald-500/50 transition-all placeholder:text-zinc-600">
                    <div class="absolute left-6 top-1/2 -translate-y-1/2 text-zinc-500 group-focus-within:text-emerald-500 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>
                
                <select wire:model.live="sortBy" class="bg-zinc-900 border border-white/10 text-zinc-300 text-[11px] font-bold px-8 py-4 rounded-full outline-none uppercase cursor-pointer hover:border-emerald-500/50 transition-all appearance-none">
                    <option value="latest">الأحدث</option>
                    <option value="price_asc">السعر: من الأقل</option>
                    <option value="price_desc">السعر: من الأعلى</option>
                </select>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
            {{-- Sidebar Filter --}}
            <aside class="lg:col-span-3">
                <div class="sticky top-8 space-y-8">
                    <div class="bg-white/[0.03] border border-white/5 p-8 rounded-[2rem] backdrop-blur-sm">
                        <h3 class="text-white font-black text-xs uppercase tracking-[0.2em] mb-8 flex items-center gap-3">
                            <span class="w-8 h-[1px] bg-emerald-500"></span>
                            التصنيفات
                        </h3>
                        <ul class="space-y-5">
                            <li>
                                <button wire:click="$set('category', null)" 
                                        class="group flex items-center justify-between w-full text-xs font-bold uppercase transition-all {{ is_null($category) ? 'text-emerald-500' : 'text-zinc-500 hover:text-white' }}">
                                    <span>جميع الدراجات</span>
                                    <span class="w-1.5 h-1.5 rounded-full {{ is_null($category) ? 'bg-emerald-500' : 'bg-transparent' }}"></span>
                                </button>
                            </li>
                            @foreach($categories as $cat)
                                <li>
                                    <button wire:click="$set('category', '{{ $cat->slug }}')" 
                                            class="group flex items-center justify-between w-full text-xs font-bold uppercase transition-all {{ $category == $cat->slug ? 'text-emerald-500' : 'text-zinc-500 hover:text-white' }}">
                                        <span>{{ $cat->name }}</span>
                                        <span class="w-1.5 h-1.5 rounded-full {{ $category == $cat->slug ? 'bg-emerald-500' : 'bg-transparent' }}"></span>
                                    </button>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    {{-- Quick Promotion Card --}}
                    <a href="{{ route('seller.register') }}" class="block bg-emerald-500 p-8 rounded-[2rem] relative overflow-hidden group cursor-pointer text-decoration-none">
                        <div class="relative z-10">
                            <h4 class="text-black font-black text-xl leading-tight mb-2">اعرض دراجتك للبيع</h4>
                            <p class="text-black/60 text-xs font-bold uppercase tracking-tighter">انضم إلى البائعين في Laghouat Cycle</p>
                        </div>
                        <div class="absolute -right-4 -bottom-4 opacity-20 group-hover:scale-110 transition-transform duration-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-32 w-32" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                            </svg>
                        </div>
                    </div>
                    </a>
                </div>
            </aside>

            {{-- Product Grid --}}
            <main class="lg:col-span-9">
                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-8">
                    @forelse($ads as $ad)
                        <div class="group relative">
                            <x-IBM.car :ad="$ad" />
                        </div>
                    @empty
                        <div class="col-span-full py-32 text-center border border-dashed border-white/10 rounded-[3rem] bg-white/[0.01]">
                            <div class="mb-6 opacity-20 flex justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="0.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                            <p class="text-zinc-500 font-bold uppercase tracking-[0.3em] text-xs">لا توجد دراجات مطابقة لهذا البحث</p>
                        </div>
                    @endforelse
                </div>

                {{-- Pagination --}}
                <div class="mt-24">
                    {{ $ads->links() }}
                </div>
            </main>
        </div>
    </div>
</div>