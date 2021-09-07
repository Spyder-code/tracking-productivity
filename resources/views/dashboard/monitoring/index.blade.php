@extends('layouts.dashboard')
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
                        @foreach ($data as $item)
                            <div class="col-6 col-md-3">
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
            </div>
        </div>
    </div>
@endsection
