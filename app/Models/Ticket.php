<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    protected $fillable = [
        'summary',
        'description',
        'status',
        'start_time',
        'end_time',
        'venue',
        'price',
        'ticket_limit',
    ];
    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];


    public function purchases()
    {
        return $this->hasMany(TicketPurchase::class);
    }

    public function ticketsSold()
    {
        return $this->purchases()->sum('quantity');
    }

    public function isSoldOut()
    {
        return $this->ticketsSold() >= $this->ticket_limit;
    }

    public function isEventStarted()
    {
        return $this->start_time && now()->greaterThanOrEqualTo($this->start_time);
    }

    public function updateStatus()
    {
        if ($this->isSoldOut() || $this->isEventStarted()) {
            $this->status = 'closed';
        } else {
            $this->status = 'open';
        }
        $this->save();
    }
}
