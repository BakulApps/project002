<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Civic extends Model
{
    use HasFactory;

    protected $table        = 'entity__master_civics';
    protected $fillable     = ['civic_id', 'civic_name'];
    protected $primaryKey   = 'civic_id';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->timestamps = false;
    }

    static function name($id)
    {
        return $id .' - '. self::where('civic_id', $id)->value('civic_name');
    }
}
