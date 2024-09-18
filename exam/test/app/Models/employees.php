<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class employees extends Model
{
    protected $table = 'Employees';
    protected $primaryKey = 'EmployeeID';
    public $incrementing = true;
    protected $fillable = ['Name', 'LocationID'];

    public function center()
    {
        return $this->belongsTo(centers::class, 'LocationID');
    }

    public function tickets()
    {
        return $this->hasMany(tickets::class, 'EmployeeID');
    }
}
