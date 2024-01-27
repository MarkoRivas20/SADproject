<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasFactory;

    protected $fillable = [
        'register',
        'name',
        'document',
    ];

    public function credits(){
        return $this->hasMany(Credit::class);
    }

    public function cdps(){
        return $this->hasMany(Cdp::class);
    }

    public function audit(){
        return $this->morphOne(Audit::class, 'auditable');
    }
}
