<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoteController extends Controller
{
    /**
     * Display all menus with filters (active, upcoming, ended).
     */
    public function allMenus()
    {
        $user = Auth::user();
        if (!$user instanceof User) {
            abort(403, 'Unauthorized action.');
        }

        // Get all menus categorized
        // votes_count only counts votes with is_current = true (active votes only)
        $activeMenus = Menu::ongoing()
            ->withCount(['votes' => function($query) {
                $query->where('is_current', true);
            }])
            ->with('votes')
            ->get();

        $upcomingMenus = Menu::upcoming()
            ->withCount(['votes' => function($query) {
                $query->where('is_current', true);
            }])
            ->orderBy('vote_start')
            ->get();

        $endedMenus = Menu::ended()
            ->withCount(['votes' => function($query) {
                $query->where('is_current', true);
            }])
            ->orderBy('vote_end', 'desc')
            ->take(10)
            ->get();

        // Get user's current vote (only is_current = true)
        $currentVote = $user->votes()
            ->where('is_current', true)
            ->with('menu')
            ->first();

        return view('user.all-menus', compact('activeMenus', 'upcomingMenus', 'endedMenus', 'currentVote'));
    }

    /**
     * Cast a vote for a menu.
     */
    public function vote(Request $request, Menu $menu)
    {
        // Check if voting is active
        if (!$menu->isVotingActive()) {
            return redirect()->back()
                ->with('error', 'Voting untuk menu ini sudah tidak aktif!');
        }

        $user = Auth::user();

        // Cari vote user yang sedang aktif (is_current = true)
        $existingVote = Vote::where('user_id', $user->id)
            ->where('is_current', true)
            ->first();

        // Jika user sudah voting untuk menu yang sama, return info
        if ($existingVote && $existingVote->menu_id == $menu->id) {
            return redirect()->back()
                ->with('info', 'Anda sudah memilih menu ini!');
        }

        // Jika user sudah punya vote aktif untuk menu lain, set jadi tidak aktif
        // Ini akan mencatat history: vote lama tetap ada tapi is_current = false
        if ($existingVote) {
            $existingVote->update(['is_current' => false]);
        }

        // CREATE vote baru dengan is_current = true (untuk mencatat history)
        // Pilihan Final = vote dengan is_current = true
        Vote::create([
            'user_id' => $user->id,
            'menu_id' => $menu->id,
            'is_current' => true,
        ]);

        $message = $existingVote
            ? 'Vote berhasil diubah! Anda sekarang memilih menu ini.'
            : 'Vote berhasil! Terima kasih atas partisipasinya.';

        return redirect()->back()
            ->with('success', $message);
    }

    /**
     * Display vote history for user.
     */
    public function history()
    {
        $user = Auth::user();
        if (!$user instanceof User) {
            abort(403, 'Unauthorized action.');
        }

        // Get current active vote (pilihan final = is_current true)
        $currentVote = $user->votes()
            ->where('is_current', true)
            ->with(['menu' => function($query) {
                $query->withCount(['votes' => function($q) {
                    $q->where('is_current', true);
                }]);
            }])
            ->first();

        // Get all vote history (includes replaced votes)
        // Sorted from newest to oldest (created_at for better history tracking)
        $pastVotes = $user->votes()
            ->with(['menu' => function($query) {
                $query->withCount(['votes' => function($q) {
                    $q->where('is_current', true);
                }]);
            }])
            ->latest('created_at')
            ->paginate(10);

        // Total unique menus voted
        $totalMenusVoted = $user->votes()
            ->distinct('menu_id')
            ->count('menu_id');

        return view('user.vote-history', compact('currentVote', 'pastVotes', 'totalMenusVoted'));
    }
}
