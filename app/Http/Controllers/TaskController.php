<?php

namespace App\Http\Controllers;

use App\Models\EmployeeProject;
use App\Models\Project;
use App\Models\Task;
use App\Models\Tracking;
use App\Models\TrackingApplication;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $project_id = session('project_id');
        $project = Project::find($project_id);
        if($project->user_id == Auth::id()){
            $employee = EmployeeProject::all()->where('project_id',$project_id);
            $employee_task = array();
            foreach($employee as $item){
                array_push($employee_task, $item->id);
            }
            $task = Task::all()->whereIn('employee_project_id',$employee_task);
            return view('dashboard.task.index', compact('task','employee','project'));
        }
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
        $request->validate([
            'name' => 'required',
            'employee_id' => 'required'
        ]);

        $user = EmployeeProject::where('employee_id',$request->employee_id)->where('project_id',session('project_id'))->first();
        if($user!=null){
            Task::create([
                'name' => $request->name,
                'employee_project_id' => $user->id
            ]);
            return back()->with('success','Create Task is Success');
        }else{
            return back()->with('danger','Email Employee is not registered');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(EmployeeProject $task, $date = null)
    {
        if ($date==null) {
            $date = Carbon::now();
        }
        $data = Tracking::where('employee_project_id',$task->id)->whereDate('updated_at',$date)->get();
        $app_array = array();
        foreach ($data as $item ) {
            array_push($app_array,$item->id);
        }
        $appToday = TrackingApplication::all()->whereIn('tracking_id',$app_array)->groupBy('application_id');
        // dd($appAll);
        return view('dashboard.monitoring.detail_employee', compact('appAll','appToday'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'name' => 'required',
        ]);

        Task::find($task->id)->update([
            'name' => $request->name,
        ]);
        return back()->with('success','Update Task is Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        Task::destroy($task->id);
        return back()->with('success','Delete Task "'.$task->name.'" is Success');
    }
}
