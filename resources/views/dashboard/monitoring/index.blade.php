@extends('layouts.dashboard')
@section('content')
    <div class="card shadow-lg">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <div class="progress" style="height: 50px">
                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: {{ $complete }}%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">{{ $complete }}%</div>
                    </div>
                    <div class="progress mt-3" style="height: 30px">
                        <div class="progress-bar bg-success" role="progressbar" style="width: {{ $complete }}%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100">{{ $task_complete }} Task Complete</div>
                        <div class="progress-bar bg-primary" role="progressbar" style="width: {{ $uncomplete }}%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">{{ $task_uncomplete }} Task In Progress</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card mt-5">
        <div class="card-body">
            @if ($message = Session::get('success'))
            <div class="row">
                <div class="col mt-3">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ $message }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
            @endif
            @if ($message = Session::get('danger'))
            <div class="row">
                <div class="col mt-3">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ $message }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </button>
                    </div>
                </div>
            </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="row">
                <div class="col-12 mt-4">
                    <div class="row">
                        <div class="col-8">
                            <div class="row">
                                @foreach ($data as $item)
                                <div class="col-6 col-md-4">
                                    <div class="card shadow shadow-lg">
                                        <img class="card-img-top" style="height: 14rem;" src="{{ $item->users->avatar }}" alt="Card image cap">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $item->users->name }}</h5>
                                            <a href="{{ route('dashboard.monitoring.employee',['task'=>$item->id,'date'=>'today']) }}" class="btn btn-primary">Detail</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="table-responsive card shadow shadow-lg">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Task</th>
                                            <th scope="col">Status</th>
                                            {{-- <th scope="col">Action</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($task as $item)
                                        <tr>
                                            <td>{{ $item->name }}</td>
                                            <td class="alert {{ $item->status==0?'alert-primary':'alert-success' }}">{{ $item->status==0?'In progress':'complete' }}</td>
                                            {{-- <td><button type="button" class="btn btn-primary"> Change Status</button></td> --}}
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
