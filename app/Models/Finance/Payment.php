<?php

namespace App\Models\Finance;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'payment_type_account',
        'payment_name_account',
        'payment_number_account',
        'payment_date',
        'payment_status',
        'payment_file',
        'payment_view',
    ];
    protected $primaryKey   = 'payment_id';

    public function created_at($format = null)
    {
        $format = $format == null ? 'd/m/Y' : $format;
        return Carbon::parse($this->crerated_at)->translatedFormat($format);
    }
}
