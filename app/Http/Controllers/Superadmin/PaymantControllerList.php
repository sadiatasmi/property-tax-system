<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\payment;

use DB;
class PaymantControllerList extends Controller
{
     public function index(){
       $payments = DB::table('payments')
                ->join('users','payments.user_id','users.id')
                // ->where('user_id',auth()->user()->id)
                ->select('payments.*','users.name','users.nid_number','users.phone',
                )
                ->get();
       return view('backend.superadmin.payment.manage',compact('payments'));
     }

     public function DeletePayment($id){
        $payment = payment::find($id);
        if($payment){
            $status = $payment->delete();
            if ($status) {
                $notification = array(
                    'message' => 'payment Delete Successfully.',
                    'alert-type' => 'success'
                );
                return redirect()->route('payment_list')->with($notification);
            }
        }else{
            $notification = array(
                'message' => 'payment Delete Unsuccessfully',
                'alert-type' => 'danger'
            );
            return redirect()->back()->with($notification);
        }
     }
}
