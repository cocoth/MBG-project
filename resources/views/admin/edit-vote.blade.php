@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white/90">Edit Menu Voting</h1>
        <p class="text-gray-600 dark:text-gray-400 mt-2">Update informasi menu voting</p>
    </div>

    <!-- Form -->
    <div class="bg-white dark:bg-white/3 rounded-2xl border border-gray-200 dark:border-gray-800 p-6 md:p-8">
        <form action="{{ route('admin.menus.update', $menu) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Title -->
            <div class="mb-6">
                <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Judul Menu <span class="text-red-500">*</span>
                </label>
                <input type="text"
                       name="title"
                       id="title"
                       value="{{ old('title', $menu->title) }}"
                       class="w-full px-4 py-3 border border-gray-300 dark:border-gray-700 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent dark:bg-gray-800 dark:text-white"
                       required>
                @error('title')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div class="mb-6">
                <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Deskripsi Menu <span class="text-red-500">*</span>
                </label>
                <textarea name="description"
                          id="description"
                          rows="4"
                          class="w-full px-4 py-3 border border-gray-300 dark:border-gray-700 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent dark:bg-gray-800 dark:text-white"
                          required>{{ old('description', $menu->description) }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Current Image -->
            @if($menu->image_path)
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Foto Saat Ini
                    </label>
                    <img src="{{ asset('storage/' . $menu->image_path) }}"
                         alt="{{ $menu->title }}"
                         class="max-w-xs rounded-lg shadow-lg">
                </div>
            @endif

            <!-- Image Upload -->
            <div class="mb-6">
                <label for="image" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Ganti Foto (opsional)
                </label>
                <input type="file"
                       name="image"
                       id="image"
                       accept="image/*"
                       class="w-full px-4 py-3 border border-gray-300 dark:border-gray-700 rounded-lg dark:bg-gray-800 dark:text-white"
                       onchange="previewImage(event)">
                <div id="imagePreview" class="mt-4 hidden">
                    <img src="" alt="Preview" class="max-w-xs rounded-lg shadow-lg">
                </div>
                @error('image')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Date Range -->
            <div class="grid md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="vote_start" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Tanggal Mulai Voting <span class="text-red-500">*</span>
                    </label>
                    <input type="datetime-local"
                           name="vote_start"
                           id="vote_start"
                           value="{{ old('vote_start', $menu->vote_start->format('Y-m-d\TH:i')) }}"
                           class="w-full px-4 py-3 border border-gray-300 dark:border-gray-700 rounded-lg focus:ring-2 focus:ring-purple-500 dark:bg-gray-800 dark:text-white"
                           required>
                    @error('vote_start')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="vote_end" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Tanggal Selesai Voting <span class="text-red-500">*</span>
                    </label>
                    <input type="datetime-local"
                           name="vote_end"
                           id="vote_end"
                           value="{{ old('vote_end', $menu->vote_end->format('Y-m-d\TH:i')) }}"
                           class="w-full px-4 py-3 border border-gray-300 dark:border-gray-700 rounded-lg focus:ring-2 focus:ring-purple-500 dark:bg-gray-800 dark:text-white"
                           required>
                    @error('vote_end')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Active Status -->
            <div class="mb-6">
                <label class="flex items-center">
                    <input type="checkbox"
                           name="is_active"
                           value="1"
                           {{ old('is_active', $menu->is_active) ? 'checked' : '' }}
                           class="w-4 h-4 text-purple-600 border-gray-300 rounded focus:ring-purple-500">
                    <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Menu Aktif</span>
                </label>
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-end space-x-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                <a href="{{ route('admin.view-votes') }}"
                   class="px-6 py-3 border border-gray-300 dark:border-gray-700 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800 transition">
                    Batal
                </a>
                <button type="submit"
                        class="px-6 py-3 bg-gradient-to-r from-purple-600 to-indigo-600 text-white rounded-lg hover:shadow-lg transition">
                    Update Menu
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function previewImage(event) {
    const preview = document.getElementById('imagePreview');
    const previewImg = preview.querySelector('img');
    const file = event.target.files[0];

    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            preview.classList.remove('hidden');
        }
        reader.readAsDataURL(file);
    }
}
</script>
@endsection
