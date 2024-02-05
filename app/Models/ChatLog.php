<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class ChatLog extends Model
{
    protected $fillable = ['session', 'user', 'message'];

    /**
     * The "booting" method of the model. Add a global
     * scope for the oldest chat logs.
     *
     * @return void
     */
    protected static function booted(): void
    {
        static::addGlobalScope('latest', function (Builder $builder) {
            $builder->oldest();
        });
    }

    /**
     * Scope a query to only include logs from a specific session.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  string  $session
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSession($query, $session)
    {
        return $query->where('session', $session);
    }

    /**
     * Scope for old logs to be deleted.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOld($query)
    {
        return $query->where('created_at', '<', now()->subDays(2));
    }
}
