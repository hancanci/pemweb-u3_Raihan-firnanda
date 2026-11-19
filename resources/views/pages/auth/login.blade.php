
<x-layouts::auth :title="__('Masuk')">

    <div class="flex flex-col gap-6">

        <x-auth-header
            :title="__('Selamat Datang di RuangBaca')"
            :description="__('Masuk untuk membaca dan mengelola artikel kamu')"
        />

        {{-- Notifikasi login --}}
        <x-auth-session-status
            class="text-center"
            :status="session('status')"
        />

        {{-- Pesan kesalahan --}}
        @if ($errors->any())
            <div class="rounded-lg bg-red-50 p-4 text-sm text-red-700">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        {{-- Form Login --}}
        <form
            method="POST"
            action="{{ route('login.store') }}"
            class="flex flex-col gap-6"
        >
            @csrf

            <flux:input
                name="email"
                :label="__('Alamat Email')"
                :value="old('email')"
                type="email"
                required
                autofocus
                autocomplete="email"
                placeholder="email@example.com"
            />

            <flux:input
                name="password"
                :label="__('Password')"
                type="password"
                required
                autocomplete="current-password"
                placeholder="Masukkan password"
                viewable
            />

            <flux:checkbox
                name="remember"
                :label="__('Ingat saya')"
                :checked="old('remember')"
            />

            <flux:button
                variant="primary"
                type="submit"
                class="w-full"
            >
                Masuk ke RuangBaca →
            </flux:button>

        </form>

        {{-- Link Register --}}
        <div class="text-center text-sm text-zinc-600 dark:text-zinc-400">

            Belum mempunyai akun?

            <flux:link :href="route('register')">
                Daftar sekarang
            </flux:link>

        </div>

        <div class="text-center text-xs text-zinc-400">
            © {{ date('Y') }} RuangBaca
        </div>

    </div>

</x-layouts::auth>
