<section class="container py-5" dir="rtl">
    <div class="mx-auto card p-4 shadow-sm" style="max-width: 32rem;">
        <h1 class="h3 mb-2">دخول بوابة البائع</h1>
        <p class="text-muted mb-4">استخدم بيانات حساب البائع المعتمد.</p>

        @if (session('status'))
            <div class="alert alert-info" role="status">{{ session('status') }}</div>
        @endif

        <form wire:submit="authenticate" class="d-grid gap-3">
            <div>
                <label for="seller-login" class="form-label">البريد الإلكتروني أو الهاتف</label>
                <input id="seller-login" wire:model="login" type="text" class="form-control" autocomplete="username" required>
                @error('login') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
            </div>

            <div>
                <label for="seller-password" class="form-label">كلمة المرور</label>
                <input id="seller-password" wire:model="password" type="password" class="form-control" autocomplete="current-password" required>
                @error('password') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
            </div>

            <label class="form-check">
                <input wire:model="remember" type="checkbox" class="form-check-input">
                <span class="form-check-label">تذكرني</span>
            </label>

            <button type="submit" class="btn btn-primary">دخول البائع</button>
        </form>

        <p class="mt-4 mb-0">ليس لديك حساب بائع؟
            <a href="{{ route('seller.register') }}">قدّم طلب انضمام</a>
        </p>
        <p class="mt-2 mb-0">عميل؟ <a href="{{ route('login') }}">دخول العملاء</a></p>
    </div>
</section>
