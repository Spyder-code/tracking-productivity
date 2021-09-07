@extends('layouts.dashboard_start')
@section('title','My Account')
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
            <div class="col-12 col-md-3">
                <div class="user-bg">
                    <div class="overlay-box">
                        <form action="{{ route('profile.update.image',['id'=>Auth::id()]) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="file" id="avatar" name="avatar" onchange="submit()" hidden>
                            <div class="user-content">
                                <label for="avatar" style="cursor: pointer"><img class="img-fluid" src="{{ Auth::user()->avatar }}"
                                        class="thumb-lg img-circle" alt="img"></label>
                                <h4 class="text-white mt-2">{{ Auth::user()->name }}</h4>
                                <h5 class="text-white mt-2">{{ Auth::user()->email }}</h5>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-9">
                <form class="form-horizontal form-material" method="POST" action="{{ route('profile.update',['id'=>Auth::id()]) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group mb-4">
                        <label class="col-md-12 p-0">Username</label>
                        <div class="col-md-12 border-bottom p-0">
                            <input type="text" name="username" value="{{ Auth::user()->username }}"
                                class="form-control"> </div>
                    </div>
                    <div class="form-group mb-4">
                        <label class="col-md-12 p-0">Full Name</label>
                        <div class="col-md-12 border-bottom p-0">
                            <input type="text" name="name" value="{{ Auth::user()->name }}"
                                class="form-control"> </div>
                    </div>
                    <div class="form-group mb-4">
                        <label for="example-email" class="col-md-12 p-0">Email</label>
                        <div class="col-md-12 border-bottom p-0">
                            <input type="email" readonly value="{{ Auth::user()->email }}"
                                class="form-control" name="email"
                                id="example-email">
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <div class="col-sm-12">
                            <button class="btn btn-success w-100" type="submit">Update Profile</button>
                        </div>
                    </div>
                </form>
                <div class="mt-4">
                    <form class="form-horizontal form-material" method="POST" action="{{ route('profile.update.password',['id'=>Auth::id()]) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-4">
                            <label class="col-md-12 p-0">Current password</label>
                            <div class="col-md-12 border-bottom p-0">
                                <input type="password" name="current_password" class="form-control">
                            </div>
                        </div>
                        <div class="form-group mb-4">
                            <label class="col-md-12 p-0">New password</label>
                            <div class="col-md-12 border-bottom p-0">
                                <input type="password" name="password" class="form-control">
                            </div>
                        </div>
                        <div class="form-group mb-4">
                            <label for="example-email" class="col-md-12 p-0">Confirm password</label>
                            <div class="col-md-12 border-bottom p-0">
                                <input type="password" name="password_confirmation" class="form-control">
                            </div>
                        </div>
                        <div class="form-group mb-4">
                            <div class="col-sm-12">
                                <button class="btn btn-success w-100" type="submit">Update Password</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
