<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Request;

use App\Color;
use App\Characteristic;
use App\Baseresin;
use App\Tradename;
use App\Gradename;


class NomenclatureController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function create(Request $request){
        $gradename = new Gradename();
        $gradename->maincode = $request->get('maincode');
        $gradename->serialnum = $request->get('serialnum');
        $gradename->gradename = $request->get('gradename');
        $gradename->sr = $request->get('sr');
        $gradename->comment = $request->get('comment');
        $gradename->save();

        $createmsg = $gradename->gradename." has been created.";

        return compact('createmsg');

    }



    public function getSerial(Request $request){
        $maincode = strtoupper(($request->get('data')));
        $lastcode = Gradename::where('maincode',$maincode)->orderBy('serialnum')->get()->last();
        if(isset($lastcode)){
            $newcode = $lastcode->serialnum+1;
        }else{
            $newcode = 8001;
        }

        return compact('maincode','newcode');
    }


    public function getName(){
        $baseresins = Baseresin::all();

        $colors = Color::all();

        $characteristics = Characteristic::all();

        $tradenames = Tradename::all();

        return compact('baseresins','colors','tradenames','characteristics');
    }



}
