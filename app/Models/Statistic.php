<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
    use HasFactory;

    protected $primaryKey = 'stat_id';
    protected $fillable = ['type', 'value'];
    protected $casts = ['value' => 'array'];
}
