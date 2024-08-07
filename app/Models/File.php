<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'url'
    ];

    public function fileable(){
        return $this->morphTo();
    }

    public function audit(){
        return $this->morphOne(Audit::class, 'auditable');
    }
}
