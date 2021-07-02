<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;
    protected $table        = 'entity__master_banks';
    protected $fillable     = [
        'bank_id',
        'bank_code',
        'bank_name'
    ];
    protected $primaryKey   = 'bank_id';

    static function value($id, $column = 'bank_id')
    {
        return self::where('bank_id', $id)->value($column);
    }
}
