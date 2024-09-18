<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hardware_tickets extends Model
{
    use HasFactory;
    protected $table = 'Hardware_Tickets';
    protected $primaryKey = 'TicketID';
    public $incrementing = false;
    protected $fillable = ['SerialNumber', 'Picture'];
    protected $casts = [
        'Picture' => 'binary',
    ];

    public function ticket()
    {
        return $this->belongsTo(tickets::class, 'TicketID');
    }
}
