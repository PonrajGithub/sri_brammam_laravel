<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReporterPerson extends Model
{
    protected $fillable = [
        'reporter_id', 
        'name', 
        'describe_role', 
        'address', 
        'pincode', 
        'mobile', 
        'email', 
        'status'
    ];

    public function reporter()
    {
        return $this->belongsTo(Reporter::class);
    }
}
