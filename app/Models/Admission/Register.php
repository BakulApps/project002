<?php

namespace App\Models\Admission;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Register extends Model
{
    use HasFactory;

    protected $table        = 'admission_entity__registers';
    protected $fillable     = ['register_id', 'register_name', 'register_desc'];
    protected $primaryKey   = 'register_id';

    public $timestamps      = false;
}
