<?php

namespace App\Http\Controllers;

use App\Models\EmployeeProject;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.working_board.create');
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
            'description' => 'required',
        ]);

        $user_id = Auth::id();
        $code = $this->code(20);
        $data_insert = array(
            'user_id' => $user_id,
            'code' => $code,
        );
        $data = array_merge($request->all(),$data_insert);
        $project_data = Project::create($data);
        $project = Project::find($project_data->id);
        session()->put('project_name',$project->name);
        session()->put('project_id',$project->id);
        return redirect()->route('dashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $project = Project::find(session('project_id'));
        return view('dashboard.setting',compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);
        session()->put('project_name',$request->name);
        Project::find($project->id)->update($request->all());
        return back()->with('success','Update Project is success!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        //
    }

    public function joinProject(Request $request)
    {
        EmployeeProject::where('project_id',$request->project_id)->where('employee_id',$request->employee_id)->update(['status'=>1]);
        $project = Project::find($request->project_id);
        session()->put('project_name',$project->name);
        session()->put('project_id',$project->id);
        return redirect()->route('dashboard');
    }

    public function findProject(Request $request)
    {
        $data = Project::where('code',$request->code)->first();
        if ($data!=null) {
            $response = array('name'=>$data->name, 'id'=>$data->id, 'manager'=>$data->user->name);
        } else {
            $response = '';
        }
        return response($response);
    }

    public function inviteProject(Request $request)
    {
        $user = User::where('email',$request->email)->first();
        if($user!=null){
            EmployeeProject::create([
                'employee_id' => $user->id,
                'project_id' => session('project_id'),
            ]);
            return back()->with('success','Invite is Success');
        }else{
            return back()->with('danger','Email Employee is not registered');
        }
    }

    public function destroyEmployeeProject(EmployeeProject $employee_project)
    {
        EmployeeProject::destroy($employee_project->id);
        return back()->with('success','Cancel Invite Success');
    }

    public function code($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
