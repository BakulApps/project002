<?php

namespace App\Models\Admission;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table        = 'admission_entity__payments';
    protected $fillable     = ['payment_id', 'payment_student', 'payment_invoice', 'payment_amount', 'payment_remaining', 'payment_status', 'payment_account_type', 'payment_account_number',
        'payment_account_name', 'payment_transaction_date', 'payment_transaction_file'];
    protected $primaryKey   = 'payment_id';

    public $timestamps      = false;

    public function student()
    {
        return $this->hasOne(
            Student::class,
            'student_id',
            'payment_student'
        );
    }

    public function invoice()
    {
        return $this->hasOne(
            Invoice::class,
            'invoice_id',
            'payment_invoice'
        );
    }

    public function created_at($format = null)
    {
        $format = $format == null ? 'd/m/Y' : $format;
        return Carbon::parse($this->student->created_at)->translatedFormat($format);
    }

    public function status()
    {
        if ($this->payment_status == 1){
            return '<span class="badge badge-danger">Menunggu Pembayaran</span>';
        }
        elseif ($this->payment_status == 2){
            return '<span class="badge badge-warning">Menunggu Verifikasi</span>';
        }
        elseif ($this->payment_status == 3){
            return '<span class="badge badge-success">Pembayaran Berhasil</span>';
        }
        elseif ($this->payment_status == 4){
            return '<span class="badge badge-success">Pembayaran Berhasil (Tunai)</span>';
        }
        else {
            return '<span class="badge badge-danger">Pembayaran Ditolak</span>';
        }
    }

}
