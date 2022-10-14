<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\Problem;
use Illuminate\Support\Str;
use DB;
use Auth;

use Gate;
use App\User;
use App\Course;
use Illuminate\Support\Facades\Input;
use Response;

use Session;
class UserController extends Controller
{
    public function __construct()
       {
           $this->middleware('auth');
       }
       function index(){
        
        return view('frontend.index');
       }

       public function profile(){
        $districts = DB::table('districts')->orderBy('district_name','ASC')->get();
        $data['districts'] = $districts;
        $userpropartys = DB::table('poperty_taxes')
        ->join('users','poperty_taxes.user_id','users.id')
        ->join('districts','poperty_taxes.divition','districts.id')
        ->join('municipalities','poperty_taxes.municipality','municipalities.id')
        ->join('wards','poperty_taxes.ward','wards.id')
        ->join('blocks','poperty_taxes.block','blocks.id')
        ->join('subblocks','poperty_taxes.subblock','subblocks.id')
        ->join('nids','users.nid_number','nids.nid_number')
        ->select('poperty_taxes.*','users.name','users.nid_number','users.phone',
        'districts.district_name','municipalities.municipalitie_name',
        'wards.ward as ward_name','blocks.block_name','subblocks.subblock_name','nids.image')
        ->get();
        $data1['userpropartys'] = $userpropartys;
        return view('frontend.profile',$data,$data1);
       }
       public function TaxPayList(){
        $userpropartys = DB::table('poperty_taxes')
        ->join('users','poperty_taxes.user_id','users.id')
        ->join('districts','poperty_taxes.divition','districts.id')
        ->join('municipalities','poperty_taxes.municipality','municipalities.id')
        ->join('wards','poperty_taxes.ward','wards.id')
        ->join('blocks','poperty_taxes.block','blocks.id')
        ->join('subblocks','poperty_taxes.subblock','subblocks.id')
        ->join('nids','users.nid_number','nids.nid_number')
        ->select('poperty_taxes.*','users.name','users.nid_number','users.phone',
        'districts.district_name','municipalities.municipalitie_name',
        'wards.ward as ward_name','blocks.block_name','subblocks.subblock_name','nids.image')
        ->get();
        $data['userpropartys'] = $userpropartys;
        return view('frontend.tax_pay',$data);
       }

       public function Store(Request $request){

        if(Auth::check()){
            

            $problem = new Problem(); 
            $problem->name = $request->name;
            $problem->user_id = auth()->user()->id;
            $problem->email = $request->email;
            $problem->phone = $request->phone;
            $problem->problem_title = $request->problem_title;
            $problem->problem_details = $request->problem_details;
            $problem->room_number = $request->room_number;
            $problem->floor_number = $request->floor_number;
            $problem->equipment_number = $request->equipment_number;
            $problem->status = 1;
            $problem->service_id = $request->service_id;
            
            $done = $problem->save();

            if ($done) {
                $notification = array(
                    'message' => 'About Us Added Successfully.',
                    'alert-type' => 'success'
                );
                return redirect()->back()->with($notification);
            }else{
                $notification = array(
                    'message' => 'Branch Added Unuccessfully',
                    'alert-type' => 'danger'
                );
                return redirect()->back()->with($notification);
            }

        }else{
            
            $notification = array(
                'message' => 'AT first login your account',
                'alert-type' => 'warning'
            );
            return redirect()->route('login')->with($notification);
        }
        
       }

       public function TaxPaymentHistory(){
        $payments = DB::table('payments')
                ->join('users','payments.user_id','users.id')
                 ->where('user_id',auth()->user()->id)
                ->select('payments.*','users.name','users.nid_number','users.phone',
                )
                ->get();
                $data['payments'] = $payments;
                return view('frontend.payment_history',$data);
       }


       public function delete($id)
       {
           $problem = Problem::find($id);
           if($problem){
               $status = $problem->delete();
               if ($status) {
                   $notification = array(
                       'message' => 'problem Delete Successfully.',
                       'alert-type' => 'success'
                   );
                   return redirect()->back()->with($notification);
               }
           }else{
               $notification = array(
                   'message' => 'problem Delete Unsuccessfully',
                   'alert-type' => 'danger'
               );
               return redirect()->back()->with($notification);
           }
       }

       
}
