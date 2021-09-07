@extends('layouts.admin')
@section('page','User List')
@section('breadcrumb')
    <li><a href="{{ route('admin.user') }}" class="breadcrumb-item nav-link">User List </a></li>
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
                        {{ $data->count() }} Data
                    </h3>
                    <div class="table-responsive">
                        <table class="table no-wrap" id="myTable">
                            <thead>
                                <tr>
                                    <th class="border-top-0">#</th>
                                    <th class="border-top-0">Name</th>
                                    <th class="border-top-0">Username</th>
                                    <th class="border-top-0">Email</th>
                                    <th class="border-top-0">School</th>
                                    <th class="border-top-0">Register On</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->username }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->school }}</td>
                                    <td>{{ date('d/m/Y', strtotime($item->created_at)) }}</td>
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
