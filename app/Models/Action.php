<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Action extends Model
{
    use HasFactory;

    protected $fillable = [
        'action', // Pole pro akci
        'date',   // Pole pro datum
        'user_id',
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }




}
