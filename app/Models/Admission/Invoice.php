<?php

namespace App\Models\Admission;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $table        = 'admission_entity__invoices';
    protected $fillable     = ['invoice_id', 'invoice_student', 'invoice_amount', 'invoice_status'];
    protected $primaryKey   = 'invoice_id';

    public $timestamps      = false;

    public function status()
    {
        if ($this->invoice_status == 1){
            return 'Tagihan belum lunas.';
        }
        else {
            return 'Tagihan telah lunas';
        }
    }

    public function student()
    {
        return $this->hasOne(
            Student::class,
            'student_id',
            'invoice_student'
        );
    }
    public function payment()
    {
        return $this->hasOne(
            Payment::class,
            'payment_invoice',
            'invoice_id'
        );
    }
    public function remaining()
    {
        return ($this->invoice_amount - $this->payment()->where(function ($query){
            $query->where('payment_status', '=', '4')->orWhere('payment_status', '=', '3');
            })->sum('payment_amount'));
    }
}
