<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Investigator extends Model
{
    use HasFactory, SoftDeletes;

    public function getNameAttribute()
    {
        return $this->first_name . ' ' . $this->middle_initial . ' ' . $this->last_name;
    }

    public function projects()
    {
        return $this->hasMany(Project::class);//->withTrashed();
    }
}
