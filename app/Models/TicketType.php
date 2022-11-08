<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Event
 * @package App\Models
 *
 * @property integer $id
 * @property string $uuid
 * @property integer $event_id
 * @property string $name
 * @property integer $stock
 * @property string $created_at
 */
class TicketType extends Model
{
    public $guarded = [];

    public static function uuid(string $uuid): self
    {
        return static::where('uuid', $uuid)->first();
    }

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }

}
