<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class software_tickets extends Model
{
    use HasFactory;
    protected $table = 'Software_Tickets';
    protected $primaryKey = 'TicketID';
    public $incrementing = false;
    protected $fillable = [
        'OSVersion', 'AffectedSoftware', 'ErrorCode', 'Screenshot'
    ];
    protected $casts = [
        'Screenshot' => 'binary',
    ];

    public function ticket()
    {
        return $this->belongsTo(tickets::class, 'TicketID');
    }
}
