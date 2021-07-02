<?php

namespace App\Models\Finance;

use App\Models\Master\Bank;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;
    protected $table        = 'finance_entity__accounts';
    protected $fillable     = [
        'account_id',
        'account_bank',
        'account_number',
        'account_name',
        'account_active',
    ];
    protected $primaryKey   = 'account_id';

    public function bank()
    {
        return $this->hasOne(
            Bank::class,
            'bank_id',
            'account_bank'
        );
    }

    static function active($column)
    {
        return self::where('account_active', 1)->value($column);
    }
}
