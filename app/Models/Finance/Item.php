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

    static function getFromCode($item_code, $column=null)
    {
        $column = $column == null ? 'item_id' : $column;
        return self::where('item_code', $item_code)->value($column);
    }
}
