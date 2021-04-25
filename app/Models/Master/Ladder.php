<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ladder extends Model
{
    use HasFactory;
    protected $table        = 'entity__master_ladders';
    protected $fillable     = ['ladder_name', 'ladder_desc'];
    protected $primaryKey   = 'ladder_id';
    public $timestamps      = false;
}
