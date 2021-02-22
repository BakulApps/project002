<?php

namespace App\Models\Portal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;

    protected $table        = 'portal_entity__programs';
    protected $fillable     = ['program_name', 'program_desc', 'program_link', 'program_image'];
    protected $primaryKey   = 'program_id';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->timestamps = false;
    }
}
