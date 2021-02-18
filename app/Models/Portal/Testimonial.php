<?php

namespace App\Models\Portal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $table    = 'portal_entity__testimonials';
    protected $fillable = ['testimonial_name', 'testimonial_job', 'testimonial_desc', 'testimonial_image'];
    protected $primaryKey   = 'testimonial_id';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->timestamps = false;
    }
}
