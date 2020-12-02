<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $fillable = ['subject_id', 'title', 'slug', 'description'];

    // untuk menampilkan note berdasarkan slug
    // public function getRouteKeyName()
    // {
    //     return 'slug';
    // }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
