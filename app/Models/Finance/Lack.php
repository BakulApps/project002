<?php

namespace App\Models\Finance;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lack extends Model
{
    use HasFactory;
    protected $table        = 'finance_entity__lacks';
    protected $fillable     = [
        'lack_id',
        'lack_item',
        'lack_student',
        'lack_cost',
    ];
    protected $primaryKey   = 'lack_id';
    public $timestamps      = false;
}
