<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class centers extends Model
{
    use HasFactory;
    protected $table = 'centers';
    protected $primaryKey = 'CenterID';
    public $incrementing = true;
    protected $fillable = ['CenterName'];

    // Define relationships if needed
    public function employees()
    {
        return $this->hasMany(employees::class, 'LocationID');
    }

    public function itSpecialists()
    {
        return $this->hasMany(it_specialists::class, 'LocationID');
    }
}
