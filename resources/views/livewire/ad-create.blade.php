<div class="ad-create-page" dir="rtl">
    <style>
        /* فرض نظام ألوان LC Pro العالمي بشكل ثابت ومنع أي تعارض خارجي */
        .ad-create-page {
            --lc-accent: #10b981;
            --lc-accent-hover: #059669;
            --lc-bg: #0f1115;
            --lc-card: #1a1d23;
            --lc-input-bg: #12151a;
            --lc-border: #2a2f3a;
            --lc-text-main: #f3f4f6;
            --lc-text-muted: #9ca3af;
            
            min-height: 100vh !important;
            padding: 3rem 0 !important;
            color: var(--lc-text-main) !important;
            background: radial-gradient(circle at 15% 0%, rgba(16, 185, 129, 0.08) 0%, transparent 35rem), var(--lc-bg) !important;
            font-family: 'Almarai', sans-serif;
        }

        .ad-create-page h1,
        .ad-create-page h2,
        .ad-create-page h3,
        .ad-create-page .fw-bold {
            color: #ffffff !important;
        }

        .ad-create-page .text-secondary,
        .ad-create-page .form-label,
        .ad-create-page p,
        .ad-create-page small:not(.text-danger) {
            color: var(--lc-text-muted) !important;
        }

        .ad-create-page .create-card {
            border: 1px solid rgba(255, 255, 255, 0.07) !important;
            border-radius: 1.25rem !important;
            background-color: var(--lc-card) !important;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.6) !important;
        }

        .ad-create-page .section-title {
            border-right: 3.5px solid var(--lc-accent) !important;
            padding-right: 0.85rem !important;
            color: #ffffff !important;
        }

        .ad-create-page .form-control,
        .ad-create-page .form-select {
            min-height: 3.1rem !important;
            color: #ffffff !important;
            background-color: var(--lc-input-bg) !important;
            border: 1px solid var(--lc-border) !important;
            border-radius: 0.75rem !important;
            box-shadow: none !important;
            transition: all 0.2s ease-in-out !important;
        }

        .ad-create-page .form-select {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%239ca3af' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e") !important;
            background-repeat: no-repeat !important;
            background-position: left 0.85rem center !important;
            background-size: 14px 10px !important;
            padding-left: 2.5rem !important;
        }

        .ad-create-page .form-select option,
        .ad-create-page .form-select optgroup {
            background-color: #1a1d23 !important;
            color: #f3f4f6 !important;
        }

        .ad-create-page .form-control:focus,
        .ad-create-page .form-select:focus {
            color: #ffffff !important;
            background-color: #161a22 !important;
            border-color: var(--lc-accent) !important;
            box-shadow: 0 0 0 0.22rem rgba(16, 185, 129, 0.18) !important;
            outline: none !important;
        }

        .ad-create-page .form-control::placeholder {
            color: #64748b !important;
            opacity: 1 !important;
        }

        .ad-create-page input:-webkit-autofill,
        .ad-create-page input:-webkit-autofill:hover,
        .ad-create-page input:-webkit-autofill:focus,
        .ad-create-page textarea:-webkit-autofill {
            -webkit-text-fill-color: #ffffff !important;
            -webkit-box-shadow: 0 0 0px 1000px #12151a inset !important;
            transition: background-color 5000s ease-in-out 0s !important;
        }

        .ad-create-page .upload-zone {
            border: 2px dashed #333a48 !important;
            border-radius: 1rem !important;
            background-color: rgba(255, 255, 255, 0.02) !important;
            transition: border-color 0.2s, background-color 0.2s, transform 0.2s !important;
        }

        .ad-create-page .upload-zone:hover,
        .ad-create-page .upload-zone.is-dragging {
            border-color: var(--lc-accent) !important;
            background-color: rgba(16, 185, 129, 0.06) !important;
            transform: translateY(-2px);
        }

        .ad-create-page .preview-card {
            position: relative;
            overflow: hidden;
            border: 1px solid var(--lc-border) !important;
            border-radius: 0.9rem !important;
            background-color: var(--lc-input-bg) !important;
        }

        .ad-create-page .preview-card.is-primary {
            border-color: var(--lc-accent) !important;
            box-shadow: 0 0 0 0.15rem rgba(16, 185, 129, 0.3) !important;
        }

        .ad-create-page .preview-card img {
            width: 100%;
            height: 8rem;
            object-fit: cover;
        }

        .ad-create-page .preview-actions {
            position: absolute;
            inset: 0.5rem 0.5rem auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .ad-create-page .icon-action {
            width: 2rem;
            height: 2rem;
            padding: 0;
            border: 0;
            border-radius: 50%;
            color: #ffffff !important;
            background-color: rgba(0, 0, 0, 0.7) !important;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
        }

        .ad-create-page .icon-action:hover {
            color: #ffffff !important;
            background-color: #f43f5e !important;
        }

        .ad-create-page .primary-label {
            display: block;
            padding: 0.55rem;
            color: var(--lc-text-muted) !important;
            font-size: 0.75rem;
            cursor: pointer;
            text-align: center;
            background: transparent !important;
        }

        .ad-create-page .preview-card.is-primary .primary-label {
            color: var(--lc-accent) !important;
            font-weight: 700 !important;
        }

        .ad-create-page .badge-primary-img {
            background-color: rgba(16, 185, 129, 0.2) !important;
            color: #10b981 !important;
            border: 1px solid rgba(16, 185, 129, 0.4) !important;
            padding: 0.25rem 0.6rem;
            border-radius: 999px;
            font-size: 0.7rem;
            font-weight: 700;
        }

        .ad-create-page .progress {
            height: 0.45rem !important;
            background-color: var(--lc-border) !important;
            border-radius: 999px !important;
        }

        .ad-create-page .progress-bar {
            background-color: var(--lc-accent) !important;
            transition: width 0.2s ease;
        }

        .ad-create-page .btn-create {
            border: 1px solid var(--lc-accent) !important;
            color: #000000 !important;
            background-color: var(--lc-accent) !important;
            font-weight: 800 !important;
            border-radius: 0.75rem !important;
            transition: all 0.3s ease !important;
        }

        .ad-create-page .btn-create:hover {
            color: var(--lc-accent) !important;
            background-color: transparent !important;
            box-shadow: 0 0 20px rgba(16, 185, 129, 0.25) !important;
        }

        .ad-create-page .text-danger {
            color: #f43f5e !important;
        }

        [x-cloak] {
            display: none !important;
        }
    </style>

    <div class="container">
        <div class="mb-5 text-center">
            <span class="text-uppercase small fw-bold" style="color: var(--lc-accent) !important; letter-spacing: .18em;">LAGHOUAT CYCLE</span>
            <h1 class="display-6 fw-bold mt-2">أضف دراجتك للبيع أو العرض</h1>
            <p class="text-secondary mb-0">أدخل معلومات الدراجة أو السكوتر وارفع صوراً واضحة ليظهر إعلانك بأفضل صورة.</p>
        </div>

        <form wire:submit="save" class="create-card p-3 p-md-5" enctype="multipart/form-data">
            <section class="mb-5">
                <h2 class="section-title h5 fw-bold mb-4">المعلومات الأساسية</h2>
                <div class="row g-4">
                    <div class="col-12">
                        <label class="form-label text-secondary">عنوان الإعلان *</label>
                        <input wire:model.blur="title" type="text" class="form-control" placeholder="مثال: دراجة جبلية أو سكوتر بحالة ممتازة">
                        @error('title') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-secondary">الفئة *</label>
                        <select wire:model.live="category_id" class="form-select">
                            <option value="">اختر الفئة</option>
                            <?php foreach($categories as$category): ?>
                                <optgroup label="{{ $category->name }}">
                                    <?php foreach($category->children as$child): ?>
                                        <option value="{{ $child->id }}">{{ $child->name }}</option>
                                    <?php endforeach; ?>
                                </optgroup>
                            <?php endforeach; ?>
                        </select>
                        @error('category_id') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-secondary">سنة الصنع *</label>
                        <input wire:model="year" type="number" min="1900" max="{{ now()->year + 1 }}" class="form-control" placeholder="2024">
                        @error('year') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-secondary">الحالة *</label>
                        <select wire:model="condition" class="form-select">
                            <option value="new">جديدة (0 كم)</option>
                            <option value="used">مستعملة</option>
                            <option value="refurbished">مجدّدة / ممتازة</option>
                        </select>
                    </div>
                    @if($this->selectedCategoryType === 'motorcycle')
                        <div class="col-md-6">
                            <label class="form-label text-secondary">سعة المحرك (CC)</label>
                            <input wire:model="engine_cc" type="number" min="1" max="3000" class="form-control" placeholder="مثال: 125، 150، 49">
                            @error('engine_cc') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    @endif
                </div>
            </section>

            <section class="mb-5">
                <h2 class="section-title h5 fw-bold mb-4">المواصفات والسعر</h2>
                <div class="row g-4">
                    <div class="col-md-3">
                        <label class="form-label text-secondary">
                            المسافة المقطوعة (كم) {{ $this->selectedCategoryType === 'motorcycle' ? '*' : '(اختياري)' }}
                        </label>
                        <input wire:model="mileage" type="number" min="0" class="form-control" placeholder="0">
                        @error('mileage') <small class="text-danger d-block">{{ $message }}</small> @enderror
                    </div>
                    <div class="col-md-3">
                        @if($this->selectedCategoryType === 'motorcycle')
                            <label class="form-label text-secondary">ناقل الحركة *</label>
                            <select wire:model="transmission" class="form-select">
                                <option value="automatic">أوتوماتيك</option>
                                <option value="manual">عادي</option>
                                <option value="semi-automatic">نصف أوتوماتيك</option>
                            </select>
                        @else
                            <label class="form-label text-secondary">عدد السرعات (اختياري)</label>
                            <input wire:model="transmission" type="text" maxlength="50" class="form-control" placeholder="مثال: 21 سرعة">
                        @endif
                        @error('transmission') <small class="text-danger d-block">{{ $message }}</small> @enderror
                    </div>
                    <div class="col-md-3">
                        <label class="form-label text-secondary">نوع الدراجة / المحرك *</label>
                        <select wire:model="fuel_type" class="form-select">
                            @if($this->selectedCategoryType === 'bicycle')
                                <option value="none">هوائية</option>
                                <option value="electric">كهربائية</option>
                            @elseif($this->selectedCategoryType === 'motorcycle')
                                <option value="gasoline">بنزين</option>
                                <option value="electric">كهربائية</option>
                            @else
                                <option value="gasoline">بنزين</option>
                                <option value="electric">كهربائية</option>
                                <option value="none">هوائية</option>
                            @endif
                        </select>
                        @error('fuel_type') <small class="text-danger d-block">{{ $message }}</small> @enderror
                    </div>
                    <div class="col-md-3">
                        <label class="form-label text-secondary">السعر (د.ج)</label>
                        <input wire:model="price" type="number" min="0" class="form-control" placeholder="مثال: 250000">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-secondary">نوع السعر *</label>
                        <select wire:model="price_type" class="form-select">
                            <option value="fixed">ثابت</option>
                            <option value="negotiable">قابل للتفاوض</option>
                            <option value="free">على السوم / بدون سعر</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-secondary">البلدية / المدينة</label>
                        <input wire:model="city" type="text" class="form-control" placeholder="الأغواط، أفلو...">
                    </div>
                </div>
            </section>

            <!-- تم وضع x-data هنا في الـ section الأب ليشمل كلاً من منطقة الرفع وشريط التقدم -->
            <section class="mb-5" 
                     x-data="{ dragging: false, progress: 0 }" 
                     x-on:livewire-upload-start.window="progress = 0"
                     x-on:livewire-upload-progress.window="progress = $event.detail.progress" 
                     x-on:livewire-upload-finish.window="progress = 100" 
                     x-on:livewire-upload-error.window="progress = 0">
                
                <h2 class="section-title h5 fw-bold mb-4">الوصف والصور</h2>
                <textarea wire:model="description" rows="5" class="form-control mb-4" placeholder="اذكر حالة الدراجة، مواصفاتها، التجهيزات الإضافية وأي ملاحظات تهم المشتري..."></textarea>
                @error('description') <small class="text-danger d-block mb-3">{{ $message }}</small> @enderror

                <div class="upload-zone p-4 text-center" 
                     :class="{ 'is-dragging': dragging }" 
                     x-on:dragover.prevent="dragging = true" 
                     x-on:dragleave.prevent="dragging = false" 
                     x-on:drop.prevent="dragging = false; $wire.uploadMultiple('images', Array.from($event.dataTransfer.files))">
                    <input id="ad-images" wire:model="images" type="file" multiple accept=".jpg,.jpeg,.png,.webp,.gif,.heic,.svg,.avif,image/*" class="d-none">
                    <label for="ad-images" class="d-block mb-0" style="cursor: pointer;">
                        <i class="fas fa-cloud-arrow-up fs-1 mb-3" style="color: var(--lc-accent) !important;"></i>
                        <div class="fw-bold">اسحب صور الدراجة هنا أو اضغط للاختيار</div>
                        <small class="text-secondary">حتى 12 صورة، بحد أقصى 5MB للصورة · JPG, PNG, WEBP, GIF, HEIC, SVG, AVIF</small>
                    </label>
                </div>
                @error('images') <small class="text-danger d-block mt-2">{{ $message }}</small> @enderror
                @error('images.*') <small class="text-danger d-block mt-2">{{ $message }}</small> @enderror

                <div wire:loading wire:target="images" class="mt-3 w-100" x-show="progress > 0" x-cloak>
                    <div class="d-flex justify-content-between small text-secondary mb-1">
                        <span>جاري رفع الصور...</span>
                        <span x-text="`${Math.round(progress)}%`">0%</span>
                    </div>
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" :style="`width: ${progress}%`" :aria-valuenow="progress" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>

                <?php if(count($images)): ?>
                    <div class="row g-3 mt-3">
                        <?php foreach($images as $index =>$image): ?>
                            <div class="col-6 col-md-3">
                                <div class="preview-card {{ $primaryImage ===$index ? 'is-primary' : '' }}">
                                    <img src="{{ $image->temporaryUrl() }}" alt="معاينة الصورة {{ $index + 1 }}">
                                    <div class="preview-actions">
                                        <button type="button" wire:click="removeImage({{ $index }})" class="icon-action" aria-label="حذف الصورة">
                                            <i class="fas fa-times"></i>
                                        </button>
                                        <?php if($primaryImage ===$index): ?>
                                            <span class="badge-primary-img">رئيسية</span>
                                        <?php endif; ?>
                                    </div>
                                    <button type="button" wire:click="setPrimaryImage({{ $index }})" class="primary-label w-100 border-0 bg-transparent">
                                        {{ $primaryImage ===$index ? 'الصورة الرئيسية' : 'تعيين كرئيسية' }}
                                    </button>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </section>

            <section class="mb-4">
                <h2 class="section-title h5 fw-bold mb-4">بيانات التواصل والمنطقة</h2>
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label text-secondary">رقم الهاتف *</label>
                        <input wire:model="contact_phone" type="text" class="form-control" placeholder="06XXXXXXXX">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-secondary">رقم الواتساب</label>
                        <input wire:model="contact_whatsapp" type="text" class="form-control" placeholder="06XXXXXXXX">
                    </div>
                    <div class="col-12">
                        <label class="form-label text-secondary">العنوان / الحي</label>
                        <input wire:model="location" type="text" class="form-control" placeholder="الأغواط - وسط المدينة">
                    </div>
                </div>
            </section>

            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between gap-3 border-top pt-4" style="border-color: var(--lc-border) !important;">
                <span class="small text-secondary">
                    <i class="fas fa-shield-halved me-1" style="color: var(--lc-accent) !important;"></i>
                    يخضع الإعلان للمراجعة والتأكيد قبل الظهور في المعرض
                </span>
                <button type="submit" class="btn btn-create px-5 py-3" wire:loading.attr="disabled" wire:target="save">
                    <span wire:loading.remove wire:target="save"><i class="fas fa-paper-plane me-1"></i> نشر إعلان الدراجة</span>
                    <span wire:loading wire:target="save"><i class="fas fa-spinner fa-spin me-1"></i> جاري الحفظ...</span>
                </button>
            </div>
        </form>
    </div>
</div>