<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Poperty_tax;
use Illuminate\Support\Str;
use DB;
use DateTime;
use Image;
class UserPropartyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userpropartys=DB::table('poperty_taxes')
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

        return view('backend.superadmin.proparty.manage',compact('userpropartys'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $Poperty_tax = Poperty_tax::find($id);
        if($Poperty_tax){
            $Poperty_tax->poperty_tax = $request->poperty_tax;
            $done = $Poperty_tax->save();
            if ($done) {
                $notification = array(
                    'message' => 'Poperty tax Assign Successfully.',
                    'alert-type' => 'success'
                );
                return redirect()->back()->with($notification);
            }else{
                $notification = array(
                    'message' => 'Poperty Tax Assign Unuccessfully',
                    'alert-type' => 'danger'
                );
                return redirect()->back()->with($notification);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
