<?php

namespace App\Models\Admission;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;

    protected $table        = 'admission_entity__banks';
    protected $fillable     = ['bank_id', 'bank_type', 'bank_number', 'bank_name', 'bank_status'];
    protected $primaryKey   = 'cost_id';

    public $timestamps      = false;

    public function status()
    {
        return $this->bank_status == 1 ? "<span class='badge badge-pill badge-success'>Aktif</span>" : "<span class='badge badge-pill badge-danger'>Tidak aktif</span>";
    }
}
