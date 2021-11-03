@extends('layouts.admin')
@section('page','Application Unregistered')
@section('breadcrumb')
    <li><a href="{{ route('home') }}" class="breadcrumb-item nav-link">Application Unregistered </a></li>
    <li><a href="#" class="breadcrumb-item nav-link disabled">/ </a></li>
    <li><a href="#" class="breadcrumb-item active nav-link active"> App List</a></li>
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
                    <div class="alert alert-info d-flex">
                        <div class="mx-5">
                            <h3><strong>{{ $productivity }} data unknown clasification productivity</strong></h3>
                        </div>
                        <form method="post" action="{{ route('svm') }}" class="mx-5">
                            @csrf
                            <button type="button" id="svm" class="btn btn-success" onclick="return confirm('are you sure?')">Clasification data with SVM</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="white-box">
                    <div class="table-responsive">
                        <table class="table no-wrap" id="myTable">
                            <thead>
                                <tr>
                                    <th width="10%" class="border-top-0">#</th>
                                    <th width="40%" class="border-top-0">App Name</th>
                                    <th width="50%" class="border-top-0">Category</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><a href="https://www.google.com/search?q={{ $item->name }}" target="d_blank">{{ $item->name }}</a></td>
                                    <td>
                                        <form action="{{ route('app.update',['app' => $item->id]) }}" method="post">
                                            @method('PUT')
                                            @csrf
                                            <select name="category_id" class="form-control" onchange="submit()">
                                                @foreach ($category as $cat)
                                                    <option value="{{ $cat->id }}" {{ $cat->id==$item->category_id?'selected':'' }}>{{ $cat->name }}</option>
                                                @endforeach
                                            </select>
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
