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
                <h3 class="card-title">Edit Slider</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{route('slider.update',$slider->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                  <div class="form-group">
                    <label for="sliderTitle">Title</label>
                    <input type="text" class="form-control" name="title" id="sliderTitle" value="{{$slider->title}}">
                  </div>
                  <div class="form-group">
                    <label for="sliderDetails">Details</label>
                    <input type="text" class="form-control" name="details" id="sliderDetails" value="{{$slider->details}}">
                  </div>
                  <div class="form-group">
                    <label for="sliderImage">File input</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" name="image" class="custom-file-input" id="sliderImage">
                        <label class="custom-file-label" for="sliderImage">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                      </div>
                    </div>
                    <img src="{{asset('uploads/slider/'.$slider->image)}}" alt="" style="height: 80px; width:200px;">
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <a href="{{route('slider.index')}}" class="btn btn-danger" >Back</a>
                    <input type="reset" class="btn btn-info" value="Reset">
                  <button type="submit" name="submit " class="btn btn-success float-right">Upload</button>
                </div>
              </form>
        </div>
        <!-- /.card -->
      </div>
      <!--/.col (right) -->
    </div>
        <!-- /.row -->
</div><!-- /.container-fluid -->
@endsection    