<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transport extends Model
{
    use HasFactory;

    protected $table        = 'entity__master_transports';
    protected $fillable     = ['transport_id', 'transport_name'];
    protected $primaryKey   = 'transport_id';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->timestamps = false;
    }

    static function name($id)
    {
        return $id .' - '. self::where('transport_id', $id)->value('transport_name');
    }
}
