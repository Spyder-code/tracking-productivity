<?php

namespace App\Http\Controllers;

use App\Models\Capture;
use App\Models\EmployeeProject;
use App\Models\Project;
use App\Models\Task;
use App\Models\Tracking;
use App\Models\TrackingApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function start(){
        $project = Project::all()->where('user_id',Auth::id());
        $project_in_employee_array = array();
        foreach ($project as $item) {
            $data = EmployeeProject::where('project_id',$item->id)->first();
            array_push($project_in_employee_array,$data->id);
        }
        if ($project->count()<=0) {
            $data = null;
        }
        $project_in_employee = $project;
        $employee_project = EmployeeProject::all()->where('employee_id',Auth::id())->where('status',1);
        return view('dashboard.working_board.index',compact('project_in_employee','employee_project'));
    }

    public function account()
    {
        $data = url()->previous();
        $arr = explode('/',$data);
        if (url('/').'/start' == url()->previous()||url()->previous()== url('/').'/account' ||url()->previous()== url('/').'/join' ||url()->previous()== url('/').'/project/create' || url()->previous()== url('/').'/main/'.$arr[count($arr)-1]) {
            return view('dashboard.account_start');
        } else {
            dd(url()->previous());
        }
    }

    public function joinProject()
    {
        $project_task = EmployeeProject::all()->where('employee_id',Auth::id())->where('status',0);
        return view('dashboard.working_board.join',compact('project_task'));
    }

    public function toProject(Request $request)
    {
        $project = Project::find($request->id);
        session()->put('project_name',$project->name);
        session()->put('project_id',$project->id);
        return redirect()->route('dashboard');
    }

    public function dashboard()
    {
        if (session()->has('project_id')) {
            $project_id = session('project_id');
            $project = Project::find($project_id);
            if($project->user_id == Auth::id()){
                return view('dashboard.project.main');
            }else{
                return redirect()->route('dashboard.main.employee',['date'=>'today']);
            }
        }else{
            return abort(404);
        }
    }

    public function monitoring()
    {
        $project_id = session('project_id');
        $data = EmployeeProject::all()->where('project_id',$project_id);
        $task = Task::join('employee_projects','employee_projects.id','=','tasks.employee_project_id')
                    ->join('projects','projects.id','=','employee_projects.project_id')
                    ->where('projects.id',$project_id)
                    ->select('tasks.*')
                    ->get();
        $task_complete = Task::join('employee_projects','employee_projects.id','=','tasks.employee_project_id')
                    ->join('projects','projects.id','=','employee_projects.project_id')
                    ->where('projects.id',$project_id)
                    ->where('tasks.status',1)
                    ->select('tasks.*')
                    ->count();
        $task_uncomplete = Task::join('employee_projects','employee_projects.id','=','tasks.employee_project_id')
                    ->join('projects','projects.id','=','employee_projects.project_id')
                    ->where('projects.id',$project_id)
                    ->where('tasks.status',0)
                    ->select('tasks.*')
                    ->count();
        $task_total = $task->count();
        $complete = ($task_complete/$task_total) * 100;
        $uncomplete = ($task_uncomplete/$task_total) * 100;
        return view('dashboard.monitoring.index',compact('data','task','task_complete','task_uncomplete','complete','uncomplete'));
    }

    public function monitoringEmployee(EmployeeProject $task, $date)
    {
        if ($date=='today') {
            $date = Carbon::now();
        }else if($date=='yesterday'){
            $date = Carbon::yesterday();
        }
        $data = Tracking::where('employee_project_id',$task->id)->whereDate('updated_at',$date)->get();
        $app_array = array();
        foreach ($data as $item ) {
            array_push($app_array,$item->id);
        }
        $app = TrackingApplication::all()->whereIn('tracking_id',$app_array)->groupBy('application_id');
        $capture = Capture::all()->whereIn('tracking_id',$app_array);
        return view('dashboard.monitoring.detail_employee', compact('app','task','date','capture'));
    }

    public function mainEmployee($date)
    {
        $project_id = session('project_id');
        $project = Project::find($project_id);
        $task = EmployeeProject::where('employee_id',Auth::id())->where('project_id',$project_id)->first();
        if ($date=='today') {
            $date = Carbon::now();
        }else if($date=='yesterday'){
            $date = Carbon::yesterday();
        }
        $data = Tracking::where('employee_project_id',$task->id)->whereDate('updated_at',$date)->get();
        $app_array = array();
        foreach ($data as $item ) {
            array_push($app_array,$item->id);
        }
        $app = TrackingApplication::all()->whereIn('tracking_id',$app_array)->groupBy('application_id');
        $capture = Capture::all()->whereIn('tracking_id',$app_array);
        $task_list = Task::all()->where('employee_project_id',$task->id);
        return view('dashboard.employee.index', compact('app','task','date','capture','project','task_list'));
    }

}
