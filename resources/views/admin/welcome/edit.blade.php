@extends('admin_layouts.app')

@section('heder_title', 'Edit Slider')
@section('title', 'Edit Slider')
@section('admin-content')
<div class="container-fluid">
    <div class="row">
      <!-- left column -->
      <div class="col-md-6">
        <!-- general form elements -->
        <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Welcome Edit</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{route('welcome.update',$welcome->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                  <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" name="title" id="title" value="{{$welcome->title}}">
                  </div>
                  <div class="form-group">
                    <label for="subTitle">Sub Title</label>
                    <input type="text" class="form-control" name="sub_title" id="subTitle" value="{{$welcome->sub_title}}">
                  </div>
                  <div class="form-group">
                    <label for="point1">point 1</label>
                    <input type="text" class="form-control" name="point1" id="point1" value="{{$welcome->point1}}">
                  </div>
                  <div class="form-group">
                    <label for="point2">point 2</label>
                    <input type="text" class="form-control" name="point2" id="point2" value="{{$welcome->point2}}">
                  </div>
                  <div class="form-group">
                    <label for="point3">point 3</label>
                    <input type="text" class="form-control" name="point3" id="point3" value="{{$welcome->point3}}">
                  </div>
                  <div class="form-group">
                    <label for="details">Details</label>
                    <input type="text" class="form-control" name="details" id="details" value="{{$welcome->details}}">
                  </div>
                  <div class="form-group">
                    <label for="bannerImage">Image</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" name="image" class="custom-file-input" id="bannerImage">
                        <label class="custom-file-label" for="bannerImage">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                      </div>
                    </div>
                    <img src="{{asset('uploads/welcome/'.$welcome->image)}}" alt="" style="height: 60px; width:180px;">
                  </div>
                  <div class="form-group">
                    <label for="video">video</label>
                    <input type="text" class="form-control" name="video" id="video" value="{{$welcome->video}}">
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" name="submit" class="btn btn-primary">Update</button>
                </div>
              </form>
        </div>
        <!-- /.card -->
      </div>
    </div>
</div><!-- /.container-fluid -->
@endsection    