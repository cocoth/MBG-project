@extends('layouts.app')

@section('content')
<div>
    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white/90">Riwayat Voting</h1>
        <p class="text-gray-600 dark:text-gray-400 mt-1">Lihat vote aktif dan riwayat voting Anda</p>
    </div>

    <!-- Current Active Vote -->
    @if($currentVote)
        <div class="mb-6">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white/90 mb-3">Vote Aktif Saat Ini</h2>
            <div class="rounded-2xl border border-green-200 bg-green-50 dark:border-green-800 dark:bg-green-900/10 p-5">
                <div class="flex items-center gap-4">
                    @if($currentVote->menu->image_path)
                        <img src="{{ asset('storage/' . $currentVote->menu->image_path) }}"
                             alt="{{ $currentVote->menu->title }}"
                             class="w-16 h-16 rounded-lg object-cover">
                    @else
                        <div class="w-16 h-16 bg-gradient-to-br from-purple-100 to-indigo-100 dark:from-purple-900/20 dark:to-indigo-900/20 rounded-lg"></div>
                    @endif
                    <div class="flex-1">
                        <div class="flex items-center gap-2 mb-1">
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white/90">{{ $currentVote->menu->title }}</h3>
                            <span class="px-2 py-0.5 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 text-xs font-medium rounded-full">Active</span>
                        </div>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">{{ $currentVote->menu->description }}</p>
                        <div class="flex items-center gap-4 text-xs text-gray-500 dark:text-gray-400">
                            <span>Dipilih {{ $currentVote->created_at->diffForHumans() }}</span>
                            <span>•</span>
                            <span>{{ $currentVote->menu->votes_count ?? 0 }} total votes</span>
                            <span>•</span>
                            <span>Berakhir {{ $currentVote->menu->vote_end->format('d M Y H:i') }}</span>
                        </div>
                    </div>
                    <a href="{{ route('user.dashboard') }}" class="px-4 py-2 text-sm font-medium text-purple-600 dark:text-purple-400 hover:bg-purple-50 dark:hover:bg-purple-900/20 rounded-lg transition">
                        Ganti Pilihan
                    </a>
                </div>
            </div>
        </div>
    @endif

    <!-- Stats Summary -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/3 p-5">
            <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Status Vote</p>
            <h3 class="text-3xl font-bold text-gray-900 dark:text-white/90">{{ $currentVote ? '1 Aktif' : 'Tidak Ada' }}</h3>
        </div>

        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/3 p-5">
            <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Riwayat Selesai</p>
            <h3 class="text-3xl font-bold text-gray-900 dark:text-white/90">{{ $pastVotes->total() }}</h3>
        </div>

        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/3 p-5">
            <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Total Menu Dipilih</p>
            <h3 class="text-3xl font-bold text-gray-900 dark:text-white/90">{{ $totalMenusVoted }}</h3>
        </div>
    </div>

    <!-- All Votes History -->
    @if($pastVotes->count() > 0)
        <div>
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white/90 mb-3">Riwayat Vote (Terbaru ke Terlama)</h2>
            <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Termasuk vote yang sudah diganti. Label "Pilihan Final" menandakan vote yang sedang aktif.</p>
            <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/3 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50 dark:bg-gray-800/50">
                            <tr>
                                <th class="text-left py-3 px-4 text-xs font-semibold text-gray-700 dark:text-gray-300">Menu</th>
                                <th class="text-left py-3 px-4 text-xs font-semibold text-gray-700 dark:text-gray-300">Deskripsi</th>
                                <th class="text-left py-3 px-4 text-xs font-semibold text-gray-700 dark:text-gray-300">Waktu Vote</th>
                                <th class="text-left py-3 px-4 text-xs font-semibold text-gray-700 dark:text-gray-300">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-800/50">
                            @foreach($pastVotes as $vote)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/30 transition">
                                    <td class="py-3 px-4">
                                        <div class="flex items-center gap-2">
                                            @if($vote->menu->image_path)
                                                <img src="{{ asset('storage/' . $vote->menu->image_path) }}"
                                                     alt="{{ $vote->menu->title }}"
                                                     class="w-10 h-10 rounded-lg object-cover">
                                            @else
                                                <div class="w-10 h-10 bg-gradient-to-br from-purple-100 to-indigo-100 dark:from-purple-900/20 dark:to-indigo-900/20 rounded-lg"></div>
                                            @endif
                                            <div class="min-w-0">
                                                <p class="font-medium text-sm text-gray-900 dark:text-white/90 truncate">{{ $vote->menu->title }}</p>
                                                <p class="text-xs text-gray-500 dark:text-gray-400">{{ $vote->menu->votes_count ?? 0 }} votes</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-3 px-4">
                                        <p class="text-sm text-gray-600 dark:text-gray-400 truncate">{{ Str::limit($vote->menu->description, 60) }}</p>
                                    </td>
                                    <td class="py-3 px-4">
                                        <div class="text-sm">
                                            <p class="text-gray-900 dark:text-white/90">{{ $vote->created_at->format('d M Y') }}</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ $vote->created_at->format('H:i') }}</p>
                                        </div>
                                    </td>
                                    <td class="py-3 px-4">
                                        <div class="flex flex-col gap-1">
                                            @if($vote->is_current)
                                                <span class="inline-flex items-center px-2 py-1 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 text-xs font-bold rounded-full w-fit">
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                    </svg>
                                                    Pilihan Final
                                                </span>
                                            @endif
                                            @if($vote->menu->hasVotingEnded())
                                                <span class="inline-flex items-center px-2 py-1 bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 text-xs font-medium rounded-full w-fit">
                                                    <span class="w-1.5 h-1.5 mr-1 rounded-full bg-gray-600 dark:bg-gray-400"></span>
                                                    Selesai
                                                </span>
                                            @elseif($vote->menu->isVotingActive())
                                                <span class="inline-flex items-center px-2 py-1 bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 text-xs font-medium rounded-full w-fit">
                                                    <span class="w-1.5 h-1.5 mr-1 rounded-full bg-blue-600 dark:bg-blue-400"></span>
                                                    Aktif
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-2 py-1 bg-yellow-100 dark:bg-yellow-900/30 text-yellow-700 dark:text-yellow-300 text-xs font-medium rounded-full w-fit">
                                                    <span class="w-1.5 h-1.5 mr-1 rounded-full bg-yellow-600 dark:bg-yellow-400"></span>
                                                    Akan Datang
                                                </span>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($pastVotes->hasPages())
                    <div class="px-4 py-3 border-t border-gray-200 dark:border-gray-800">
                        {{ $pastVotes->links() }}
                    </div>
                @endif
            </div>
        </div>
    @elseif(!$currentVote)
        <div class="rounded-2xl border-2 border-dashed border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/30 p-12 text-center">
            <svg class="mx-auto h-12 w-12 text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <h3 class="text-lg font-medium text-gray-900 dark:text-white/90 mb-2">Belum Ada Riwayat</h3>
            <p class="text-gray-600 dark:text-gray-400 mb-4">Mulai vote menu favorit Anda sekarang!</p>
            <a href="{{ route('user.dashboard') }}"
               class="inline-flex items-center px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition">
                Pilih Menu
            </a>
        </div>
    @endif
</div>
@endsection
