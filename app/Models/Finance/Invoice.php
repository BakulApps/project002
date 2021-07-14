<?php

namespace App\Models\Finance;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $table        = 'finance_entity__invoices';
    protected $fillable     = [
        'invoice_id',
        'invoice_file',
    ];
    protected $primaryKey   = 'invoice_id';

    public function created_at($format)
    {
        $format = $format == null ? 'd/m/Y H:i:s' : $format;
        return Carbon::parse($this->created_at)->formatLocalized($format);
    }
}
