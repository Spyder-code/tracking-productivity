@extends('layouts.admin')
@section('page','Room Management')
@section('breadcrumb')
    <li><a href="{{ route('home') }}" class="breadcrumb-item nav-link">Room Management </a></li>
    <li><a href="#" class="breadcrumb-item nav-link disabled">/ </a></li>
    <li><a href="#" class="breadcrumb-item active nav-link active"> Room List</a></li>
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
        <div class="row">
            <div class="col-md-12">
                <div class="white-box">
                    <h3 class="box-title">
                        {{ $data->count() }} Room
                    </h3>
                    <div class="table-responsive">
                        <table class="table no-wrap" id="myTable">
                            <thead>
                                <tr>
                                    <th class="border-top-0">#</th>
                                    <th class="border-top-0">Creator</th>
                                    <th class="border-top-0">Code</th>
                                    <th class="border-top-0">Game</th>
                                    <th class="border-top-0">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->user->name }}</td>
                                    <td>{{ $item->code }}</td>
                                    <td>{{ $item->game->name }}</td>
                                    <td class="d-flex justify-content-center">
                                        <a href="{{ route('room.show',['room'=>$item->id]) }}" class="btn btn-warning btn-rounded mx-2"><i class="fas fa-eye"></i> Show Participant</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready( function () {
            $('#myTable').DataTable();
        });
    </script>
@endsection
