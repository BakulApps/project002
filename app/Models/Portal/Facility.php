<?php

namespace App\Models\Portal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    use HasFactory;

    protected $table        = 'portal_entity__facilities';
    protected $fillable     = ['facility_name', 'facility_desc', 'facility_image'];
    protected $primaryKey   = 'facility_id';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->timestamps = false;
    }
}
