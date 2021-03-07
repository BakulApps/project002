<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{
    use HasFactory;

    protected $table        = 'entity__master_genders';
    protected $fillable     = ['gender_id', 'gender_name'];
    protected $primaryKey   = 'gender_id';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->timestamps = false;
    }

    static function name($id)
    {
        return $id .' - '. self::where('gender_id', $id)->value('gender_name');
    }

}
