<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Event
 * @package App\Models
 *
 * @property integer $id
 * @property string $uuid
 * @property integer $user_id
 * @property string $name
 * @property string $created_at
 * @property TicketType $ticketTypes
 */
class Event extends Model
{
    public $guarded = [];

    public static function uuid(string $uuid): self
    {
        return static::where('uuid', $uuid)->first();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function ticketTypes(): HasMany
    {
        return $this->hasMany(TicketType::class);
    }

}
