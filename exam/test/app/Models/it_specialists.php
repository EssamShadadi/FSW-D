<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class it_specialists extends Model
{
    use HasFactory;
    protected $table = 'IT_Specialists';
    protected $primaryKey = 'SpecialistID';
    public $incrementing = true;
    protected $fillable = ['Name', 'LocationID'];

    public function center()
    {
        return $this->belongsTo(centers::class, 'LocationID');
    }

    public function tickets()
    {
        return $this->hasMany(tickets::class, 'SpecialistID');
    }
}
