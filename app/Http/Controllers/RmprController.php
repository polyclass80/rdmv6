<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Request;
//use Illuminate\Http\Request;
use App\Inventory;
use App\Rmpr;

class RmprController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        $prs = Rmpr::where( 'completed_at',null)->get();
        return view('rmpr.index',compact('prs'));
    }

    public function checkPrList(){

        $rm = Inventory::all();
        for($i = 0,$j = 0 ; $i < count($rm); $i++) {
            $blockrm = Inventory::withcount('schedules')->find($rm[$i]->id);
            $blockqty = round($blockrm->schedules()->sum('block_qty'),1);
            $blockinfo = $blockqty."   (Blocked by  ".$blockrm->schedules_count."  SRs)";

            $prrm = Inventory::withcount('rmprs')->find($rm[$i]->id);
            $prqty = round($prrm->rmprs()->sum('pr_qty'),1);
            $prinfo = $prqty."   (By  ".$prrm->rmprs_count."  ongoing PRs)";
            $prsuggestion = $blockqty+$rm[$i]->safeqty-$rm[$i]->quantity-$prqty+0.1;
            if($prsuggestion>0){
                $res[$j] = array(
                    $rm[$i]->code, $rm[$i]->description, round($rm[$i]->quantity,1), $prinfo, $blockinfo,$rm[$i]->safeqty,round($prsuggestion,1)
                );
                $j ++;

            }
        }
        return $res;

    }

    public function createPr(Request $request){

        $data = $request->get('data');
        $newpr = new Rmpr();
        $newpr->created_at = time();
        $newpr->save();
        $res = array();
        for($i = 0 ; $i < count($data); $i++) {
            $rm = Inventory::where( 'code',$data[$i][0])->get();
            if($rm->count()) {
                $newpr->inventorys()->attach($rm[0]->id, ['pr_qty' => $data[$i][6],'comment' => $data[$i][7]]);
                $res[$i] = array(
                    $data[$i][0], $data[$i][1],$data[$i][6],'PR created for this RM'
            );
            }
            else{
                $res[$i] = array(
                    $data[$i][0], $data[$i][1],$data[$i][6],'No this RM information'
                );
            }
        }

        return $res;


    }
}
