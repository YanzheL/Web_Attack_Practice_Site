@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-7 col-md-offset-2">
                <h1 class="text-center article-title">Search</h1>
                <div class="panel panel-default">
                    <form class="form-horizontal" role="form" method="POST" action="{{url('/search')}}">
                        {{ csrf_field() }}
                        <div class="input-group center-block">
                            <select name="search_type" class="form-control"
                                    style="width: auto;">
                                <option value="title">Title</option>
                                <option value="article_id">Article ID</option>
                                <option value="author">Author</option>
                            </select>
                            <span class="input-group-btn {{ $errors->has('search_content') ? ' has-error' : '' }}">
							<input type="text" name="search_content" class="form-control"
                                   placeholder="Search Content" id="search_content" required
                                   autofocus>
							<button class="btn" type="submit">Go</button>
						</span>
                        </div>
                    </form>
                </div>
                @if($errors->has('search_content'))
                    <span class="help-block text-center">
                        <strong>{{$errors->first('search_content')}}</strong>
			        </span>
                @endif
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="btn-group" style="float: right;">
                        <button type="button" class="btn btn-danger dropdown-toggle"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="glyphicon glyphicon-cog"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="#">
                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Edit</a></li>
                            <li role="separator" class="divider"></li>
                            <li>
                                <a href="#">
                                    <span class="glyphicon glyphicon-remove-circle" aria-hidden="true">

                                    </span> Delete
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="clearfix"></div>
                </div>
                @if(Session::get('fetched_data'))
                    @foreach(Session::get('fetched_data') as $datum)
                        <div class="panel-body">
                            <div class="media">
                                <div class="media-left">
                                    <a href="#">
                                        <img class="media-object"
                                             src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/23/Canis_lupus.jpg/260px-Canis_lupus.jpg"
                                             alt="Kurt">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading">{{$datum->title}}</h4>
                                    <p>{{$datum->body}}</p>
                                    <div class="clearfix"></div>
                                    <div class="btn-group" role="group" id="BegeniButonlari">
                                        <button type="button" class="btn btn-default">
                                            <span class="glyphicon glyphicon-thumbs-up"></span>
                                        </button>
                                        <button type="button" class="btn btn-default">
                                            <span class="glyphicon glyphicon-thumbs-down"></span>
                                        </button>
                                        <button type="button" class="btn btn-default">
                                            <strong class="glyphicon">Article ID: {{$datum->id}}</strong>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection
