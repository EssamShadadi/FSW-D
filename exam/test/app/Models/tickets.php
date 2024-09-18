<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tickets extends Model
{
    use HasFactory;
    protected $table = 'Tickets';
    protected $primaryKey = 'TicketID';
    public $incrementing = true;
    protected $fillable = [
        'EmployeeID', 'SpecialistID', 'Status', 'ProblemDescription', 
        'ProblemType', 'DeviceType'
    ];
    protected $casts = [
        'DateTime' => 'datetime',
        'Status' => 'string',
        'ProblemType' => 'string',
        'DeviceType' => 'string',
    ];

    public function employee()
    {
        return $this->belongsTo(employees::class, 'EmployeeID');
    }

    public function specialist()
    {
        return $this->belongsTo(it_specialists::class, 'SpecialistID');
    }

    public function hardwareTicket()
    {
        return $this->hasOne(hardware_tickets::class, 'TicketID');
    }

    public function softwareTicket()
    {
        return $this->hasOne(software_tickets::class, 'TicketID');
    }
}
