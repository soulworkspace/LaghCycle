<section class="container py-5" dir="rtl">
    <div class="mx-auto card p-4 shadow-sm" style="max-width: 36rem;">
        <h1 class="h3 mb-2">طلب إنشاء حساب بائع</h1>
        <p class="text-muted mb-4">تتم مراجعة الطلب قبل تفعيل دخول لوحة البائع.</p>

        <form wire:submit="register" class="d-grid gap-3">
            <div>
                <label for="seller-name" class="form-label">الاسم الكامل</label>
                <input id="seller-name" wire:model="name" type="text" class="form-control" autocomplete="name" required>
                @error('name') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
            </div>

            <div>
                <label for="seller-phone" class="form-label">رقم الهاتف</label>
                <input id="seller-phone" wire:model="phone" type="tel" class="form-control" autocomplete="tel" required>
                @error('phone') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
            </div>

            <div>
                <label for="seller-email" class="form-label">البريد الإلكتروني</label>
                <input id="seller-email" wire:model="email" type="email" class="form-control" autocomplete="email" required>
                @error('email') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
            </div>

            <div>
                <label for="seller-password" class="form-label">كلمة المرور</label>
                <input id="seller-password" wire:model="password" type="password" class="form-control" autocomplete="new-password" required>
                @error('password') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
            </div>

            <div>
                <label for="seller-password-confirmation" class="form-label">تأكيد كلمة المرور</label>
                <input id="seller-password-confirmation" wire:model="password_confirmation" type="password" class="form-control" autocomplete="new-password" required>
            </div>

            <button type="submit" class="btn btn-primary">إرسال الطلب للمراجعة</button>
        </form>

        <p class="mt-4 mb-0">لديك حساب معتمد؟ <a href="{{ route('seller.login') }}">دخول البائع</a></p>
        <p class="mt-2 mb-0">تبحث عن حساب عميل؟ <a href="{{ route('register') }}">إنشاء حساب عميل</a></p>
    </div>
</section>
