<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Statistika extends Model
{
    use HasFactory;

    protected $table = 'statistika';

    protected $fillable = [
        'user_id',
        'typ_cviceni',
        'vaha',
        'opakovani',
        'cas',
        'datum',
    ];

}
