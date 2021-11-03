<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EmployeeProjectResource;
use App\Http\Resources\TaskResource;
use App\Models\Application;
use App\Models\Capture;
use App\Models\EmployeeProject;
use App\Models\Productivity;
use App\Models\Task;
use App\Models\Tracking;
use App\Models\TrackingApplication;
use Illuminate\Http\File;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File as FacadesFile;
use Illuminate\Support\Facades\Storage;
use Image;

class DataController extends Controller
{
    public function project($id)
    {
        $employee_project = EmployeeProject::all()->where('employee_id',$id)->where('status',1);
        return EmployeeProjectResource::collection($employee_project);
    }

    public function task($id)
    {
        $task = Task::all()->where('employee_project_id',$id);
        return TaskResource::collection($task);
    }

    public function taskStatus(Task $task)
    {
        if ($task->status==0) {
            Task::find($task->id)->update(['status'=>1]);
        }else{
            Task::find($task->id)->update(['status'=>0]);
        }

        return response($task->employee_project_id);
    }

    public function startTracking(EmployeeProject $employee_project)
    {
        $mytime = Carbon::now();

        $tracking = Tracking::create([
            'employee_project_id' => $employee_project->id,
            'time_start' => $mytime->toTimeString(),
        ]);

        return response($tracking->id);
    }

    public function stopTracking()
    {
        $mytime = Carbon::now();
        $tracking = Tracking::find(request('id'));
        $tracking->update([
            'time_stop' => $mytime->toTimeString(),
            'total_time' => request('total_time')
        ]);

        $total = 0;
        $data = Tracking::all()->where('employee_project_id',request('employee_project_id'));
        foreach ($data as $item ) {
             // Explode by seperator :
            $temp = explode(":", $item->total_time);

            // Convert the hours into seconds
            // and add to total
            $total+= (int) $temp[0] * 3600;

            // Convert the minutes to seconds
            // and add to total
            $total+= (int) $temp[1] * 60;

            // Add the seconds to total
            $total+= (int) $temp[2];
        }

        $formatted = sprintf('%02d:%02d:%02d',
                ($total / 3600),
                ($total / 60 % 60),
                $total % 60);
        EmployeeProject::find($tracking->employee_project_id)->update([
            'total_time'=> $formatted
        ]);
        $employee_project = EmployeeProject::find(request('employee_project_id'));
        return new EmployeeProjectResource($employee_project);
    }

    public function cancelTracking()
    {
        Tracking::destroy(request('id'));
        return response('Tracking delete');
    }

    public function getTotalTimeToday($id)
    {
        $total = 0;
        $data = Tracking::whereDate('updated_at', Carbon::today())->where('employee_project_id',$id)->get();
        foreach ($data as $item ) {
            // Explode by seperator :
            $temp = explode(":", $item->total_time);

           // Convert the hours into seconds
           // and add to total
            $total+= (int) $temp[0] * 3600;

           // Convert the minutes to seconds
           // and add to total
            $total+= (int) $temp[1] * 60;

           // Add the seconds to total
            $total+= (int) $temp[2];
        }

        $formatted = sprintf('%02d:%02d:%02d',
            ($total / 3600),
            ($total / 60 % 60),
            $total % 60);

        return response($formatted);
    }

    public function appTracking()
    {
        $data = request('data');
        $trackingID = request('trackingID');
        $someArray = json_decode($data);
        foreach ($someArray as $item ) {
            $content_title = $item->MainWindowTitle;
            $data = explode('-',$content_title);
            $app_name = $data[count($data)-1];
            unset($data[count($data)-1]);
            $a = implode('-',$data);
            $app_content = trim($a);
            $app = Application::all()->where('name',$app_name)->first();
            if ($app==null) {
                $apl = Application::create([
                    'category_id' => 15,
                    'application_type_id' => 3,
                    'name' => $app_name,
                ]);
                TrackingApplication::create([
                    'tracking_id' => $trackingID,
                    'application_id' => $apl->id,
                    'content' => $app_content
                ]);
            }else{
                $content = TrackingApplication::all()->where('content',$app_content)->where('tracking_id',$trackingID)->where('application_id',$app->id)->first();
                if ($content==null) {
                    TrackingApplication::create([
                        'tracking_id' => $trackingID,
                        'application_id' => $app->id,
                        'content' => $app_content
                    ]);
                }
            }
        }
        return response('Tracking success');
    }

    public function capture(Request $req)
    {
        $trackingID = request('trackingID');
        $img = request('data');
        $id = request('id');
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        // $image_name = 'capture/'.$id.'/'.time().'_'.'.png';
        // file_put_contents($image_name, $data);
        $png_url = time().".png";
        $path = 'capture/'.$id.'/'. $png_url;

        //$file = Image::make(file_put_contents($data));
        Storage::disk('public')->put( $path, $data);

        Capture::create([
            'tracking_id' => $trackingID,
            'image' => $path,
        ]);
        return response('success');
    }

    public function getDataset()
    {
        $data = Productivity::all()->where('status',0);
        return response()
                ->json($data)
                ->header('Content-Type','application/json');
    }

    public function updateDataset()
    {
        $output = request()->output;
        $app_id = request()->app_id;
        $id = array();
        $result = array();
        foreach ($app_id as $item ) {
            array_push($id,$item);
        }
        foreach ($output as $item ) {
            array_push($result,$item);
        }
        for ($i=0; $i < count($id); $i++) {
            Productivity::find($id[$i])->update([
                'output' => $result[$i],
                'status' => 1
            ]);
        }

        return response('Success');
    }
}
