@props(['topMenus' => []])

<div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/3 sm:p-6">
    <div class="mb-6">
        <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
            Top Voted Menus
        </h3>
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
            Most popular menu selections
        </p>
    </div>

    <div class="space-y-3">
        @forelse($topMenus as $index => $menu)
            <div class="flex items-center gap-3 p-3 bg-gray-50 dark:bg-gray-800/50 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                <!-- Rank Badge -->
                <div class="flex items-center justify-center w-8 h-8 rounded-full {{ $index === 0 ? 'bg-yellow-100 dark:bg-yellow-900/30' : ($index === 1 ? 'bg-gray-200 dark:bg-gray-700' : 'bg-orange-100 dark:bg-orange-900/30') }}">
                    <span class="text-sm font-bold {{ $index === 0 ? 'text-yellow-600 dark:text-yellow-400' : ($index === 1 ? 'text-gray-600 dark:text-gray-400' : 'text-orange-600 dark:text-orange-400') }}">
                        #{{ $index + 1 }}
                    </span>
                </div>

                <!-- Menu Image -->
                @if($menu->image_path)
                    <img src="{{ asset('storage/' . $menu->image_path) }}"
                         alt="{{ $menu->title }}"
                         class="w-12 h-12 rounded-lg object-cover">
                @else
                    <div class="w-12 h-12 bg-gradient-to-br from-purple-100 to-indigo-100 dark:from-purple-900/20 dark:to-indigo-900/20 rounded-lg"></div>
                @endif

                <!-- Menu Info -->
                <div class="flex-1 min-w-0">
                    <div class="flex items-center gap-2 mb-1">
                        <p class="font-semibold text-gray-900 dark:text-white/90 truncate">
                            {{ $menu->title }}
                        </p>
                        <!-- Status Badge (inline with title) -->
                        @if($menu->isVotingActive())
                            <span class="inline-flex items-center px-2 py-0.5 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 text-xs font-medium rounded-full whitespace-nowrap">
                                Active
                            </span>
                        @elseif($menu->hasVotingEnded())
                            <span class="inline-flex items-center px-2 py-0.5 bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 text-xs font-medium rounded-full whitespace-nowrap">
                                Ended
                            </span>
                        @else
                            <span class="inline-flex items-center px-2 py-0.5 bg-yellow-100 dark:bg-yellow-900/30 text-yellow-700 dark:text-yellow-300 text-xs font-medium rounded-full whitespace-nowrap">
                                Upcoming
                            </span>
                        @endif
                    </div>
                    <p class="text-xs text-gray-500 dark:text-gray-400 truncate">
                        {{ Str::limit($menu->description, 40) }}
                    </p>
                </div>

                <!-- Vote Count (Right aligned) -->
                <div class="flex flex-col items-end justify-center">
                    <p class="text-2xl font-bold text-purple-600 dark:text-purple-400 leading-none">
                        {{ $menu->votes_count }}
                    </p>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">votes</p>
                </div>
            </div>
        @empty
            <div class="text-center py-8">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
                <p class="mt-2 text-gray-500 dark:text-gray-400">No menus available</p>
            </div>
        @endforelse
    </div>
</div>
