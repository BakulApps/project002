<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Year extends Model
{
    use HasFactory;
    protected $table        = 'entity__master_years';
    protected $fillable     = [
        'year_number',
        'year_name',
        'year_desc',
        'year_active',
    ];
    protected $primaryKey   = 'year_id';
    public $timestamps      = false;

    static function active($column = 'year_id')
    {
        return self::where('year_active', 1)->value($column);
    }
}
