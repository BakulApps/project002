<?php

namespace App\Models\Portal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $table        = 'portal_entity__sections';
    protected $fillable     = ['section_title', 'section_content'];
    protected $primaryKey   = 'section_id';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->timestamps = false;
    }

    public function value($section_name)
    {
        return self::where('section_name', $section_name)->value('section_content');
    }
}
