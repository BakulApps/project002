<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Study extends Model
{
    use HasFactory;

    protected $table        = 'entity__master_studies';
    protected $fillable     = ['study_id', 'study_name'];
    protected $primaryKey   = 'study_id';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->timestamps = false;
    }

    static function name($id)
    {
        return $id .' - '. self::where('study_id', $id)->value('study_name');
    }
}
