<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Credit extends Model
{
    use HasFactory;

    public function partner(){
        return $this->belongsTo(Partner::class);
    }

    public function file(){
        return $this->morphOne(File::class, 'fileable');
    }

    public function audit(){
        return $this->morphOne(Audit::class, 'auditable');
    }
}
