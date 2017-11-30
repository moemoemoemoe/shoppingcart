<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Generic;
use App\Brande;
use Validator;
use Redirect;
use App\Zone;

class GenericBrandesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generic_index()
    {
        $generics = Generic::with('zone')->orderBy('id','ASC')->get();

        $zones = Zone::with('room')->orderBy('id','DESC')->get();

        return view('admin.generic_brand.generic_index',compact('generics','zones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generic_index_save(Request $r)
    {
            $foreign_name = mt_rand(111111,999999);
            $generic_name = $r->input('generic_name');

$zone_id =$r->input('zone_id');

            $photo = $r->file('photo');

            $data = ['generic_name' => $generic_name,'photo' => $photo];

            $rules = ['generic_name' => 'required' ,'photo'=> 'required'];

            $v = Validator::make($data, $rules);

            if($v->fails()){
                return Redirect::Back()->withErrors($v);
            }else
            {
                $destination = 'uploads/generic';
                $photo_name = str_replace(' ', '_', $foreign_name);
                $photo_name .= '.'.$photo->getClientOriginalExtension();
                $photo->move($destination, $photo_name);

                $generic = new Generic();
                $generic->generic_name = $generic_name;
                
                $generic->img_name = $photo_name;

                $generic->image_url_original = config('app.my_url_geenric').$photo_name;
               
 $generic->zone_id = $zone_id;
                $generic->save();


                return Redirect::back()->with('success', 'New Generic successfuly created');


            }
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
    public function generic_index_view($id)
    {
        $generics = Generic::findOrfail($id);
        $zones = Zone::orderBy('id','DESC')->get();
        return view('admin.generic_brand.generic_view',compact('generics','zones'));
    }

   
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function generic_index_view_save(Request $r, $id)
    {
        $foreign_name = mt_rand(111111,999999);
            $generic_name = $r->input('generic_name');

$zone_id =$r->input('zone_id');

            $photo = $r->file('photo');

            $data = ['generic_name' => $generic_name];

            $rules = ['generic_name' => 'required'];

            $v = Validator::make($data, $rules);

            if($v->fails()){
                return Redirect::Back()->withErrors($v);
            }else
            {
                  if($r->hasFile('photo')){
                $destination = 'uploads/generic';
                $photo_name = str_replace(' ', '_', $foreign_name);
                $photo_name .= '.'.$photo->getClientOriginalExtension();
                $photo->move($destination, $photo_name);
}
                $generic = Generic::findOrFail($id);
                $generic->generic_name = $generic_name;
                $generic->zone_id = $zone_id;
                if($r->hasFile('photo')){
                    unlink('uploads/generic/'.$generic->img_name);
                $generic->img_name = $photo_name;

                $generic->image_url_original = config('app.my_url_geenric').$photo_name;
               }
              
                 
                $generic->save();


                return Redirect::back()->with('success', 'New Generic successfuly Updated');


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
