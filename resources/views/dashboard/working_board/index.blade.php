@extends('layouts.dashboard_start')
@section('title','Choose Working Board:')
@section('content')
<p class="h3">Manager Board</p>
<hr>
<div class="row">
    @foreach ($project_in_employee as $item)
        <div class="col-12 col-md-4 mt-3">
            <div class="card">
                <div class="card-header bg-primary">
                    <div class="card-title text-center text-white">{{ $item->project->name }}</div>
                </div>
                <div class="card-body">
                    {{ $item->project->description }}
                </div>
                <div class="card-footer d-flex justify-content-between">
                    <div class="mx-2">
                        <form action="{{ route('dashboard.toProject')}}" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $item->project->id }}">
                            <button type="submit" class="btn btn-primary"> Show Project</button>
                        </form>
                    </div>
                    <div class="d-flex justify-content-center flex-column">
                        <div class="btn disabled {{ $item->status==2?'btn-success':'btn-warning' }} mx-2"><strong>{{ $item->status==2?'Complete':'Uncomplete' }}</strong></div>
                        <div class="btn disabled btn-secondary mx-2"><strong>Task: {{ $item->taskClear() }}/{{ $item->task->count() }}</strong></div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
<p class="h3 mt-5">Employee Board</p>
<hr>
<div class="row">
    @foreach ($employee_project as $item)
        <div class="col-12 col-md-4 mt-3">
            <div class="card">
                <div class="card-header bg-primary">
                    <div class="card-title text-center text-white">{{ $item->project->name }}</div>
                </div>
                <div class="card-body">
                    {{ $item->project->description }}
                </div>
                <div class="card-footer d-flex justify-content-between">
                    <div class="mx-2">
                        <form action="{{ route('dashboard.toProject')}}" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $item->project->id }}">
                            <button type="submit" class="btn btn-primary"> Show Project</button>
                        </form>
                    </div>
                    <div class="d-flex justify-content-center flex-column">
                        <div class="btn disabled {{ $item->status==2?'btn-success':'btn-warning' }} mx-2"><strong>{{ $item->status==2?'Complete':'Uncomplete' }}</strong></div>
                        <div class="btn disabled btn-secondary mx-2"><strong>Task: {{ $item->taskClear() }}/{{ $item->task->count() }}</strong></div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
