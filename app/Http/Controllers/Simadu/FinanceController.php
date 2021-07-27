<?php

namespace App\Http\Controllers\Simadu;

use App\Http\Controllers\Controller;
use App\Models\Finance\Item;
use App\Models\Finance\Payment;
use App\Models\Master\School;
use App\Models\Master\Student;
use App\Models\Master\Territory;
use App\Models\Student\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Midtrans\Config;
use Midtrans\Snap;

class FinanceController extends Controller
{
    protected $data;

    public function __construct()
    {
        $this->data['school'] = School::first();
        $this->data['setting'] = new Setting();
    }

    public function invoice()
    {
        $this->data['lack'] = Student::find(Session::get('simadu.auth')->student_id)->lack()->get();
        return view('simadu.finance_invoice', $this->data);
    }

    public function payment(Request $request)
    {
        if ($request->isMethod('post')){
            if ($request->_type == 'data' && $request->_data == 'all'){
                $payment_item = '';
                foreach (Payment::where('payment_student', Session::get('simadu.auth')
                    ->student_id)->OrderBy('payment_date', 'DESC')->get() as $payment){
                    $payment_items = json_decode($payment->payment_item, true);
                    for ($i=0;$i<count($payment_items);$i++){
                        $payment_item .= Item::where('item_id', $payment_items[$i])->value('item_name') .', ';
                    }
                    $payment_item = Str::substr($payment_item, 0, -2);
                    $data[] = [
                        $payment->payment_number,
                        $payment_item,
                        $payment->transaction() != null ? $payment->type($payment->transaction()->payment_type) : '',
                        $payment->created_at('d/m/Y H:i:s'),
                        $payment->transaction() != null ? $payment->transaction()->transaction_time : '',
                        $payment->transaction() != null ? $payment->status($payment->transaction()->status_code) : '',
                        number_format($payment->payment_cost),
                        '<div class="btn-group">
                            <button class="btn btn-outline-primary bt-sm btn-info" data-num="'.$payment->payment_id.'"><i class="icon-info3"></i></button>
                            <button class="btn btn-outline-primary bt-sm btn-delete" data-num="'.$payment->payment_id.'"><i class="icon-trash"></i></button>
                         </div>
                         '
                    ];
                };
                $msg = ['data' => empty($data) ? [] : $data];
            }
            elseif ($request->_type == 'data' && $request->_data == 'payment'){
                $payment = Payment::find($request->payment_id);
                $payment->created_at_convert = $payment->created_at('d M Y');
                $msg = $payment;
            }
            elseif ($request->_type == 'delete'){
                try {
                    $payment = Payment::find($request->payment_id);
                    if ($payment->delete()){
                        $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Data Pembayaran berhasil dihapus.'];
                    }
                } catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            elseif ($request->_type == 'update' && $request->_data == 'payment'){
                try {
                    $payment = Payment::where('payment_number', $request->payment_number);
                    $payment->update([
                        'payment_transaction' => json_encode($request->payment_transaction)
                    ]);
                    $msg = [];
                }catch (\Exception $e){
                    $msg = ['title' => 'Kesalahan !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            elseif ($request->_type == 'store'){
                try {
                    $payment = new Payment();
                    $payment->payment_number = Str::upper(Str::random(9));
                    $payment->payment_student = Session::get('simadu.auth')->student_id;
                    $payment->payment_item = json_encode($request->payment_item);
                    $payment->payment_cost = preg_replace("/[^0-9]/", '', $request->payment_cost);
                    $payment->payment_status = 0;
                    $payment->payment_view = 0;
                    if ($payment->save()){
                        $params = [
                            'transaction_details' => [
                                'order_id' => $payment->payment_number,
                                'gross_amount' => $payment->payment_cost
                            ],
                            'customer_details' => [
                                'last_name' => Session::get('simadu.auth')->student_name,
                                'email' => Session::get('simadu.auth')->student_mail,
                                'phone' => Session::get('simadu.auth')->student_phone,
                                'address' => Session::get('simadu.auth')->student_address,
                                'city' => Territory::subdistric(Session::get('simadu.auth')->student_subdistric)
                            ]
                        ];
                        $msg = ['status' => 'success', 'data' => $params];
                    }
                } catch (\Exception $e){
                    $msg = ['status' => 'failed', 'title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            elseif ($request->_type == 'getAuthToken'){
                Config::$serverKey = env('MIDTRANS_SERVER_KEY');
                Config::$isProduction = false;
                Config::$isSanitized = false;
                Config::$is3ds = false;
                $msg = ['token' => Snap::getSnapToken($request->_data)];
            }
            return response()->json($msg);
        }
        else {
            $this->data['lack'] = Student::find(Session::get('simadu.auth')->student_id)->lack()->get();
            return view('simadu.finance_payment', $this->data);
        }
    }

    public function notify(Request $request)
    {
        $payment = Payment::where('payment_number', $request->order_id);
        $payment->update([
            'payment_transaction' => json_encode($request->all())
        ]);
    }

    public function getToken(Request $request)
    {
        Config::$serverKey = 'SB-Mid-server-LQSlncoaJDwOTwsEC-zXccf_';
        Config::$isProduction = false;
        Config::$isSanitized = false;
        Config::$is3ds = false;
        return Snap::getSnapToken($request->_data);
    }
}
