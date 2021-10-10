<?php

namespace ACME\CustomShipping\Http\Controllers;

use ACME\CustomShipping\Models\City;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;  

Class CityController extends Controller{

    protected $_config;

    public function __construct(){
        $this->_config = request('_config');
    }  
    

    public function index(){
        return "hello";
    }

    public function create(){
        return view('admin::cities.create');
    }

    public function store(){
        $this->validate(request(), [
            'name' => 'required',
            'country' => 'required',
        ]);
       
        $city=new City();
        $country_id=request()->input('country');
        $city->country_id= $country_id;
        $city->name=request()->input('name');
        //dd($country_id,request()->input('name'));
        $city->save();

        return redirect()->route($this->_config['redirect']);
    }

    public function edit($id){  
          $city=City::find($id);
          return view($this->_config['view'], compact('city'));
      
    }
    
    public function update($id){  
        $this->validate(request(), [
            'name' => 'required',
            'country' => 'required',
        ]);
       
        $city=City::find($id);
        $country_id=request()->input('country');
        $city->country_id= $country_id;
        $city->name=request()->input('name');
        //dd($country_id,request()->input('name'));
        $city->update();

        return redirect()->route($this->_config['redirect']);
      
          
    }
    
    public function destroy($id){  
        $city=City::find($id);
        if($city->country_id==70){
            try {
                $city->delete();

                session()->flash('success', trans('admin::app.response.delete-success', ['name' => 'City']));

                return response()->json(['message' => true], 200);
            } catch (\Exception $e) {
                session()->flash('error', trans('admin::app.response.delete-failed', ['name' => 'City']));
            }
        }
        return response()->json(['message' => "Delete is only available for Egybt country with code 70"], 400);
             
    }
}