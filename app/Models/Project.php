<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    protected $with = ['investigator'];

    protected $casts = ['attachment' => 'array', 'attachment_filename' => 'array'];

    public function investigator()
    {
        return $this->belongsTo(Investigator::class)->withTrashed();
    }

    public function bioSamples()
    {
        return $this->hasMany(BioSample::class);//->withTrashed();
    }
}
