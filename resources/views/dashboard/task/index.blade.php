@extends('layouts.dashboard')
@section('style')
    <script src="https://cdn.jsdelivr.net/npm/clipboard@2.0.8/dist/clipboard.min.js"></script>
@endsection
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
                <div class="col-12 d-flex justify-content-center">
                    <span class="mx-2">Project Code</span>
                    <input id="foo" class="mx-2 form-control text-center" readonly value="{{ $project->code }}">
                    <!-- Trigger -->
                    <button class="cpy btn btn-secondary" data-clipboard-target="#foo">
                        <i class="mdi mdi-content-copy"></i>
                    </button>
                </div>
            </div>
            <div class="row">
                <div class="col-12 mt-4">
                    <div class="alert alert-info">
                        <ol>
                            <li>Task status is "Pending Invite" = Wait Employee to accept task</li>
                            <li>Task status is "In Progress" = Employee is doing task </li>
                            <li>Task status is "Complete" = Task is complete</li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-12 col-md-8">
                    <div class="card border border-primary shadow shadow-lg">
                        <div class="card-header bg-primary text-white">List Task</div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table no-wrap" id="myTable">
                                    <thead>
                                        <tr>
                                            <th class="border-top-0">#</th>
                                            <th class="border-top-0">Task Name</th>
                                            <th class="border-top-0">Employee</th>
                                            <th class="border-top-0">Status</th>
                                            <th class="border-top-0">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($task as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->employeeProject->users->name }}</td>
                                            <td>
                                                <div class="aler {{ $item->status==0?'alert-primary' :'alert-success' }} p-2">
                                                    <strong>{{ $item->status==0?'In progress' :'Complete' }}</strong>
                                                </div>
                                            </td>
                                            <td class="d-flex justify-content-center">
                                                <a href="{{ route('dashboard.monitoring.employee',['task'=>$item->employee_project_id,'date'=>'today']) }}" class="btn btn-warning btn-rounded mx-2"><i class="fas fa-eye"></i> Detail</a>
                                                @if ($item->status==0)
                                                <button type="button" data-toggle="modal" data-target="#task-{{ $item->id }}" class="btn btn-primary btn-rounded mx-2"><i class="fas fa-pencil-alt"></i> Edit</button>
                                                <!-- Modal -->
                                                <div class="modal fade" id="task-{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <form action="{{ route('task.update',['task'=>$item->id]) }}" method="post">
                                                                @csrf
                                                                @method('PUT')
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Update {{ $item->name }}</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                            </div>
                                                            <div class="modal-body">

                                                                    <div class="form-group">
                                                                        <label>Task Name</label>
                                                                        <input type="text" name="name" value="{{ $item->name }}" class="form-control">
                                                                    </div>
                                                                    {{-- <div class="form-group">
                                                                        <label>Employee</label>
                                                                        <select name="employee_id" class="form-control">
                                                                            <option value=""></option>
                                                                            @foreach ($employee as $item)
                                                                                <option value="{{ $item->employee_id }}">{{ $item->user->name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div> --}}
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <form action="{{ route('task.destroy',['task'=>$item->id]) }}" method="post">
                                                    @csrf
                                                    @method("DELETE")
                                                    <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger text-white btn-rounded mx-2"><i class="fas fa-trash-alt"></i> Delete</button>
                                                </form>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card border border-warning mt-3">
                        <div class="card-header bg-warning text-white">List Employee</div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table no-wrap" id="myTable1">
                                    <thead>
                                        <tr>
                                            <th class="border-top-0">#</th>
                                            <th class="border-top-0">Employee Name</th>
                                            <th class="border-top-0">Email</th>
                                            <th class="border-top-0">Status</th>
                                            <th class="border-top-0">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($employee as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->users->name }}</td>
                                            <td>{{ $item->users->email }}</td>
                                            <td>
                                                <div class="aler {{ $item->status==0?'alert-secondary' :'alert-success' }} p-2">
                                                    <strong>{{ $item->status==0?'Pending Invite' : 'Worker' }}</strong>
                                                </div>
                                            </td>
                                            <td class="d-flex justify-content-center">
                                                @if ($item->status==0)
                                                <form action="{{ route('dashboard.destroy.employeeProject',['employee_project'=>$item->id]) }}" method="post">
                                                    @csrf
                                                    @method("DELETE")
                                                    <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger text-white btn-rounded mx-2"><i class="fas fa-trash-alt"></i> Cancel</button>
                                                </form>
                                                @else
                                                <a href="{{ route('dashboard.monitoring.employee',['task'=>$item->id,'date'=>'today']) }}" class="btn btn-primary btn-rounded mx-2"><i class="fas fa-eye"></i> Show Task</a>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 mt-4">
                    <div class="card border border-info">
                        <div class="card-header bg-info text-white">Invite Employee</div>
                        <div class="card-body">
                            <form action="{{ route('dashboard.invite') }}" method="post">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-9">
                                        <label>Email</label>
                                        <input type="text" name="email" class="form-control">
                                    </div>
                                    <div class="col-3">
                                        <label for=""></label>
                                        <button type="submit" class="btn btn-rounded btn-info text-white mt-3">Invite</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card border border-success mt-3">
                        <div class="card-header bg-success text-white">Create Task</div>
                        <div class="card-body">
                            <form action="{{ route('task.store') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label>Task Name</label>
                                    <input type="text" name="name" value="{{ old('name') }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Employee</label>
                                    <select name="employee_id" class="form-control">
                                        <option value=""></option>
                                        @foreach ($employee as $item)
                                            <option value="{{ $item->employee_id }}">{{ $item->users->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-rounded btn-success w-100">Create</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready( function () {
            var clipboard = new ClipboardJS('.cpy');
            $('#myTable').DataTable();
            $('#myTable1').DataTable();
        });
    </script>
@endsection
