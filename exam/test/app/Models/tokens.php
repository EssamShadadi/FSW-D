<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tokens extends Model
{
    use HasFactory;
    protected $table = 'tokens';
    protected $primaryKey = 'ID';
    public $incrementing = true;
    protected $fillable = ['employee_id', 'token'];

    public function employee()
    {
        return $this->belongsTo(employees::class, 'employee_id');
    }

    
}
