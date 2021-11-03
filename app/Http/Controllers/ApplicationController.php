<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Category;
use App\Models\Productivity;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::all();
        $data = Application::all()->where('category_id',15);
        $productivity = Productivity::all()->where('status',0)->count();
        return view('admin.app.index',compact('data','category','productivity'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function show(Application $application)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function edit(Application $application)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Application $app)
    {
        if ($request->category_id==2||$request->category_id==3||$request->category_id==10||$request->category_id==1) {
            $type = ['application_type_id'=>1];
        } else if($request->category_id==4||$request->category_id==5||$request->category_id==7||$request->category_id==8||$request->category_id==9||$request->category_id==11||$request->category_id==12||$request->category_id==13) {
            $type = ['application_type_id'=>4];
        }else{
            $type = ['application_type_id'=>2];
        }

        for ($i=1; $i < 7; $i++) {
            Productivity::create([
                'app_id' => $app->id,
                'category_id' => $app->category_id,
                'role_id'=>$i
            ]);
        }
        $data = array_merge($type,$request->all());
        Application::find($app->id)->update($data);
        return back()->with('success','Update berhasil!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function destroy(Application $application)
    {
        //
    }

    public function svm()
    {
        $output = shell_exec('F:\Data-Mining\SVM\script.R');
        echo "<pre>$output</pre>";
    }
}
