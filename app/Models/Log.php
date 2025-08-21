<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    protected $table = 'logs';
    protected $primaryKey = 'log_id';

    protected $fillable = [
        'employee_id',
        'employer_id',
        'log_type',
        'total_usage',
        'idle_time',
    ];

    public function employee() {
        return $this->hasOne(Employee::class, 'employee_id', 'employee_id');
    }
}
