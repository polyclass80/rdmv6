<?php

namespace App\Http\Controllers;

use App\Inventory;
use App\Schedule;
use App\Rmpr;
use Symfony\Component\HttpFoundation\Request;

class InventoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        return view('inventory.index');
    }

    public function getInventory(Request $request){

        $data = $request->get('data');
        for($i = 0,$j = 0 ; $i < count($data); $i++) {

            if (isset($data[$i][3])) {
                $rm = Inventory::where('code', $data[$i][3])->get();
                if($rm->count()) {
                    $blockrm = Inventory::withcount('schedules')->find($rm[0]->id);
                    $blockqty = $blockrm->schedules()->sum('block_qty');
                    $blockinfo = $blockqty."   (Blocked by  ".$blockrm->schedules_count."  SRs)";

                    $res[$j] = array(
                        $rm[0]->code, $rm[0]->description, $rm[0]->quantity, $blockinfo, $rm[0]->location
                    );
                    $j ++;
                }
                else{
                    $res[$j] = array(
                        $data[$i][3], "No information for this raw material"
                    );
                    $j++;
                }
            };

        }


        return $res;

    }



    public function updateInventory(Request $request){
        $data = $request->get('data');

        for($i = 0 ; $i < count($data); $i++) {
            $rm = Inventory::where('code', $data[$i][1])->get();
            $res = array();
            if($rm->count()) {
                if($request->get('updatetype')){
                    $rm[0]->quantity = $data[$i][2];

                }
                else{
                    $rm[0]->quantity += $data[$i][2];
                    $data[$i][2] = $rm[0]->quantity;
                }
                $data[$i][4] = "Quantity updated;";

                if($rm[0]->description !== $data[$i][0] ){
                    $data[$i][0] = $rm[0]->description;
                    $data[$i][4] .= "Pls check description;";
                }

                if(isset($data[$i][3]) && $rm[0]->location != $data[$i][3]){
                    $rm[0]->location = $data[$i][3];
                    $data[$i][4] .= "Location updated;";
                }

                $rm[0]->save();

            }
            else{
                $rm = new Inventory();
                $rm->description = $data[$i][0];
                $rm->code= $data[$i][1];
                $rm->quantity= $data[$i][2];
                $rm->location= $data[$i][3];

                $data[$i][4] = "New RM created;";

                $rm->save();

            }
        }




        return $data;

    }

    public function getGetRmCode(){


        if(request('searchtype')){
            $rms = Inventory::where('description', 'like', '%'.request('data').'%')->get();
        }
        else{
            $rms = Inventory::where('code', 'like', '%'.request('data').'%')->get();
        };

        return $rms;

    }

    public function blockInventory(Request $request){

        $data = $request->get('data');
        $schedule = Schedule::find($request->get('id'));
        for($i = 0 ; $i < count($data); $i++) {
            $rm = Inventory::where('code', $data[$i][1])->get();
            if($rm->count()) {
                $schedule->inventorys()->attach($rm[0]->id, ['block_qty' => $data[$i][2]]);
                $data[$i][3] = "RM blocked;";

                if($rm[0]->description !== $data[$i][0] ){
                    $data[$i][0] = $rm[0]->description;
                    $data[$i][3] .= "Pls check description;";
                }

            }
            else{
                $data[$i][3] = "No this RM information;";
            }
        }

        return $data;

    }


    public function checkPrList(){

        $rm = Inventory::all();
        for($i = 0,$j = 0 ; $i < count($rm); $i++) {
            $blockrm = Inventory::withcount('schedules')->find($rm[$i]->id);
            $blockqty = $blockrm->schedules()->sum('block_qty');
            $blockinfo = $blockqty."   (Blocked by  ".$blockrm->schedules_count."  SRs)";

            $prrm = Inventory::withcount('rmprs')->find($rm[$i]->id);
            $prqty = $prrm->rmprs()->sum('pr_qty');
            $prinfo = $prqty."   (By  ".$prrm->rmprs_count."  ongoing PRs)";

            $prsuggestion = $blockqty+$rm[$i]->safeqty-$rm[$i]->quantity-$prqty+0.01;


            if($prsuggestion > 0){
                $res[$j] = array(
                    $rm[$i]->code, $rm[$i]->description, $rm[$i]->quantity, $prinfo, $blockinfo,$rm[$i]->safeqty,$prsuggestion
                );
                $j ++;

            }
        }
        return $res;

    }



    }
