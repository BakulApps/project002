<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;
    protected $table        = 'entity__master_levels';
    protected $fillable     = [
        'level_id',
        'level_ladder',
        'level_name'
    ];
    protected $primaryKey   = 'level_id';
    public $timestamps      = false;
}
