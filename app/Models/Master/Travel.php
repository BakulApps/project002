<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Travel extends Model
{
    use HasFactory;

    protected $table        = 'entity__master_travels';
    protected $fillable     = ['travel_id', 'travel_name'];
    protected $primaryKey   = 'travel_id';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->timestamps = false;
    }

    static function name($id)
    {
        return $id .' - '. self::where('travel_id', $id)->value('travel_name');
    }
}
