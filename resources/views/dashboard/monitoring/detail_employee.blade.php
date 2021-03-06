@extends('layouts.dashboard')
@section('style')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.10.1/viewer.min.js" integrity="sha512-2e2mvwFe4ZwNBifdDlcPESjLL+Y96YVnCM+OlKOnpHgGSN7KYxIxWlZ3kX7vQ348Mm2Kz1qmajPP/gm1gmFErA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.10.1/viewer.css" integrity="sha512-Dlf3op7L5ECYeoL6o80A2cqm4F2nLvvK4aH84DxCT690quyOZI8Z0CxVG9PQF3JHmD/aBFqN/W/8SYt7xKLi2w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
@section('content')
    <div class="card shadow-lg">
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <canvas id="chartp" width="200" height="200"></canvas>
                </div>
                <div class="col">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <strong>Total Working Time:</strong>
                            <p>{{ $task->total_time}}</p>
                        </li>
                        <li class="list-group-item">
                            <strong>Productivity is:</strong>
                            <div class="alert alert-success">
                                <strong>Productive</strong>
                            </div>
                        </li>
                    </ul>
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
                        <li class="list-group-item"><a href="{{ route('dashboard.monitoring.employee',['task'=>$task->id,'date'=>'today']) }}">Today</a></li>
                        <li class="list-group-item"><a href="{{ route('dashboard.monitoring.employee',['task'=>$task->id,'date'=>'yesterday']) }}">Yesterday</a></li>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.0/chart.min.js" integrity="sha512-GMGzUEevhWh8Tc/njS0bDpwgxdCJLQBWG3Z2Ct+JGOpVnEmjvNx6ts4v6A2XJf1HOrtOsfhv3hBKpK9kE5z8AQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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

        const chart = document.getElementById('chartp');
        const data = {
            labels: [
                'Unproductive',
                'Productive'
            ],
            datasets: [{
                label: 'My First Dataset',
                data: [45, 55],
                backgroundColor: [
                'rgb(255, 99, 132)',
                'rgb(54, 162, 235)',
                ],
                hoverOffset: 4
            }]
        };
        const myChart = new Chart(chart, {
            type: 'doughnut',
            data: data,
            options:{
                maintainAspectRatio:false
            }
        });
    </script>
@endsection
