@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Messenger Board</div>

                    <div class="panel-body">

                        <form id="msgform" class="form-horizontal"
                        onsubmit="return PostData('msgform')" action="{{ route('messages.store') }}">
                        {{--<form id="msgform" class="form-horizontal" method="post"--}}
                              {{--action="{{ route('messages.store') }}">--}}
                            {{ csrf_field() }}
                            <label for="title">Title</label>
                            <input class="form-control" type='text' name='title'>
                            <label for="body">Body</label>
                            <textarea class="form-control" name='body' rows='10'></textarea>
                            <span id="success-msg" class="help-block">
                        
                        </span>
                            <button type="submit" class="form-control" class="btn btn-primary">
                                Submit
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
