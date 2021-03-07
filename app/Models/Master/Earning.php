<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Earning extends Model
{
    use HasFactory;

    protected $table        = 'entity__master_earnings';
    protected $fillable     = ['earning_id', 'earning_name'];
    protected $primaryKey   = 'earning_id';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->timestamps = false;
    }

    static function name($id)
    {
        return $id .' - '. self::where('earning_id', $id)->value('earning_name');
    }
}
