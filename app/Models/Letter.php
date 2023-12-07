<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Letter extends Model
{
    use HasFactory;
    protected $table = "letters";
    protected $guarded = [];
    protected $dates = ['letter_date'];

    protected $fillable = [
        'letter_date',
        'letter_no',
        'letter_code',
        'letter_unit',
        'regarding',
        'department',
        'letter_file',
        'letter_type',
        'pertalian'
    ];

    protected $hidden = [

    ];
}
