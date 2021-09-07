@extends('layouts.dashboard')
@section('content')
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="aler alert-info p-5">
                <strong>Capture Time</strong><p> is an interval time to capture Employee screen in a minute</p>
            </div>
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
        </div>
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('project.update',['project'=>$project->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Project Name</label>
                            <input type="text" name="name" class="form-control" value="{{ $project->name }}">
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" class="form-control" cols="30" rows="5">{{ $project->description }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Code</label>
                            <input type="text" name="code" readonly class="form-control" value="{{ $project->code }}">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
