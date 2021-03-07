<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Religion extends Model
{
    use HasFactory;

    protected $table        = 'entity__master_religions';
    protected $fillable     = ['religion_id', 'religion_name'];
    protected $primaryKey   = 'religion_id';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->timestamps = false;
    }

    static function name($id)
    {
        return $id .' - '. self::where('religion_id', $id)->value('religion_name');
    }
}
