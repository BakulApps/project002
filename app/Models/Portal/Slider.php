<?php

namespace App\Models\Portal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    protected $table        = 'portal_entity__sliders';
    protected $fillable     = ['slider_title',
        'slider_content',
        'slider_button_link_1',
        'slider_button_name_1',
        'slider_button_link_2',
        'slider_button_name_2',
        'slider_image'];
    protected $primaryKey   = 'slider_id';
}
