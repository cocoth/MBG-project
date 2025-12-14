@extends('layouts.app')

@section('content')
    <div>
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white/90">Voting Menu</h1>
            <p class="text-gray-600 dark:text-gray-400 mt-2">Pilih menu favorit Anda untuk makan gratis</p>
        </div>

        @if (session('success'))
            <div class="mb-6 p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg">
                <p class="text-green-800 dark:text-green-300">{{ session('success') }}</p>
            </div>
        @endif

        @if (session('error'))
            <div class="mb-6 p-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg">
                <p class="text-red-800 dark:text-red-300">{{ session('error') }}</p>
            </div>
        @endif

        <!-- Active Menus -->
        <div class="mb-12">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white/90 mb-6">🔥 Voting Aktif</h2>

            @if ($activeMenus->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                    @foreach ($activeMenus as $menu)
                        <div
                            class="bg-white dark:bg-white/3 rounded-2xl border border-gray-200 dark:border-gray-800 overflow-hidden hover:shadow-xl transition group">
                            <!-- Image -->
                            <div class="relative cursor-pointer" onclick="openMenuModalVotes{{ $menu->id }}()">
                                @if ($menu->image_path)
                                    <img src="{{ asset('storage/' . $menu->image_path) }}" alt="{{ $menu->title }}"
                                        class="w-full h-56 object-cover group-hover:scale-105 transition duration-300">
                                @else
                                    <div
                                        class="w-full h-56 bg-gradient-to-br from-purple-100 to-indigo-100 dark:from-purple-900/20 dark:to-indigo-900/20 flex items-center justify-center">
                                        <svg class="w-20 h-20 text-purple-300" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                    </div>
                                @endif

                                <!-- Active Badge -->
                                <div class="absolute top-4 right-4">
                                    <span
                                        class="px-3 py-1 bg-green-500 text-white text-xs font-bold rounded-full shadow-lg">
                                        AKTIF
                                    </span>
                                </div>

                                <!-- Click for details overlay -->
                                <div
                                    class="absolute inset-0 bg-black/40 backdrop-blur-sm bg-opacity-0 hover:bg-opacity-10 transition flex items-center justify-center opacity-0 hover:opacity-100 hover:scale-105">
                                    <span
                                        class="text-white text-sm font-medium bg-black bg-opacity-50 px-3 py-1 rounded-full">Klik
                                        untuk detail</span>
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="p-6 cursor-pointer" onclick="openMenuModalVotes{{ $menu->id }}()">
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white/90 mb-3">{{ $menu->title }}</h3>
                                <p class="text-gray-600 dark:text-gray-400 text-sm mb-4 line-clamp-3">
                                    {{ $menu->description }}</p>

                                <!-- Stats -->
                                <div class="flex items-center justify-between mb-4 text-sm">
                                    <div class="flex items-center text-gray-500 dark:text-gray-400">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        {{ $menu->votes_count }} votes
                                    </div>
                                    <div class="flex items-center text-gray-500 dark:text-gray-400">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Sampai {{ $menu->vote_end->format('d M') }}
                                    </div>
                                </div>

                                <!-- Vote Count by User -->
                                @php
                                    $userVoteCount = auth()->user()->voteCountFor($menu);
                                @endphp

                                <!-- Vote Button -->
                                <form action="{{ route('user.votes.cast', $menu) }}" method="POST"
                                    onclick="event.stopPropagation()">
                                    @csrf
                                    <button type="submit"
                                        class="w-full px-6 py-3 bg-gradient-to-r from-purple-600 to-indigo-600 text-white rounded-lg font-semibold hover:shadow-lg transform hover:scale-105 transition flex items-center justify-center">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Vote Sekarang
                                    </button>
                                </form>
                                @if ($userVoteCount > 0)
                                    <div
                                        class="mt-4 p-3 bg-blue-50 dark:bg-blue-900/20 rounded-lg text-sm text-blue-700 dark:text-blue-300">
                                        <svg class="inline w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Anda sudah vote {{ $userVoteCount }}x
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Modals (outside grid) -->
                @foreach ($activeMenus as $menu)
                    <div id="menuModalVotes{{ $menu->id }}" style="display: none; z-index: 9999;"
                        class="fixed inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog"
                        aria-modal="true">
                        <div class="flex items-center justify-center min-h-screen p-4">
                            <!-- Background overlay -->
                            <div onclick="closeMenuModalVotes{{ $menu->id }}()"
                                class="fixed inset-0 bg-gray-500 bg-opacity-75 dark:bg-gray-900 dark:bg-opacity-80 transition-opacity">
                            </div>

                            <!-- Modal panel -->
                            <div class="relative bg-white dark:bg-gray-800 rounded-2xl shadow-xl max-w-2xl w-full"
                                style="z-index: 10000;">
                                <!-- Image -->
                                @if ($menu->image_path)
                                    <img src="{{ asset('storage/' . $menu->image_path) }}" alt="{{ $menu->title }}"
                                        class="w-full h-80 object-cover">
                                @else
                                    <div
                                        class="w-full h-80 bg-gradient-to-br from-purple-100 to-indigo-100 dark:from-purple-900/20 dark:to-indigo-900/20 flex items-center justify-center">
                                        <svg class="w-24 h-24 text-purple-300" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                    </div>
                                @endif

                                <!-- Content -->
                                <div class="p-6">
                                    <div class="flex items-start justify-between mb-4">
                                        <div class="flex-1">
                                            <div class="flex items-center gap-2 mb-2">
                                                <h3 class="text-2xl font-bold text-gray-900 dark:text-white/90">
                                                    {{ $menu->title }}</h3>
                                                <span
                                                    class="px-3 py-1 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 text-xs font-bold rounded-full">AKTIF</span>
                                            </div>
                                            <div class="flex items-center gap-4 text-sm text-gray-500 dark:text-gray-400">
                                                <span class="flex items-center">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                    {{ $menu->votes_count }} votes
                                                </span>
                                                <span class="flex items-center">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                    {{ $menu->vote_start->format('d M') }} -
                                                    {{ $menu->vote_end->format('d M Y') }}
                                                </span>
                                            </div>
                                        </div>
                                        <button onclick="closeMenuModalVotes{{ $menu->id }}()"
                                            class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                        </button>
                                    </div>

                                    <div class="prose dark:prose-invert max-w-none mb-6">
                                        <h4 class="text-lg font-semibold text-gray-900 dark:text-white/90 mb-3">Deskripsi
                                            Menu</h4>
                                        <p class="text-gray-700 dark:text-gray-300 text-base leading-relaxed">
                                            {{ $menu->description }}</p>
                                    </div>

                                    @php
                                        $userVoteCount = auth()->user()->voteCountFor($menu);
                                    @endphp
                                    @if ($userVoteCount > 0)
                                        <div
                                            class="mb-6 p-4 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg">
                                            <div class="flex items-center text-blue-700 dark:text-blue-300">
                                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                <span class="font-medium">Anda sudah memilih menu ini
                                                    {{ $userVoteCount }}x</span>
                                            </div>
                                        </div>
                                    @endif

                                    <!-- Actions -->
                                    <div class="flex gap-3">
                                        <button onclick="closeMenuModalVotes{{ $menu->id }}()"
                                            class="flex-1 px-6 py-3 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition font-medium">
                                            Tutup
                                        </button>
                                        <form action="{{ route('user.votes.cast', $menu) }}" method="POST"
                                            class="flex-1">
                                            @csrf
                                            <button type="submit"
                                                class="w-full px-6 py-3 bg-gradient-to-r from-purple-600 to-indigo-600 text-white rounded-lg font-semibold hover:shadow-lg transition flex items-center justify-center">
                                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                Vote Sekarang
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
        </div>
    @else
        <div class="bg-white dark:bg-white/3 rounded-2xl border border-gray-200 dark:border-gray-800 p-12 text-center">
            <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                </path>
            </svg>
            <h3 class="text-lg font-medium text-gray-900 dark:text-white/90 mb-2">Tidak ada voting aktif</h3>
            <p class="text-gray-600 dark:text-gray-400">Belum ada menu voting yang tersedia saat ini</p>
        </div>
        @endif
    </div>

    <!-- Upcoming Menus -->
    @if ($upcomingMenus->count() > 0)
        <div class="mb-12">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white/90 mb-6">📅 Akan Datang</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach ($upcomingMenus as $menu)
                    <div class="bg-white dark:bg-white/3 rounded-2xl border border-gray-200 dark:border-gray-800 p-5">
                        <div class="flex items-start justify-between mb-3">
                            <h3 class="font-bold text-gray-900 dark:text-white/90">{{ Str::limit($menu->title, 30) }}</h3>
                            <span
                                class="px-2 py-1 bg-yellow-100 dark:bg-yellow-900/30 text-yellow-700 dark:text-yellow-300 text-xs font-semibold rounded-full">
                                Soon
                            </span>
                        </div>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-3 line-clamp-2">{{ $menu->description }}</p>
                        <div class="flex items-center text-xs text-gray-500 dark:text-gray-400">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                            {{ $menu->vote_start->format('d M Y H:i') }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- My Recent Votes -->
    <div>
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white/90">📝 Riwayat Vote Saya</h2>
            <a href="{{ route('user.vote-history') }}" class="text-purple-600 hover:text-purple-700 font-medium">
                Lihat Semua →
            </a>
        </div>

        @if ($userVotes->count() > 0)
            <div class="bg-white dark:bg-white/3 rounded-2xl border border-gray-200 dark:border-gray-800 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50 dark:bg-gray-800/50">
                            <tr>
                                <th class="text-left py-3 px-4 text-sm font-medium text-gray-500 dark:text-gray-400">Menu
                                </th>
                                <th class="text-left py-3 px-4 text-sm font-medium text-gray-500 dark:text-gray-400">Waktu
                                    Vote</th>
                                <th class="text-left py-3 px-4 text-sm font-medium text-gray-500 dark:text-gray-400">Status
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($userVotes->take(10) as $vote)
                                <tr class="border-b border-gray-100 dark:border-gray-800/50">
                                    <td class="py-3 px-4">
                                        <div class="flex items-center space-x-3">
                                            @if ($vote->menu->image_path)
                                                <img src="{{ asset('storage/' . $vote->menu->image_path) }}"
                                                    alt="{{ $vote->menu->title }}"
                                                    class="w-10 h-10 rounded-lg object-cover">
                                            @else
                                                <div
                                                    class="w-10 h-10 bg-gradient-to-br from-purple-100 to-indigo-100 rounded-lg">
                                                </div>
                                            @endif
                                            <span
                                                class="font-medium text-gray-900 dark:text-white/90">{{ $vote->menu->title }}</span>
                                        </div>
                                    </td>
                                    <td class="py-3 px-4 text-gray-600 dark:text-gray-400">
                                        {{ $vote->created_at->format('d M Y H:i') }}
                                    </td>
                                    <td class="py-3 px-4">
                                        @if ($vote->menu->isVotingActive())
                                            <span
                                                class="px-2 py-1 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 text-xs font-semibold rounded-full">
                                                Aktif
                                            </span>
                                        @else
                                            <span
                                                class="px-2 py-1 bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 text-xs font-semibold rounded-full">
                                                Selesai
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <div class="bg-white dark:bg-white/3 rounded-2xl border border-gray-200 dark:border-gray-800 p-8 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400 mb-3" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <p class="text-gray-600 dark:text-gray-400">Anda belum melakukan voting</p>
            </div>
        @endif
    </div>
    </div>
@endsection

@push('scripts')
    <script>
        @foreach ($activeMenus as $menu)
            function openMenuModalVotes{{ $menu->id }}() {
                document.getElementById('menuModalVotes{{ $menu->id }}').style.display = 'block';
                document.body.style.overflow = 'hidden';
            }

            function closeMenuModalVotes{{ $menu->id }}() {
                document.getElementById('menuModalVotes{{ $menu->id }}').style.display = 'none';
                document.body.style.overflow = 'auto';
            }
        @endforeach

        // Close modal on Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                document.querySelectorAll('[id^="menuModalVotes"]').forEach(modal => {
                    modal.style.display = 'none';
                });
                document.body.style.overflow = 'auto';
            }
        });
    </script>
@endpush
