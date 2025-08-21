<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activation extends Model
{
    use HasFactory;

    protected $table = 'activations';
    protected $primaryKey = 'activation_id';

    protected $fillable = [
        'employer_id',
        'employee_id',
        'employee_key',
        'mac_address',
        'is_active',
    ];

    public function employer() {
        return $this->hasOne(User::class, 'id', 'employer_id');
    }
    public function employee() {
        return $this->hasOne(Employee::class, 'employee_id', 'employee_id');
    }

}
