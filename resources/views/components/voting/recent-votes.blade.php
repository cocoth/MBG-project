@props(['recentVotes' => []])

<div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/3 sm:p-6">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                Recent Votes
            </h3>
            <p class="mt-1 text-theme-sm text-gray-500 dark:text-gray-400">
                Latest voting activities
            </p>
        </div>
        <a href="{{ route('admin.view-votes') }}" class="text-sm text-purple-600 dark:text-purple-400 hover:text-purple-700 dark:hover:text-purple-300 font-medium">
            View All →
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50 dark:bg-gray-800/50">
                <tr>
                    <th class="text-left py-2 px-3 text-xs font-semibold text-gray-700 dark:text-gray-300">User</th>
                    <th class="text-left py-2 px-3 text-xs font-semibold text-gray-700 dark:text-gray-300">Menu</th>
                    <th class="text-left py-2 px-3 text-xs font-semibold text-gray-700 dark:text-gray-300">Time</th>
                    <th class="text-left py-2 px-3 text-xs font-semibold text-gray-700 dark:text-gray-300">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dark:divide-gray-800/50">
                @forelse($recentVotes as $vote)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/30 transition">
                        <!-- User -->
                        <td class="py-3 px-3">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 rounded-full bg-gradient-to-br from-purple-400 to-indigo-500 flex items-center justify-center text-white text-xs font-bold">
                                    {{ strtoupper(substr($vote->user->name, 0, 1)) }}
                                </div>
                                <div class="min-w-0">
                                    <p class="text-sm font-medium text-gray-900 dark:text-white/90 truncate">{{ $vote->user->name }}</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 truncate">{{ Str::limit($vote->user->email, 20) }}</p>
                                </div>
                            </div>
                        </td>

                        <!-- Menu -->
                        <td class="py-3 px-3">
                            <div class="flex items-center gap-2">
                                @if($vote->menu->image_path)
                                    <img src="{{ asset('storage/' . $vote->menu->image_path) }}"
                                         alt="{{ $vote->menu->title }}"
                                         class="w-8 h-8 rounded-lg object-cover">
                                @else
                                    <div class="w-8 h-8 bg-gradient-to-br from-purple-100 to-indigo-100 dark:from-purple-900/20 dark:to-indigo-900/20 rounded-lg"></div>
                                @endif
                                <div class="min-w-0">
                                    <p class="text-sm font-medium text-gray-900 dark:text-white/90 truncate">{{ $vote->menu->title }}</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">{{ $vote->menu->votes_count }} votes</p>
                                </div>
                            </div>
                        </td>

                        <!-- Time -->
                        <td class="py-3 px-3">
                            <p class="text-sm text-gray-900 dark:text-white/90">{{ $vote->created_at->format('d M Y') }}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ $vote->created_at->format('H:i') }}</p>
                        </td>

                        <!-- Status -->
                        <td class="py-3 px-3">
                            @if($vote->menu->isVotingActive())
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300">
                                    <span class="w-1.5 h-1.5 mr-1 rounded-full bg-green-600 dark:bg-green-400"></span>
                                    Active
                                </span>
                            @elseif($vote->menu->hasVotingEnded())
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300">
                                    <span class="w-1.5 h-1.5 mr-1 rounded-full bg-gray-600 dark:bg-gray-400"></span>
                                    Ended
                                </span>
                            @else
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 dark:bg-yellow-900/30 text-yellow-700 dark:text-yellow-300">
                                    <span class="w-1.5 h-1.5 mr-1 rounded-full bg-yellow-600 dark:bg-yellow-400"></span>
                                    Upcoming
                                </span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="py-12 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <p class="mt-2 text-gray-500 dark:text-gray-400">No votes yet</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
