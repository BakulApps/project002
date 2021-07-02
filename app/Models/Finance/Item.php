<?php

namespace App\Models\Finance;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $table        = 'finance_entity__items';
    protected $fillable     = [
        'item_id',
        'item_code',
        'item_name',
    ];
    protected $primaryKey   = 'item_id';
    public $timestamps      = false;
}
