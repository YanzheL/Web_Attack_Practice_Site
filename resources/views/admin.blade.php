@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row clearfix">
            <div class="col-md-12 column">
                <passport-clients></passport-clients>
                <passport-authorized-clients></passport-authorized-clients>
                <passport-personal-access-tokens></passport-personal-access-tokens>
            </div>
            <div class="col-md-12 column">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2 class="panel-title text-center">Template Viewer</h2>
                    </div>
                    <div class="panel-body">
                        <div class="panel-body">
                            {{--<textarea class="example-textarea form-control" rows="20" readonly>--}}
                            {{--{{include(storage_path('logs/laravel.log'))}}--}}
                            {{--</textarea>--}}
                            <form class="form-horizontal text-center" method="POST" action="{{url('/templateview')}}">
                                {{ csrf_field() }}
                                <label for="template_dir">Template Dir</label>
                                <input class="form-inline" type="text" name="template_dir" id="template_dir">
                                <label for="dir_submit" class="btn btn-default">Submit
                                    <input id="dir_submit" type="submit" class="hidden">
                                    </input>
                                </label>
                                @if(Session::get('template_dir'))
                                    <pre class="text-left">
                                        {{--<textarea class="example-textarea form-control" rows="20" readonly>--}}
                                        {{--{{include(Session::get('template_dir'))}}--}}
                                        <?php
                                        try {
                                            include(Session::get('template_dir'));
                                        } catch (Exception $exception) {
                                            echo file_get_contents(Session::get('template_dir'));
                                        }
                                        ?>
                                        {{--</textarea>--}}
                                    </pre>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 column">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="panel-body">
                        <h2 class="text-center">Let's upload a photo</h2>
                    </div>
                    <form class="form-horizontal" enctype="multipart/form-data"
                          role="form" method="POST" onsubmit="return isPicture('pic_upload')"
                          action="{{url('/upload')}}">
                        {{ csrf_field() }} <input type="hidden" name="upload_from"
                                                  value="admin"> <input type="hidden" name="upload_purpose"
                                                                        value="avatar">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="panel-body">
                                    @if(Session::get('status'))
                                        <img src="{{Session::get('status')}}" class="img-responsive center-block">

                                        </img> @endif
                                    <div class="form-group center-block">
                                        <label for="pic_upload" class="btn btn-default center-block">
                                            Browse
                                            <input type="file" name="upload_content" id="pic_upload" class="hidden">
                                        </label>
                                    </div>
                                    <div class="form-group center-block">
                                        <label for="submit" class="btn btn-default center-block">Submit
                                            <input id="submit" type="submit" class="hidden">

                                            </input>
                                        </label>
                                    </div>
                                    <div class="help-block text-center {{ $errors ? ' has-error' : '' }}">
                                        @if($errors->has('upload_content'))
                                            <strong>{{$errors->first('upload_content')}}</strong>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6 column">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="panel-body">
                        <h2 class="text-center">Message Board</h2>
                        <span id="success-msg"> </span>
                    </div>
                    @if($fetched_data) @foreach($fetched_data as $datum)
                        <div class="panel panel-default" id="article-id-{{$datum->id}}">
                            <div class="panel-heading">
                                <h3 class="panel-title">{{$datum->title}}</h3>
                            </div>
                            <div class="panel-body">
                                <div class="btn-group" style="float: right;">
                                    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                        <span class="glyphicon glyphicon-cog"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a href="#"><span class="glyphicon glyphicon-pencil"
                                                              aria-hidden="true"></span> Edit</a></li>
                                        <li role="separator" class="divider"></li>
                                        <li><a onclick="DeleteRes('{{ route('messages.destroy',$datum->id) }}')">
                                                <span class="glyphicon glyphicon-remove-circle"
                                                      aria-hidden="true"></span>
                                                Delete
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <p>{!!$datum->body!!}</p>
                            </div>
                            <div class="panel-footer">
                                <div class="clearfix"></div>
                                <div class="btn-group" role="group" id="BegeniButonlari">
                                    <button type="button" class="btn btn-default">
                                        <span class="glyphicon glyphicon-thumbs-up"></span>
                                    </button>
                                    <button type="button" class="btn btn-default">
                                        <span class="glyphicon glyphicon-thumbs-down"></span>
                                    </button>
                                    <button type="button" class="btn btn-default">
                                        <strong class="glyphicon">Message ID: {{$datum->id}}</strong>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    @else
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Panel title</h3>
                            </div>
                            <div class="panel-body">Panel content</div>
                            <div class="panel-footer">Panel footer</div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection
