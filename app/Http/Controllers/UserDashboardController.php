<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    /**
     * Display user dashboard.
     */
    public function index()
    {
        $user = Auth::user();

        // Active menus user can vote on (limit to 6 for dashboard summary)
        // votes_count only counts votes with is_current = true
        $activeMenus = Menu::ongoing()
                          ->with('votes')
                          ->withCount(['votes' => function($query) {
                              $query->where('is_current', true);
                          }])
                          ->take(6)
                          ->get();

        // User's current active vote
        // Pilihan final = vote dengan is_current = true
        $currentVote = $user->votes()
                           ->where('is_current', true)
                           ->with(['menu' => function($query) {
                               $query->withCount(['votes' => function($q) {
                                   $q->where('is_current', true);
                               }]);
                           }])
                           ->first();

        // User's vote history (completed/ended votes)
        $voteHistory = $user->votes()
                           ->with('menu')
                           ->whereHas('menu', function($query) {
                               $query->where('vote_end', '<', now());
                           })
                           ->latest()
                           ->take(5)
                           ->get();

        // Upcoming menus
        $upcomingMenus = Menu::upcoming()
                            ->orderBy('vote_start')
                            ->get();

        return view('user.dashboard', compact(
            'activeMenus',
            'currentVote',
            'voteHistory',
            'upcomingMenus'
        ));
    }
}
