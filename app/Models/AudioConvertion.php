<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AudioConvertion extends Model
{
    use HasFactory;

    protected $fillable = [
        'audio_file',
        'format',
        // 'original_filename',
        // 'output_filename',
        // 'output_format',
    ];
}
