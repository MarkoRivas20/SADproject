<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status'
    ];

    public function file(){
        return $this->morphOne(File::class, 'fileable');
    }

    public function audit(){
        return $this->morphOne(Audit::class, 'auditable');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function users(){
        return $this->belongsToMany(User::class);
    }
}
