@extends('layouts.app')

@section('content')
    <div class="grid grid-cols-12 gap-4 md:gap-6">
        <!-- Statistics Cards -->
        <div class="col-span-12">
            <x-ecommerce.ecommerce-metrics
                :args1="'Total Users'"
                :data1="$totalUsers"
                :args2="'Total Votes'"
                :data2="$totalVotes"
            />
        </div>

        <!-- Charts Section -->
        <div class="col-span-12 lg:col-span-6">
            <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/3 sm:p-6">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90 mb-6">Monthly Votes</h3>
                <div style="height: 300px;">
                    <canvas id="monthlyVotesChart"></canvas>
                </div>
            </div>
        </div>

        <div class="col-span-12 lg:col-span-6">
            <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/3 sm:p-6">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90 mb-6">Menu Popularity</h3>
                <div style="height: 300px;">
                    <canvas id="menuPopularityChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Top Voted Menus -->
        <div class="col-span-12">
            <x-voting.top-menus :topMenus="$topMenus" />
        </div>

        <!-- Recent Votes Table -->
        <div class="col-span-12">
            <x-voting.recent-votes :recentVotes="$recentVotes" />
        </div>
    </div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Monthly Votes Chart
        const monthlyVotesCtx = document.getElementById('monthlyVotesChart');
        if (monthlyVotesCtx) {
            const monthlyVotesData = @json($monthlyVotes);

            new Chart(monthlyVotesCtx, {
                type: 'line',
                data: {
                    labels: monthlyVotesData.map(item => item.date),
                    datasets: [{
                        label: 'Votes',
                        data: monthlyVotesData.map(item => item.count),
                        borderColor: 'rgb(147, 51, 234)',
                        backgroundColor: 'rgba(147, 51, 234, 0.1)',
                        tension: 0.4,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                precision: 0
                            }
                        }
                    }
                }
            });
        }

        // Menu Popularity Chart
        const menuPopularityCtx = document.getElementById('menuPopularityChart');
        if (menuPopularityCtx) {
            const topMenusData = @json($topMenus);

            new Chart(menuPopularityCtx, {
                type: 'bar',
                data: {
                    labels: topMenusData.map(menu => menu.title),
                    datasets: [{
                        label: 'Votes',
                        data: topMenusData.map(menu => menu.votes_count),
                        backgroundColor: [
                            'rgba(234, 179, 8, 0.8)',
                            'rgba(148, 163, 184, 0.8)',
                            'rgba(205, 127, 50, 0.8)',
                            'rgba(147, 51, 234, 0.8)',
                            'rgba(99, 102, 241, 0.8)'
                        ],
                        borderColor: [
                            'rgb(234, 179, 8)',
                            'rgb(148, 163, 184)',
                            'rgb(205, 127, 50)',
                            'rgb(147, 51, 234)',
                            'rgb(99, 102, 241)'
                        ],
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                precision: 0
                            }
                        }
                    }
                }
            });
        }
    });
</script>
@endpush
