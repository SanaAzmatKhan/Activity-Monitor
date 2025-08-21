<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $table = 'employees';
    protected $primaryKey = 'employee_id';

    protected $fillable = [
        'name',
        'email',
        'group_id',
        'employer_id',
        'key',
    ];

    public function group() {
        return $this->hasOne(Group::class, 'group_id', 'group_id');
    }

    public function employer() {
        return $this->hasOne(User::class, 'id', 'employer_id');
    }

    public function activation(){
        return $this->belongsTo(Activation::class, 'employee_id', 'employee_id');
    }

}
