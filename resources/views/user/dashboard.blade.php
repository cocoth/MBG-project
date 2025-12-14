@extends('layouts.app')

@section('content')
<div>
    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white/90">Dashboard</h1>
        <p class="text-gray-600 dark:text-gray-400 mt-1">Selamat datang, {{ auth()->user()->name }}!</p>
    </div>

    <!-- Current Vote Status -->
    @if($currentVote)
        <div class="mb-6">
            <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/3 p-5">
                <div class="flex items-start justify-between">
                    <div class="flex items-start gap-4 flex-1">
                        @if($currentVote->menu->image_path)
                            <img src="{{ asset('storage/' . $currentVote->menu->image_path) }}"
                                 alt="{{ $currentVote->menu->title }}"
                                 class="w-16 h-16 rounded-lg object-cover">
                        @else
                            <div class="w-16 h-16 bg-gradient-to-br from-purple-100 to-indigo-100 dark:from-purple-900/20 dark:to-indigo-900/20 rounded-lg"></div>
                        @endif
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-1">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white/90">Pilihan Anda Saat Ini</h3>
                                <span class="px-2 py-0.5 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 text-xs font-medium rounded-full">Active</span>
                            </div>
                            <p class="text-2xl font-bold text-purple-600 dark:text-purple-400 mb-2">{{ $currentVote->menu->title }}</p>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">{{ $currentVote->menu->description }}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                Dipilih {{ $currentVote->created_at->diffForHumans() }} • {{ $currentVote->menu->votes_count }} total votes
                            </p>
                        </div>
                    </div>
                    <a href="{{ route('user.votes') }}" class="px-4 py-2 text-sm font-medium text-purple-600 dark:text-purple-400 hover:bg-purple-50 dark:hover:bg-purple-900/20 rounded-lg transition">
                        Ganti Pilihan
                    </a>
                </div>
            </div>
        </div>
    @else
        <div class="mb-6">
            <div class="rounded-2xl border-2 border-dashed border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/30 p-8 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <h3 class="text-lg font-medium text-gray-900 dark:text-white/90 mb-2">Belum Ada Pilihan</h3>
                <p class="text-gray-600 dark:text-gray-400 mb-4">Anda belum memilih menu untuk voting yang sedang aktif</p>
                <a href="{{ route('user.votes') }}" class="inline-flex items-center px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition">
                    Pilih Menu Sekarang
                </a>
            </div>
        </div>
    @endif

    <!-- Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/3 p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Voting Tersedia</p>
                    <h3 class="text-3xl font-bold text-gray-900 dark:text-white/90">{{ $activeMenus->count() }}</h3>
                </div>
                <div class="w-12 h-12 bg-indigo-100 dark:bg-indigo-900/30 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/3 p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Akan Datang</p>
                    <h3 class="text-3xl font-bold text-gray-900 dark:text-white/90">{{ $upcomingMenus->count() }}</h3>
                </div>
                <div class="w-12 h-12 bg-yellow-100 dark:bg-yellow-900/30 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Active Menus -->
    <div class="mb-6">
        <div class="flex items-center justify-between mb-2">
            <h2 class="text-xl font-bold text-gray-900 dark:text-white/90">Menu Voting Tersedia</h2>
            <a href="{{ route('user.menus') }}" class="text-sm text-purple-600 dark:text-purple-400 hover:text-purple-700 font-medium">
                Lihat Semua →
            </a>
        </div>
        <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Menampilkan 6 menu terbaru. Klik "Lihat Semua" untuk melihat semua menu termasuk yang akan datang dan selesai.</p>

        @if($activeMenus->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
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

            <!-- Modals (Outside Grid) -->
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
        @else
            <div class="bg-white dark:bg-white/3 rounded-2xl border border-gray-200 dark:border-gray-800 p-12 text-center">
                <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
                <h3 class="text-lg font-medium text-gray-900 dark:text-white/90 mb-2">Tidak ada voting aktif</h3>
                <p class="text-gray-600 dark:text-gray-400">Belum ada menu voting yang tersedia saat ini</p>
            </div>
        @endif
    </div>

    <!-- Vote History -->
    @if($voteHistory->count() > 0)
    <div>
        <h2 class="text-xl font-bold text-gray-900 dark:text-white/90 mb-4">Riwayat Vote</h2>

        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/3 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 dark:bg-gray-800/50">
                        <tr>
                            <th class="text-left py-2 px-3 text-xs font-semibold text-gray-700 dark:text-gray-300">Menu</th>
                            <th class="text-left py-2 px-3 text-xs font-semibold text-gray-700 dark:text-gray-300">Waktu</th>
                            <th class="text-left py-2 px-3 text-xs font-semibold text-gray-700 dark:text-gray-300">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-800/50">
                        @foreach($voteHistory as $vote)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/30 transition">
                                <td class="py-3 px-3">
                                    <div class="flex items-center gap-2">
                                        @if($vote->menu->image_path)
                                            <img src="{{ asset('storage/' . $vote->menu->image_path) }}"
                                                 alt="{{ $vote->menu->title }}"
                                                 class="w-8 h-8 rounded-lg object-cover">
                                        @else
                                            <div class="w-8 h-8 bg-gradient-to-br from-purple-100 to-indigo-100 dark:from-purple-900/20 dark:to-indigo-900/20 rounded-lg"></div>
                                        @endif
                                        <span class="text-sm font-medium text-gray-900 dark:text-white/90">{{ $vote->menu->title }}</span>
                                    </div>
                                </td>
                                <td class="py-3 px-3 text-sm text-gray-600 dark:text-gray-400">{{ $vote->created_at->format('d M Y') }}</td>
                                <td class="py-3 px-3">
                                    <span class="inline-flex items-center px-2 py-1 bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 text-xs font-medium rounded-full">
                                        Selesai
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif

    <!-- Upcoming Menus -->
    @if($upcomingMenus->count() > 0)
        <div class="mt-6">
            <h2 class="text-xl font-bold text-gray-900 dark:text-white/90 mb-4">Voting Yang Akan Datang</h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @foreach($upcomingMenus as $menu)
                    <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/3 p-4">
                        <h3 class="font-bold text-gray-900 dark:text-white/90 mb-2">{{ $menu->title }}</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">{{ Str::limit($menu->description, 60) }}</p>
                        <div class="flex items-center text-xs text-yellow-600 dark:text-yellow-400">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Mulai: {{ $menu->vote_start->format('d M Y H:i') }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
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
