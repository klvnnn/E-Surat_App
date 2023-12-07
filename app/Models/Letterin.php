<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Letterin extends Model
{
    use HasFactory;
    protected $table = "letterins";
    protected $guarded = [];
    protected $dates = ['letter_date'];

    protected $fillable = [
        'letter_date',
        'letter_no',
        'regarding',
        'department',
        'forward',
        'letter_file',
        'letter_disposisi',
        'letter_type',
        'pertalian'
    ];

    protected $hidden = [

    ];
}
