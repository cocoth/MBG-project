@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto">
    <!-- Header -->
    <div class="mb-6">
        <a href="{{ route('user.profile') }}" class="inline-flex items-center text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white mb-4">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali ke Profile
        </a>
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white/90">Edit Profile</h1>
        <p class="text-gray-600 dark:text-gray-400 mt-1">Perbarui informasi akun Anda</p>
    </div>

    <!-- Form -->
    <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/3 p-6">
        <form action="{{ route('user.profile.update') }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Profile Info -->
            <div class="mb-6 flex items-center gap-4 pb-6 border-b border-gray-200 dark:border-gray-700">
                <div class="w-16 h-16 rounded-full bg-gradient-to-br from-purple-400 to-indigo-500 flex items-center justify-center text-white font-bold text-2xl">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
                <div>
                    <h3 class="font-semibold text-gray-900 dark:text-white/90">{{ $user->name }}</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Bergabung {{ $user->created_at->format('d M Y') }}</p>
                </div>
            </div>

            <!-- Name -->
            <div class="mb-5">
                <label for="name" class="block text-sm font-medium text-gray-900 dark:text-white/90 mb-2">
                    Nama Lengkap <span class="text-red-500">*</span>
                </label>
                <input
                    type="text"
                    name="name"
                    id="name"
                    value="{{ old('name', $user->name) }}"
                    class="w-full px-4 py-2.5 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-lg text-gray-900 dark:text-white/90 placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-purple-500 focus:border-transparent transition @error('name') border-red-500 @enderror"
                    placeholder="Masukkan nama lengkap"
                    required
                >
                @error('name')
                    <p class="mt-1.5 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-5">
                <label for="email" class="block text-sm font-medium text-gray-900 dark:text-white/90 mb-2">
                    Email <span class="text-red-500">*</span>
                </label>
                <input
                    type="email"
                    name="email"
                    id="email"
                    value="{{ old('email', $user->email) }}"
                    class="w-full px-4 py-2.5 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-lg text-gray-900 dark:text-white/90 placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-purple-500 focus:border-transparent transition @error('email') border-red-500 @enderror"
                    placeholder="email@example.com"
                    required
                >
                @error('email')
                    <p class="mt-1.5 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Divider -->
            <div class="my-6 border-t border-gray-200 dark:border-gray-700"></div>

            <!-- Password Section -->
            <div class="mb-4">
                <h3 class="text-sm font-medium text-gray-900 dark:text-white/90 mb-1">Ubah Password</h3>
                <p class="text-xs text-gray-500 dark:text-gray-400">Kosongkan jika tidak ingin mengubah password</p>
            </div>

            <!-- Password -->
            <div class="mb-5">
                <label for="password" class="block text-sm font-medium text-gray-900 dark:text-white/90 mb-2">
                    Password Baru
                </label>
                <input
                    type="password"
                    name="password"
                    id="password"
                    class="w-full px-4 py-2.5 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-lg text-gray-900 dark:text-white/90 placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-purple-500 focus:border-transparent transition @error('password') border-red-500 @enderror"
                    placeholder="Minimal 8 karakter"
                >
                @error('password')
                    <p class="mt-1.5 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password Confirmation -->
            <div class="mb-6">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-900 dark:text-white/90 mb-2">
                    Konfirmasi Password Baru
                </label>
                <input
                    type="password"
                    name="password_confirmation"
                    id="password_confirmation"
                    class="w-full px-4 py-2.5 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-lg text-gray-900 dark:text-white/90 placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-purple-500 focus:border-transparent transition"
                    placeholder="Ulangi password baru"
                >
            </div>

            <!-- Info Box -->
            <div class="mb-6 p-4 bg-purple-50 dark:bg-purple-900/20 border border-purple-200 dark:border-purple-800 rounded-lg">
                <div class="flex gap-3">
                    <svg class="w-5 h-5 text-purple-600 dark:text-purple-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div>
                        <p class="text-sm font-medium text-purple-900 dark:text-purple-300 mb-1">Informasi Penting</p>
                        <p class="text-sm text-purple-800 dark:text-purple-400">Pastikan email yang Anda gunakan masih aktif. Password harus minimal 8 karakter untuk keamanan akun Anda.</p>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex items-center gap-3">
                <button
                    type="submit"
                    class="flex-1 px-4 py-2.5 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition font-medium"
                >
                    Simpan Perubahan
                </button>
                <a
                    href="{{ route('user.profile') }}"
                    class="flex-1 px-4 py-2.5 bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-700 transition font-medium text-center"
                >
                    Batal
                </a>
            </div>
        </form>
    </div>

    <!-- Account Info -->
    <div class="mt-4 rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/3 p-4">
        <div class="flex items-center justify-between text-sm">
            <div>
                <p class="text-gray-600 dark:text-gray-400">Role</p>
                <p class="text-gray-900 dark:text-white/90 font-medium capitalize">{{ $user->role }}</p>
            </div>
            <div class="text-right">
                <p class="text-gray-600 dark:text-gray-400">Terakhir login</p>
                <p class="text-gray-900 dark:text-white/90 font-medium">{{ $user->updated_at->diffForHumans() }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
