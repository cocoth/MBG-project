<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Menu;
use App\Models\Vote;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display admin dashboard with statistics.
     */
    public function index()
    {
        $totalUsers = User::where('role', 'user')->count();
        $totalMenus = Menu::count();
        // Total votes = count only current active votes (is_current = true)
        $totalVotes = Vote::where('is_current', true)->count();
        $activeMenus = Menu::ongoing()->count();

        // Recent menus with vote counts (only current active votes)
        $recentMenus = Menu::with('votes')
                          ->withCount(['votes' => function($query) {
                              $query->where('is_current', true);
                          }])
                          ->latest()
                          ->take(5)
                          ->get();

        // Top voted menus (only current active votes)
        $topMenus = Menu::withCount(['votes' => function($query) {
                          $query->where('is_current', true);
                      }])
                       ->orderBy('votes_count', 'desc')
                       ->take(5)
                       ->get();

        // Recent votes
        $recentVotes = Vote::with(['user', 'menu'])
                          ->latest()
                          ->take(10)
                          ->get();

        // Monthly statistics
        $monthlyVotes = Vote::selectRaw('DATE(created_at) as date, COUNT(*) as count')
                           ->where('created_at', '>=', now()->subDays(30))
                           ->groupBy('date')
                           ->orderBy('date')
                           ->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalMenus',
            'totalVotes',
            'activeMenus',
            'recentMenus',
            'topMenus',
            'recentVotes',
            'monthlyVotes'
        ));
    }
}
