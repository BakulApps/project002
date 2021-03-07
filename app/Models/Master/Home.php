<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Home extends Model
{
    use HasFactory;

    protected $table        = 'entity__master_homes';
    protected $fillable     = ['home_id', 'home_name'];
    protected $primaryKey   = 'home_id';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->timestamps = false;
    }

    static function name($id)
    {
        return $id .' - '. self::where('home_id', $id)->value('home_name');
    }
}
