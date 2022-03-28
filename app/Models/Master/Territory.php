<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Territory extends Model
{
    use HasFactory;

    protected $table        = 'entity__master_territories';
    protected $fillable     = [
        'code_province',
        'code_distric',
        'code_subdistric',
        'code_village',
        'name_village',
        'name_subdistric',
        'name_distric',
        'name_province',
        'id_province',
        'id_distric',
        'id_subdistric',
        'id_village',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->timestamps = false;
    }

    static function province($id, $code = true)
    {

        return $code == true ? $id .' - '. self::where('code_province', $id)->value('name_province') : self::where('code_province', $id)->value('name_province');
    }

    static function distric($id, $code = true)
    {
        return $code == true ? $id .' - '. self::where('code_distric', $id)->value('name_distric') : self::where('code_distric', $id)->value('name_distric');
    }

    static function subdistric($id, $code = true)
    {
        return $code == true ? $id .' - '. self::where('code_subdistric', $id)->value('name_subdistric') : self::where('code_subdistric', $id)->value('name_subdistric');
    }

    static function village($subdistric, $id, $code = true)
    {
        return $code == true ? $id .' - '. self::where('code_subdistric', $subdistric)->where('code_village', $id)->value('name_village') : self::where('code_subdistric', $subdistric)->where('code_village', $id)->value('name_village');
    }
}
