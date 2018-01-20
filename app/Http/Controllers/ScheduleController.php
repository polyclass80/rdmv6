<?php
/**
 * Created by PhpStorm.
 * User: Jack
 * Date: 2017/5/21
 * Time: 15:16
 */

namespace App\Http\Controllers;

use App\Schedule;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Request;

class ScheduleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('schedule.index');
    }

    public function getSchedule(Request $request)
    {
         $step = $request->get('step');
        $schedules = Schedule::where('step', '=', $step)->orderby('schedule_at' )->get();
        foreach($schedules as $schedule){
            $schedule->username = $schedule->user->name;
        };

         return $schedules;
    }

    public function getRmBlock(Request $request)
    {
        $schedule = Schedule::where('sr', '=', $request->get('sr'))->where('step', '<', 7)->first();

        return $schedule;
    }

    public function create(Request $request){

        $schedule = new Schedule;

        $data1 = $request->get('data');
        $data = $data1[0];
        $schedule->sr = $data[0];
        $schedule->opportunity = $data[1];
        $schedule->due_at = new Carbon($data[2]);
        $schedule->step = $data[3];
        $schedule->screw = $data[4];
        $schedule->grade = $data[5];
        $schedule->lot = $data[6];
        $schedule->quantity = $data[7];
        $schedule->formula = $data[8];
        $schedule->comment = $data[9];
        $schedule->schedule_at = (new Carbon())->addDays(20);
        $schedule->user_id = \Auth::id();
        $schedule->save();

        return json_encode($schedule);


    }

    public function update(Request $request){
        $data = $request->get('schedule');
        $schedule = Schedule::find($data['id']);
        $schedule->step = $data['step'];

        if($schedule->save()){
            $schedules = Schedule::where('step', '=', 'zsk18')->orderby('schedule_at' )->get();
            return redirect('schedule/index');
        }
    }

    public function scheduleUpdate(Request $request){
        $schedule = Schedule::find($request->get('id'));
        if($request->get('content')==1){
            $schedule->screw = $request->get('data');
        }
        elseif($request->get('content')==11){
            $schedule->comment = $request->get('data');
        }
        else{
            $schedule->schedule_at = $request->get('data');
        }
        if($schedule->save()){
            return $schedule;
        }
    }



}