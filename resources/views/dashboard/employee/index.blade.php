@extends('layouts.dashboard_start')
@section('style')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.10.1/viewer.min.js" integrity="sha512-2e2mvwFe4ZwNBifdDlcPESjLL+Y96YVnCM+OlKOnpHgGSN7KYxIxWlZ3kX7vQ348Mm2Kz1qmajPP/gm1gmFErA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.10.1/viewer.css" integrity="sha512-Dlf3op7L5ECYeoL6o80A2cqm4F2nLvvK4aH84DxCT690quyOZI8Z0CxVG9PQF3JHmD/aBFqN/W/8SYt7xKLi2w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
@section('title', 'Result:')
@section('content')

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-12 col-md-4">
                <ul class="list-group">
                    <li class="list-group-item">
                        <strong>Manager:</strong>
                        <p>{{ $project->users->name }}</p>
                    </li>
                    <li class="list-group-item">
                        <strong>Project:</strong>
                        <p>{{ $project->name }}</p>
                    </li>
                    <li class="list-group-item">
                        <strong>Description:</strong>
                        <p>{{ $project->description }}</p>
                    </li>
                    <li class="list-group-item">
                        <strong>Total Working Time:</strong>
                        <p>{{ $task->total_time}}</p>
                    </li>
                </ul>
            </div>
            <div class="col-12 col-md-8">
                <div class="table-responsive card shadow shadow-lg">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Task</th>
                                <th scope="col">Status</th>
                                {{-- <th scope="col">Action</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($task_list as $item)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $item->name }}</td>
                                <td class="alert {{ $item->status==0?'alert-primary':'alert-success' }}">{{ $item->status==0?'In progress':'complete' }}</td>
                                {{-- <td><button type="button" class="btn btn-primary"> Change Status</button></td> --}}
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card mt-5">
    <div class="card-header bg-success text-white">{{ date('d F Y', strtotime($date)) }}</div>
    <div class="card-body">
        <div class="row">
            <div class="col-12 col-md-4">
                <ul class="list-group">
                    <li class="list-group-item"><a href="{{ route('dashboard.main.employee',['date'=>'today']) }}">Today</a></li>
                    <li class="list-group-item"><a href="{{ route('dashboard.main.employee',['date'=>'yesterday']) }}">Yesterday</a></li>
                    <li class="list-group-item d-flex">
                        <input class="form-control" type="date" id="date" style="height: 30px">
                        <a class="btn btn-sm btn-primary" id="link">Get</a>
                    </li>
                </ul>
            </div>
            <div class="col-12 col-md-8">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="card">
                            <div class="card-header bg-info text-white">Application Open</div>
                            <div class="card-body">
                                <div id="accordion">
                                    @php
                                        $i=1;
                                    @endphp
                                    @foreach ($app as $item)
                                    <div class="card">
                                        <div class="card-header" id="heading-{{ $i }}">
                                            <h5 class="mb-0">
                                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapse-{{ $i }}" aria-expanded="true" aria-controls="collapse-{{ $i }}">
                                                {{ $item->first()->app->name }}
                                                <span class="badge badge-info badge-pill">{{ $item->count() }}</span>
                                            </button>
                                            </h5>
                                        </div>
                                        <div id="collapse-{{ $i }}" class="collapse" aria-labelledby="heading-{{ $i }}" data-parent="#accordion">
                                            <div class="card-body">
                                                <ol class="list-group">
                                                    @foreach ($item as $app_content)
                                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                                            <small>{{ $app_content->content }}</small>
                                                        </li>
                                                    @endforeach
                                                </ol>
                                            </div>
                                        </div>
                                    </div>
                                    @php
                                        $i++;
                                    @endphp
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="card">
                            <div class="card-header bg-success text-white">Capture Screen</div>
                            <div class="card-body">
                                <div>
                                    <img id="image" src="" alt="Picture">
                                </div>
                                <div>
                                    <div id="images" class="row">
                                        @foreach ($capture as $item)
                                            <div class="col-6"><img class="img-thumbnail" src="{{ asset('storage/'.$item->image) }}" alt=""></div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        const viewer = new Viewer(document.getElementById('image'), {
            inline: true,
            viewed() {
                viewer.zoomTo(1);
            },
        });
        const gallery = new Viewer(document.getElementById('images'));
        $('#date').change(function (e) {
            var val = $(this).val();
            $('#link').attr('href',val);
        });
    </script>
@endsection
