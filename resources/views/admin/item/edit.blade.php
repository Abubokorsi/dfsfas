@extends('admin_layouts.app')

@section('heder_title', 'Edit Item')
@section('title', 'Edit Item')

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
              <form action="{{route('item.update',$item->id)}}" method="POST" >
                @csrf
                @method('PUT')
                <div class="card-body">
                  <div class="form-group">
                    <select name="category" class="form-control">
                      @foreach($categories as $key=>$category)
                      <option value="{{$category->id}}">{{$category->name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="name">name</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{$item->name}}">
                  </div>
                  <div class="form-group">
                    <label for="details">Details</label>
                    <textarea type="text" class="form-control" name="details">{{$item->details}} </textarea>
                  </div>
                  <div class="form-group">
                    <label for="price">Price</label>
                    <input type="text" class="form-control" name="price"value="{{$item->price}}">
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <a href="{{route('item.index')}}" class="btn btn-danger" >Back</a>
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