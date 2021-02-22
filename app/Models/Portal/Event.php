<?php

namespace App\Models\Portal;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $table        = 'portal_entity__events';
    protected $fillable     = ['event_image', 'event_title', 'event_content', 'event_place', 'event_time', 'event_date_start', 'event_date_end', 'event_content'];
    protected $primaryKey   = 'event_id';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->timestamps = false;
    }

    public function date_start($format = null)
    {
        if ($format != null){
            return Carbon::parse($this->event_date_start)->translatedFormat($format);
        }
        else {
            return Carbon::parse($this->event_date_start)->translatedFormat('d M Y');
        }
    }

    public function date_end($format = null)
    {
        if ($format != null){
            return Carbon::parse($this->event_date_end)->translatedFormat($format);
        }
        else {
            return Carbon::parse($this->event_date_end)->translatedFormat('d M Y');
        }
    }
}
