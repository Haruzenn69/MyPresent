<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="text-center mb-4">
            <h4 class="fw-bold mb-1">Daftar</h4>
            <p class="text-muted small mb-0">Buat akun baru Anda</p>
        </div>

        <div class="form-floating mb-3">
            <input type="text" class="form-control form-control-lg rounded-3" id="name" placeholder="Nama Lengkap" name="name" value="{{ old('name') }}" required autocomplete="name">
            <label for="name">{{ __('Name') }}</label>
        </div>
        <x-input-error :messages="$errors->get('name')" class="mb-3" />

        <div class="form-floating mb-3">
            <input type="email" class="form-control form-control-lg rounded-3" id="email" placeholder="name@example.com" name="email" value="{{ old('email') }}" required autocomplete="username">
            <label for="email">Email</label>
        </div>
        <x-input-error :messages="$errors->get('email')" class="mb-3" />

        <div class="form-floating mb-3">
            <input type="password" class="form-control form-control-lg rounded-3" id="password" placeholder="Password" name="password" required autocomplete="new-password">
            <label for="password">{{ __('Password') }}</label>
        </div>
        <x-input-error :messages="$errors->get('password')" class="mb-3" />

        <div class="form-floating mb-3">
            <input type="password" class="form-control form-control-lg rounded-3" id="password_confirmation" placeholder="Konfirmasi Password" name="password_confirmation" required autocomplete="new-password">
            <label for="password_confirmation">{{ __('Confirm Password') }}</label>
        </div>

        <button type="submit" class="btn btn-primary w-100 py-3 rounded-3 fw-semibold mb-3">
            {{ __('Register') }}
        </button>

        <div class="text-center">
            <a class="text-decoration-none small" href="{{ route('login') }}" style="color:#0D9488;">
                {{ __('Already registered?') }}
            </a>
        </div>
    </form>
</x-guest-layout>
