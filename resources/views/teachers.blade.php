@extends('layouts.app')
@include('inc.nav')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <nav class="navbar navbar-expand-lg navbar-light bg-light">
                        <a class="navbar-brand" href="#">Teachers Dashboard</a>
                    </nav>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div id="reg_teachers">
                    @if(count($errors)>0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    
                    @endif
                    </div>
                    @if(\Session::has('success'))
                    <div class="alert alert-success">
                        <p>{{\Session::get('success')}}</p>
                    </div>
                    @endif
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                          <span class="navbar-toggler-icon"></span>
                        </button>
                      
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                          <ul class="navbar-nav mr-auto"  style="cursor:pointer">
                            <li class="nav-item">
                              <a class="nav-link" onclick="document.getElementById('upload_file').style.display='inline';document.getElementById('manage_profile').style.display='none';document.getElementById('uploaded_files').style.display='none';">Upload Content</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" onclick="document.getElementById('manage_profile').style.display='inline';document.getElementById('upload_file').style.display='none';document.getElementById('uploaded_files').style.display='none';">Manage Profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" onclick="document.getElementById('uploaded_files').style.display='inline';document.getElementById('upload_file').style.display='none';document.getElementById('manage_profile').style.display='none';">Uploaded Files</a>
                              </li>
                          </ul> 
                        </div>
                      </nav>
                </div>
            </div>
            <div id="upload_file" style="padding: 25px;">
            <!--<form action="{{route('files.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                    <input type="text" name="title"><br>
                    <input type="text" name="body"><br>
                    <input type="file" name="upload_file"><br>
                    <input type="submit" name="save" value="Save File">
                </form>-->
                {!! Form::open(['action' => 'FilesController@store', 'method' => 'POST', 'enctype'=>'multipart/form-data', 'files' => true]) !!}
                    <div class='form-group'>
                        {{Form::label('title','File Title')}}
                        {{Form::text('title', '', ['class' => 'form-control', 'placeholder'=> 'File Title'])}}
                    </div>
                    <div class='form-group'>
                            {{Form::label('body','File Description')}}
                            {{Form::textarea('body', '', ['class' => 'form-control', 'placeholder'=> 'File Description'])}}
                    </div>
                    <div class='form-group'>
                        {{Form::file('upload_file')}}
                    </div>
                    {{Form::submit('Save File',['class'=>'btn btn-primary'])}}
                {!! Form::close() !!}
            </div>
            <div id="manage_profile" style="display:none">
                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row no-gutters">
                      <div class="col-md-4">
                        <img src="profile.png" class="card-img" alt="...">
                      </div>
                      <div class="col-md-8">
                        <div class="card-body">
                          <h5 class="card-title">Card title</h5>
                          <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                          <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                        </div>
                      </div>
                    </div>
                  </div>
            </div>

            <div id="uploaded_files" style="display: none">
                <div class="jumbotron">
                    <div class="row justify-content-center">
                      <div class="col-md-12" width="100%">
                        <div class="card">
                          <div class="card-header">
                            Files List
                            <div style="float:right">
                               Total Number of files uploaded : {{count($files)}}
                            </div>
                          </div>
                          <div class="card-body">
                            <table class="table table-hover">
                              <thead>
                                <tr>
                                  <th scope="col">File Name</th>
                                  <th scope="col">Uploaded Date</th>
                                  <th scope="col">File Description</th>
                                  <th scope="col">Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach($files as $file)
                                    <tr><td>{{$file->title}}</td><td>{{$file->created_at}}</td><td>{{$file->description}}</td><td><button class="btn btn-danger">{!!Form::open(['action'=>['FilesController@destroy',$file->id],'method'=>'POST','class'=>'pull-right'])!!}{{Form::hidden('_method','DELETE')}}{{Form::submit('Remove',['class'=>'btn btn-danger'])}}{!!Form::close()!!}</button></td><tr>
                                @endforeach
                                {{$files->links()}}
                              </tbody>
                          </table>
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
