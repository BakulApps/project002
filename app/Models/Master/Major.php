<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
    use HasFactory;

    protected $table        = 'entity__master_majors';
    protected $fillable     = ['major_name'];
    protected $primaryKey   = 'major_id';
    public $timestamps      = false;


}
