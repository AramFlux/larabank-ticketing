<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Event
 * @package App\Models
 *
 * @property integer $id
 * @property string $uuid
 * @property integer $ticket_type_id
 * @property string $hash
 * @property integer $status
 * @property string $created_at
 */
class Ticket extends Model
{
    const STATUSES = [
        'UNPAID' => 'unpaid',
        'VALID' => 'valid',
        'FOR_SALE' => 'for_sale',
        'SOLD' => 'sold',
        'REFUNDED' => 'refunded',
    ];

    public $guarded = [];

    public static function uuid(string $uuid): self
    {
        return static::where('uuid', $uuid)->first();
    }

    public function ticketType(): BelongsTo
    {
        return $this->belongsTo(TicketType::class);
    }

}
