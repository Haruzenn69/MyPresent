<x-guest-layout>
    <x-auth-session-status :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="text-center mb-4">
            <h4 class="fw-bold mb-1">Masuk</h4>
            <p class="text-muted small mb-0">Masuk ke akun Anda</p>
        </div>

        <div class="mb-3">
            <input type="email" class="form-control rounded-pill" id="email" placeholder="name@example.com" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
        </div>
        <x-input-error :messages="$errors->get('email')" class="mb-3" />

        <div class="mb-3">
            <input type="password" class="form-control rounded-pill" id="password" placeholder="Password" name="password" required autocomplete="current-password">
        </div>
        <x-input-error :messages="$errors->get('password')" class="mb-3" />

        @if (Route::has('password.request'))
            <div class="text-center mb-3">
                <a class="text-decoration-none small" href="{{ route('password.request') }}" style="color:#0D9488;">
                    {{ __('Forgot your password?') }}
                </a>
            </div>
        @endif

        <button type="submit" class="btn btn-primary w-100 rounded-pill fw-semibold" style="height:44px;font-size:14px;">
            {{ __('Log in') }}
        </button>
    </form>
</x-guest-layout>
