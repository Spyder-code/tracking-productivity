@extends('layouts.admin')
@section('page','Game Management')
@section('breadcrumb')
    <li><a href="{{ route('home') }}" class="breadcrumb-item nav-link">Game Management </a></li>
    <li><a href="#" class="breadcrumb-item nav-link disabled">/ </a></li>
    <li><a href="#" class="breadcrumb-item active nav-link active"> Game List</a></li>
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
                        <a href="{{ route('game.create') }}" class="btn btn-success"><i class="fas fa-plus-circle"></i> Add Game</a>
                    </h3>
                    <div class="table-responsive">
                        <table class="table no-wrap" id="myTable">
                            <thead>
                                <tr>
                                    <th class="border-top-0">#</th>
                                    <th class="border-top-0">Game Name</th>
                                    <th class="border-top-0">Class</th>
                                    <th class="border-top-0">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->class }}</td>
                                    <td class="d-flex justify-content-center">
                                        <a href="{{ route('game.edit',['game'=>$item->id]) }}" class="btn btn-primary btn-rounded mx-2"><i class="fas fa-pencil-alt"></i> Edit</a>
                                        <a href="{{ route('game.show',['game'=>$item->id]) }}" class="btn btn-warning btn-rounded mx-2"><i class="fas fa-eye"></i> Preview</a>
                                        <form action="{{ route('game.destroy',['game'=>$item->id]) }}" method="post">
                                            @csrf
                                            @method("DELETE")
                                            <button type="submit" onclick="retutn confirm('Are you sure?')" class="btn btn-danger text-white btn-rounded mx-2"><i class="fas fa-trash-alt"></i> Delete</button>
                                        </form>
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
