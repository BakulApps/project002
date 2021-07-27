<?php

namespace App\Models\Finance;

use App\Models\Master\Student;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Midtrans\Config;

class Payment extends Model
{
    use HasFactory;

    protected $table        = 'finance_entity__payments';
    protected $fillable     = [
        'payment_id',
        'payment_number',
        'payment_student',
        'payment_item',
        'payment_cost',
        'payment_transaction',
        'payment_view'
    ];
    protected $primaryKey   = 'payment_id';

    public function created_at($format = null)
    {
        $format = $format == null ? 'd/m/Y' : $format;
        return Carbon::parse($this->crerated_at)->translatedFormat($format);
    }

    public function student()
    {
        return $this->hasOne(
            Student::class,
            'student_id',
            'payment_student'
        );
    }

    static function notify()
    {
        return self::where('payment_view', 0)->count();
    }

    public function transaction()
    {
        if ($this->payment_transaction != null){
            return json_decode($this->payment_transaction, false);
        }
        else {
            return  null;
        }
    }

    public function type($type = null)
    {
        switch ($type){
            case 'credit_card' :
                return 'Kartu Kredit';
            case 'bank_transfer':
                return 'Bank Transfer';
            case 'cstore':
                return 'Indomaret';
            default:
                return 'Lainnya';
        }
    }

    public function status($status = null)
    {
        switch ($status){
            case '200':
                return '<span class="badge badge-success">Berhasil</span>';
            case '201':
                return '<span class="badge badge-warning">Pending</span>';
            case '202':
                return '<span class="badge badge-danger">Ditolak</span>';
            default:
                return 'Lainnya';
        }
    }
}
