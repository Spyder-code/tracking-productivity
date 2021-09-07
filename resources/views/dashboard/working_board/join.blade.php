@extends('layouts.dashboard_start')
@section('title','Take Your Project')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-8">
                    <div class="from-group row">
                        <div class="col-sm-10">
                            <input type="text" name="code" id="code" class="form-control text-center h3" placeholder="Enter Project Code" autofocus>
                        </div>
                        <div class="col-sm-2">
                            <button class="btn btn-success" type="button" id="find">Find</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div id="result"></div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 mt-5">
                    <div class="card border border-primary">
                        <div class="card-header bg-primary text-white">You have invite projects</div>
                        <div class="card-body">
                            @foreach ($project_task as $item)
                            <form action="{{ route('dashboard.join.accept') }}" method="post">
                                @csrf
                                <input type="hidden" name="employee_id" value="{{ Auth::id() }}">
                                <input type="hidden" name="project_id" value="{{ $item->project_id }}">
                                <div class="from-group row mt-2">
                                    <div class="col-sm-8">
                                        <p><strong>{{ $item->project->name }}</strong></p>
                                        <p>From: {{ $item->project->users->name }}</p>
                                    </div>
                                    <div class="col-sm-4">
                                        <button class="btn btn-success" type="submit" onclick="return confirm('are you sure?')">Accept</button>
                                    </div>
                                </div>
                            </form>
                            <hr>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(function(){

            $('#find').click(function (e) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    }
                });

                var val = $('#code').val();
                $.ajax({
                    type:'post',
                    url: {!! json_encode(route('dashboard.join.find')) !!},
                    data: {code:val},
                    success: function (data) {
                        if(data!=''){
                            var html =
                            ' <form action="'+{!! json_encode(route('dashboard.join.accept')) !!}+'" method="post">     @csrf <input type="hidden" name="employee_id" value="'+{!! json_encode(Auth::id()) !!}+'"><input type="hidden" name="project_id" value="'+data.id+'"><div class="from-group row mt-5 text-center border border-primary p-3"><div class="col-sm-8"><p><strong>'+data.name+'</strong></p>     <p>To:'+data.manager+'</p></div><div class="col-sm-4"><button class="btn btn-success" type="submit" onclick="return confirm(\'are you sure?\')">Accept</button></div></div></form>';
                        }else{
                            var html = 'Project not found!';
                        }
                        $('#result').html(html);
                    },
                    error: function (data) {
                        console.log(data);
                    }
                });

            });
        })
    </script>
@endsection
