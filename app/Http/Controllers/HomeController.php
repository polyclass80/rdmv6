<?php

namespace App\Http\Controllers;

use App\Inventory;
use Carbon\Carbon;
use App\Schedule;
use App\Attendance;
use App\Rmpr;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Contracts\Validation\Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schedules = Schedule::where('step', '<>', 'completed')->orderBy('due_at' )->paginate(20);

        return view('home.index',compact('schedules'));
    }

    //请假申请

    public function getAttendance()
    {
        $thismonday = new Carbon('last monday');
        $time[] = new Carbon('last monday');
        $time[] = $thismonday->addDays(4);
        $leaves = Attendance::whereBetween('date', $time)->orderBy('date')->get();

        $leavearray = [];

        for($i = 0; $i<count($leaves);$i++){
            $leavearray[$i][]= $time[0]->diffInDays($leaves[$i]->date);
            $leavearray[$i][]= $leaves[$i]->user->name." : ".ucfirst($leaves[$i]->time);
        }

        return $leavearray;

    }

    public function leaveApply()
    {

        $data = request();
        if($data['finish_date'] =='') {
            $this->validate(request(), [
                'start_date' => 'required|date',
                'start_time' => 'required',
                'type' => 'required'
            ]);
            $leave = new Attendance();
            $leave->date = $data['start_date'];
            $leave->time = $data['start_time'];
            $leave->type = $data['type'];
            $leave->user_id = \Auth::id();
            $leave->save();

        }else{
            $this->validate(request(),[
                'finish_date'=> 'date|after:start_date',
            ]);

            $startday=  new Carbon($data['start_date']);
            $finishday=  new Carbon($data['finish_date']);
            $days= $startday->diffInDays($finishday);

            $leave1 = new Attendance();
            $leave1->date = $data['start_date'];
            $leave1->time = $data['start_time'];
            $leave1->type = $data['type'];
            $leave1->user_id = \Auth::id();
            $leave1->save();

            $leave2 = new Attendance();
            $leave2->date = $data['finish_date'];
            $leave2->time = $data['finish_time'];
            $leave2->type = $data['type'];
            $leave2->user_id = \Auth::id();
            $leave2->save();

            if($days>1){
                for($i=1;$i<$days;$i++){
                    $leave = new Attendance();
                    $leave->date = $startday->addDay() ;
                    $leave->time = 'fullday';
                    $leave->type = $data['type'];
                    $leave->user_id = \Auth::id();
                    $leave->save();
                }
            }

        }

        return back();





    }
}
