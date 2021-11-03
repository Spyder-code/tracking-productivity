@extends('layouts.admin')
@section('page','Game Create')
@section('breadcrumb')
    <li><a href="{{ route('game.index') }}" class="breadcrumb-item nav-link">Game Management </a></li>
    <li><a href="#" class="breadcrumb-item nav-link disabled">/ </a></li>
    <li><a href="#" class="breadcrumb-item active nav-link active"> Create Game</a></li>
@endsection
@section('content')
    <div class="container-fluid">
        @if ($message = Session::get('success'))
        <div class="row">
            <div class="col mt-3">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ $message }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>
        @endif
        @if ($message = Session::get('danger'))
            <div class="row">
                <div class="col mt-3">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ $message }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="white-box">
                    <div class="d-md-flex mb-3">
                        <h3 class="box-title mb-0">Insert Game</h3>
                    </div>
                    <form action="{{ route('game.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Game Name</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                        </div>
                        <div class="form-group">
                            <label>Class</label>
                            <select name="class" class="form-control">
                                <option value=""></option>
                                <option {{ old('class')=="Primary School"?'selected':'' }} value="Primary School">Primary School</option>
                                <option {{ old('class')=="Junior Height School"?'selected':'' }} value="Junior Height School">Junior Height School</option>
                                <option {{ old('class')=="Senior Height School"?'selected':'' }} value="Senior Height School">Senior Height School</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Image</label>
                            <input type="file" name="image" class="form-control-file">
                        </div>
                        <div class="form-group">
                            <button type="submit" onclick="retun confirm('Are you sure?')" class="btn btn-success">Create Game</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
