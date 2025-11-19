<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            Logout Akun
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Selesai mengelola akun Anda? Anda bisa logout dengan aman di sini.
        </p>
    </header>

    <form method="POST" action="{{ route('logout') }}">
        @csrf

        <x-danger-button>
            Logout
        </x-danger-button>
    </form>
</section>