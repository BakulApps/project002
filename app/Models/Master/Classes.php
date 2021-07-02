<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;
    protected $table        = 'entity__master_classes';
    protected $fillable     = [
        'class_id',
        'class_year',
        'class_level',
        'class_major',
        'class_name',
        'class_alias',
    ];
    protected $primaryKey   = 'class_id';
    public $timestamps      = false;
}
