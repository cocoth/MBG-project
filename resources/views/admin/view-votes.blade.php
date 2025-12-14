@extends('layouts.app')

@section('content')
<div>
    <!-- Header -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white/90">Kelola Menu Voting</h1>
            <p class="text-gray-600 dark:text-gray-400 mt-2">Lihat dan kelola semua menu voting</p>
        </div>
        <a href="{{ route('admin.create-votes') }}"
           class="px-6 py-3 bg-gradient-to-r from-purple-600 to-indigo-600 text-white rounded-lg hover:shadow-lg transition flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Tambah Menu Baru
        </a>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg">
            <p class="text-green-800 dark:text-green-300">{{ session('success') }}</p>
        </div>
    @endif

    <!-- Menus List -->
    <div class="space-y-6">
        @forelse($menus as $menu)
            <div class="bg-white dark:bg-white/3 rounded-2xl border border-gray-200 dark:border-gray-800 overflow-hidden hover:border-purple-300 dark:hover:border-purple-700 hover:shadow-xl transition group">
                <div class="grid md:grid-cols-12 gap-6">
                    <!-- Image (Clickable) -->
                    <div class="md:col-span-3 cursor-pointer" onclick="window.location.href='{{ route('admin.menus.edit', $menu) }}'">
                        @if($menu->image_path)
                            <img src="{{ asset('storage/' . $menu->image_path) }}"
                                 alt="{{ $menu->title }}"
                                 class="w-full h-full object-cover min-h-[200px]">
                        @else
                            <div class="w-full h-full min-h-[200px] bg-gradient-to-br from-purple-100 to-indigo-100 dark:from-purple-900/20 dark:to-indigo-900/20 flex items-center justify-center">
                                <svg class="w-16 h-16 text-purple-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        @endif
                    </div>

                    <!-- Content (Clickable) -->
                    <div class="md:col-span-6 p-6 cursor-pointer" onclick="window.location.href='{{ route('admin.menus.edit', $menu) }}'">
                        <div class="flex items-start justify-between mb-3">
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white/90 group-hover:text-purple-600 dark:group-hover:text-purple-400 transition">{{ $menu->title }}</h3>
                            @if($menu->isVotingActive())
                                <span class="px-3 py-1 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 text-xs font-semibold rounded-full flex items-center">
                                    <span class="w-1.5 h-1.5 bg-green-600 dark:bg-green-400 rounded-full mr-1.5 animate-pulse"></span>
                                    Aktif
                                </span>
                            @elseif($menu->hasVotingEnded())
                                <span class="px-3 py-1 bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 text-xs font-semibold rounded-full flex items-center">
                                    <span class="w-1.5 h-1.5 bg-gray-600 dark:bg-gray-400 rounded-full mr-1.5"></span>
                                    Selesai
                                </span>
                            @else
                                <span class="px-3 py-1 bg-yellow-100 dark:bg-yellow-900/30 text-yellow-700 dark:text-yellow-300 text-xs font-semibold rounded-full flex items-center">
                                    <span class="w-1.5 h-1.5 bg-yellow-600 dark:bg-yellow-400 rounded-full mr-1.5"></span>
                                    Akan Datang
                                </span>
                            @endif
                        </div>

                        <p class="text-gray-600 dark:text-gray-400 mb-4 line-clamp-2">{{ $menu->description }}</p>

                        <div class="flex flex-wrap items-center gap-4 text-sm">
                            <div class="flex items-center text-gray-500 dark:text-gray-400">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <span class="text-xs">{{ $menu->vote_start->format('d M Y, H:i') }}</span>
                            </div>
                            <span class="text-gray-400">→</span>
                            <div class="flex items-center text-gray-500 dark:text-gray-400">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="text-xs">{{ $menu->vote_end->format('d M Y, H:i') }}</span>
                            </div>
                        </div>

                        <div class="mt-3 flex items-center">
                            <div class="flex items-center px-3 py-1.5 bg-purple-50 dark:bg-purple-900/20 rounded-lg">
                                <svg class="w-4 h-4 mr-1.5 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="text-sm font-semibold text-purple-600 dark:text-purple-400">{{ $menu->votes_count ?? $menu->voteCount() }} votes</span>
                            </div>
                            <span class="ml-3 text-xs text-gray-400 dark:text-gray-500 italic">Klik untuk edit</span>
                        </div>
                    </div>

                    <!-- Actions -->
                        <div class="md:col-span-3 p-6 border-l border-gray-200 dark:border-gray-800 flex flex-col justify-center space-y-3">
                            <form action="{{ route('admin.menus.toggle', $menu) }}" method="POST" class="w-full" onclick="event.stopPropagation();">
                                @csrf
                                @method('PATCH')
                                <button type="submit"
                                        class="w-full px-4 py-2.5 {{ $menu->is_active ? 'bg-yellow-50 dark:bg-yellow-900/20 text-yellow-700 dark:text-yellow-300 hover:bg-yellow-100 dark:hover:bg-yellow-900/30 border border-yellow-200 dark:border-yellow-800' : 'bg-green-50 dark:bg-green-900/20 text-green-700 dark:text-green-300 hover:bg-green-100 dark:hover:bg-green-900/30 border border-green-200 dark:border-green-800' }} rounded-lg transition font-medium text-sm flex items-center justify-center">
                                    @if($menu->is_active)
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 9v6m4-6v6m7-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Nonaktifkan
                                    @else
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Aktifkan
                                    @endif
                                </button>
                            </form>

                            <form action="{{ route('admin.menus.destroy', $menu) }}" method="POST" class="w-full"
                                  onclick="event.stopPropagation();"
                                  onsubmit="return confirm('Yakin ingin menghapus menu \"{{ $menu->title }}\"?\n\nData vote yang terkait akan ikut terhapus.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="w-full px-4 py-2.5 bg-red-50 dark:bg-red-900/20 text-red-700 dark:text-red-300 hover:bg-red-100 dark:hover:bg-red-900/30 border border-red-200 dark:border-red-800 rounded-lg transition font-medium text-sm flex items-center justify-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                    Hapus
                                </button>
                            </form>
                        </div>
                </div>
            </div>
        @empty
            <div class="bg-white dark:bg-white/3 rounded-2xl border border-gray-200 dark:border-gray-800 p-12 text-center">
                <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
                <h3 class="text-lg font-medium text-gray-900 dark:text-white/90 mb-2">Belum ada menu</h3>
                <p class="text-gray-600 dark:text-gray-400 mb-6">Mulai dengan menambahkan menu voting pertama Anda</p>
                <a href="{{ route('admin.create-votes') }}"
                   class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-purple-600 to-indigo-600 text-white rounded-lg hover:shadow-lg transition">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Tambah Menu
                </a>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($menus->hasPages())
        <div class="mt-8">
            {{ $menus->links() }}
        </div>
    @endif
</div>
@endsection
