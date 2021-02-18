<?php

namespace App\Models\Portal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Extracurricular extends Model
{
    use HasFactory;

    protected $table        = 'portal_entity__extracurriculars';
    protected $fillable     = ['extracurricular_name', 'extracurricular_desc', 'extracurricular_image'];
    protected $primaryKey   = 'extracurricular_id';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->timestamps = false;
    }
}
