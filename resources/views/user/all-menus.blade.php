@extends('layouts.app')

@section('content')
<div>
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white/90">Semua Menu</h1>
        <p class="text-gray-600 dark:text-gray-400 mt-2">Lihat semua menu voting: aktif, akan datang, dan selesai</p>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg">
            <p class="text-green-800 dark:text-green-300">{{ session('success') }}</p>
        </div>
    @endif

    @if(session('error'))
        <div class="mb-6 p-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg">
            <p class="text-red-800 dark:text-red-300">{{ session('error') }}</p>
        </div>
    @endif

    @if(session('info'))
        <div class="mb-6 p-4 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg">
            <p class="text-blue-800 dark:text-blue-300">{{ session('info') }}</p>
        </div>
    @endif

    <!-- Tabs Navigation -->
    <div class="mb-6" x-data="{ activeTab: 'active' }">
        <div class="border-b border-gray-200 dark:border-gray-700 mb-6">
            <nav class="flex gap-4">
                <button @click="activeTab = 'active'"
                    :class="activeTab === 'active' ? 'border-purple-500 text-purple-600 dark:text-purple-400' : 'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300'"
                    class="py-3 px-1 border-b-2 font-medium text-sm transition">
                    Voting Aktif ({{ $activeMenus->count() }})
                </button>
                <button @click="activeTab = 'upcoming'"
                    :class="activeTab === 'upcoming' ? 'border-purple-500 text-purple-600 dark:text-purple-400' : 'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300'"
                    class="py-3 px-1 border-b-2 font-medium text-sm transition">
                    Akan Datang ({{ $upcomingMenus->count() }})
                </button>
                <button @click="activeTab = 'ended'"
                    :class="activeTab === 'ended' ? 'border-purple-500 text-purple-600 dark:text-purple-400' : 'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300'"
                    class="py-3 px-1 border-b-2 font-medium text-sm transition">
                    Selesai ({{ $endedMenus->count() }})
                </button>
            </nav>
        </div>

        <!-- Active Menus Tab -->
        <div x-show="activeTab === 'active'" x-transition>
            @if($activeMenus->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($activeMenus as $menu)
                        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/3 overflow-hidden hover:border-purple-300 dark:hover:border-purple-700 transition group">
                            <div class="cursor-pointer" onclick="openMenuModal{{ $menu->id }}()">
                                @if($menu->image_path)
                                    <img src="{{ asset('storage/' . $menu->image_path) }}"
                                         alt="{{ $menu->title }}"
                                         class="w-full h-40 object-cover">
                                @else
                                    <div class="w-full h-40 bg-gradient-to-br from-purple-100 to-indigo-100 dark:from-purple-900/20 dark:to-indigo-900/20"></div>
                                @endif

                                <div class="p-4">
                                    <h3 class="text-lg font-bold text-gray-900 dark:text-white/90 mb-2">{{ $menu->title }}</h3>
                                    <p class="text-gray-600 dark:text-gray-400 text-sm mb-3">{{ Str::limit($menu->description, 70) }}</p>

                                    <div class="flex items-center justify-between">
                                        <div class="text-sm text-gray-500 dark:text-gray-400">
                                            <svg class="inline w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            {{ $menu->votes_count }} votes
                                        </div>
                                        <span class="text-xs text-gray-400">Klik untuk detail</span>
                                    </div>
                                </div>
                            </div>

                            <div class="px-4 pb-4" onclick="event.stopPropagation()">
                                <form action="{{ route('user.votes.cast', $menu) }}" method="POST">
                                    @csrf
                                    @if($currentVote && $currentVote->menu_id == $menu->id)
                                        <button type="button" disabled class="w-full px-4 py-2 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 rounded-lg text-sm font-medium cursor-not-allowed">
                                            ✓ Terpilih
                                        </button>
                                    @else
                                        <button type="submit" class="w-full px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition text-sm font-medium">
                                            {{ $currentVote ? 'Ganti' : 'Pilih' }}
                                        </button>
                                    @endif
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                    </svg>
                    <p class="text-gray-600 dark:text-gray-400">Tidak ada voting aktif saat ini</p>
                </div>
            @endif
        </div>

        <!-- Upcoming Menus Tab -->
        <div x-show="activeTab === 'upcoming'" x-transition>
            @if($upcomingMenus->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($upcomingMenus as $menu)
                        <div class="bg-white dark:bg-white/3 rounded-2xl border border-gray-200 dark:border-gray-800 p-5">
                            <div class="flex items-start justify-between mb-3">
                                <h3 class="font-bold text-gray-900 dark:text-white/90 text-sm flex-1">{{ $menu->title }}</h3>
                                <span class="px-2 py-1 bg-yellow-100 dark:bg-yellow-900/30 text-yellow-700 dark:text-yellow-300 text-xs font-semibold rounded-full ml-2">SOON</span>
                            </div>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-3 line-clamp-2">{{ $menu->description }}</p>
                            <div class="flex items-center text-xs text-gray-500 dark:text-gray-400">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                Mulai {{ $menu->vote_start->format('d M Y') }}
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <p class="text-gray-600 dark:text-gray-400">Tidak ada voting yang akan datang</p>
                </div>
            @endif
        </div>

        <!-- Ended Menus Tab -->
        <div x-show="activeTab === 'ended'" x-transition>
            @if($endedMenus->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($endedMenus as $menu)
                        <div class="bg-white dark:bg-white/3 rounded-2xl border border-gray-200 dark:border-gray-800 p-5">
                            <div class="flex items-start justify-between mb-3">
                                <h3 class="font-bold text-gray-900 dark:text-white/90 flex-1">{{ $menu->title }}</h3>
                                <span class="px-2 py-1 bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 text-xs font-semibold rounded-full ml-2">SELESAI</span>
                            </div>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-3 line-clamp-2">{{ $menu->description }}</p>
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-gray-900 dark:text-white/90 font-semibold">{{ $menu->votes_count }} votes</span>
                                <span class="text-xs text-gray-500 dark:text-gray-400">Berakhir {{ $menu->vote_end->format('d M Y') }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p class="text-gray-600 dark:text-gray-400">Belum ada voting yang selesai</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Modals for Active Menus -->
    @foreach($activeMenus as $menu)
        <div id="menuModal{{ $menu->id }}" style="display: none; z-index: 9999;" class="fixed inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-center justify-center min-h-screen p-4">
                <!-- Background overlay -->
                <div onclick="closeMenuModal{{ $menu->id }}()" class="fixed inset-0 bg-gray-500 bg-opacity-75 dark:bg-gray-900 dark:bg-opacity-80 transition-opacity"></div>

                <!-- Modal panel -->
                <div class="relative bg-white dark:bg-gray-800 rounded-2xl shadow-xl max-w-2xl w-full" style="z-index: 10000;">
                    <!-- Image -->
                    @if($menu->image_path)
                        <img src="{{ asset('storage/' . $menu->image_path) }}"
                             alt="{{ $menu->title }}"
                             class="w-full h-64 object-cover rounded-t-2xl">
                    @else
                        <div class="w-full h-64 bg-gradient-to-br from-purple-100 to-indigo-100 dark:from-purple-900/20 dark:to-indigo-900/20 flex items-center justify-center rounded-t-2xl">
                            <svg class="w-20 h-20 text-purple-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    @endif

                    <!-- Content -->
                    <div class="p-6">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex-1">
                                <h3 class="text-2xl font-bold text-gray-900 dark:text-white/90 mb-2">{{ $menu->title }}</h3>
                                <div class="flex items-center gap-3 text-sm text-gray-500 dark:text-gray-400">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        {{ $menu->votes_count }} votes
                                    </span>
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        {{ $menu->vote_start->format('d M') }} - {{ $menu->vote_end->format('d M Y') }}
                                    </span>
                                </div>
                            </div>
                            <button onclick="closeMenuModal{{ $menu->id }}()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>

                        <div class="mb-6">
                            <p class="text-gray-700 dark:text-gray-300 text-base leading-relaxed">{{ $menu->description }}</p>
                        </div>

                        <!-- Actions -->
                        <div class="flex gap-3">
                            <button onclick="closeMenuModal{{ $menu->id }}()" class="flex-1 px-4 py-2 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                Tutup
                            </button>
                            <form action="{{ route('user.votes.cast', $menu) }}" method="POST" class="flex-1">
                                @csrf
                                @if($currentVote && $currentVote->menu_id == $menu->id)
                                    <button type="button" disabled class="w-full px-4 py-2 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 rounded-lg font-medium cursor-not-allowed">
                                        ✓ Terpilih
                                    </button>
                                @else
                                    <button type="submit" class="w-full px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition font-medium">
                                        {{ $currentVote ? 'Ganti Pilihan' : 'Pilih Menu Ini' }}
                                    </button>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection

@push('scripts')
<script>
    // Debug: Log active menus count
    console.log('Active menus loaded:', {{ $activeMenus->count() }});

    @foreach($activeMenus as $menu)
        function openMenuModal{{ $menu->id }}() {
            console.log('Opening modal for menu {{ $menu->id }}');
            const modal = document.getElementById('menuModal{{ $menu->id }}');
            if (modal) {
                modal.style.display = 'block';
                document.body.style.overflow = 'hidden';
            } else {
                console.error('Modal not found: menuModal{{ $menu->id }}');
            }
        }

        function closeMenuModal{{ $menu->id }}() {
            console.log('Closing modal for menu {{ $menu->id }}');
            const modal = document.getElementById('menuModal{{ $menu->id }}');
            if (modal) {
                modal.style.display = 'none';
                document.body.style.overflow = 'auto';
            }
        }
    @endforeach

    // Close modal on Escape key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            console.log('Escape pressed, closing all modals');
            document.querySelectorAll('[id^="menuModal"]').forEach(modal => {
                modal.style.display = 'none';
            });
            document.body.style.overflow = 'auto';
        }
    });
</script>
@endpush
