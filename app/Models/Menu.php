<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image_path',
        'vote_start',
        'vote_end',
        'created_by',
        'is_active',
    ];

    protected $casts = [
        'vote_start' => 'datetime',
        'vote_end' => 'datetime',
        'is_active' => 'boolean',
    ];

    /**
     * Get the user who created this menu.
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get all votes for this menu.
     */
    public function votes(): HasMany
    {
        return $this->hasMany(Vote::class);
    }

    /**
     * Get vote count for this menu.
     */
    public function voteCount(): int
    {
        return $this->votes()->count();
    }

    /**
     * Check if voting is currently active.
     * Allows voting for menus that start today or up to 1 day ahead.
     */
    public function isVotingActive(): bool
    {
        $now = now();
        $oneDayAhead = now()->addDay();

        return $this->is_active &&
               $this->vote_start->lessThanOrEqualTo($oneDayAhead) &&
               $this->vote_end->greaterThanOrEqualTo($now);
    }

    /**
     * Check if voting has ended.
     */
    public function hasVotingEnded(): bool
    {
        return now()->greaterThan($this->vote_end);
    }

    /**
     * Scope for active menus.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for currently ongoing votes.
     * Includes menus that start today or up to 1 day ahead and haven't ended yet.
     */
    public function scopeOngoing($query)
    {
        $now = now();
        $oneDayAhead = now()->addDay(); // 1 hari ke depan

        return $query->where('is_active', true)
                    ->where('vote_start', '<=', $oneDayAhead)
                    ->where('vote_end', '>=', $now);
    }

    /**
     * Scope for upcoming votes.
     * Only shows menus that start more than 2 days from now.
     */
    public function scopeUpcoming($query)
    {
        $twoDaysAhead = now()->addDays(2); // Lebih dari 2 hari dari sekarang

        return $query->where('is_active', true)
                    ->where('vote_start', '>', $twoDaysAhead);
    }

    /**
     * Scope for ended votes.
     */
    public function scopeEnded($query)
    {
        return $query->where('vote_end', '<', now());
    }
}
