@extends('layouts.dashboard_start')
@section('title','Create Board')
@section('content')
<div class="card">
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
            <div class="col-12">
                <form method="POST" action="{{ route('project.store') }}">
                    @csrf
                    <div class="form-group mb-4">
                        <label class="col-md-12">Project Name</label>
                        <div class="col-md-12 border-bottom">
                            <input type="text" name="name" value="{{ old('name') }}"
                                class="form-control"> </div>
                    </div>
                    <div class="form-group mb-4">
                        <label class="col-md-12">Description</label>
                        <div class="col-md-12 border-bottom">
                            <textarea name="description" class="form-control" cols="30" rows="5">
                                {{ old('description') }}
                            </textarea>
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <div class="col-sm-12">
                            <button class="btn btn-success w-100" type="submit">Create</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
