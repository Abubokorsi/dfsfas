@extends('admin_layouts.app')

@section('heder_title', 'Create Slider')
@section('title', 'Create Slider')

@section('admin-content')
<div class="container-fluid">
    <div class="row">
      <!-- left column -->
      <div class="col-md-6">
        <!-- general form elements -->
        <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Create Slider</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{route('slider.store')}}" method="POST" enctype="multipart/form-data">
                @csrf                
                <div class="card-body">
                  <div class="form-group">
                    <label for="sliderTitle">Title</label>
                    <input type="text" class="form-control" name="title" id="sliderTitle" placeholder="Title">
                  </div>
                  <div class="form-group">
                    <label for="sliderDetails">Details</label>
                    <input type="text" class="form-control" name="details" id="sliderDetails" placeholder="Details">
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
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <a href="{{route('slider.index')}}" class="btn btn-danger" >Back</a>
                    <input type="reset" class="btn btn-info" value="Reset">
                  <button type="submit" name="submit " class="btn btn-success float-right">Create</button>
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