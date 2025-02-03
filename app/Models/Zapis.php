<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Zapis extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'den', 'obsah'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
