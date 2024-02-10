@extends('admin_layouts.app')

@section('heder_title', 'All Welcome')
@section('title', 'All Welcome')
@push('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('backend')}}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="{{asset('backend')}}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="{{asset('backend')}}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endpush
@section('admin-content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
        <div class="card">
              <div class="card-header">
              <a href="{{route('welcome.create')}}" class="btn btn-info float-right">ADD</a>
                <h3 class="card-title">Welcome Data</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Sl</th>
                    <th>Title</th>
                    <th>Sub Title</th>
                    <th>Point -1</th>
                    <th>Point -1</th>
                    <th>Point -1</th>
                    <th>Details</th>
                    <th>image</th>
                    <th>Video Link</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($welcomes as $key=>$welcome)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$welcome->title}}</td>
                        <td>{{$welcome->sub_title}}</td>
                        <td>{{$welcome->point1}}</td>
                        <td>{{$welcome->point2}}</td>
                        <td>{{$welcome->point3}}</td>
                        <td>{{$welcome->details}}</td>
                        <td>
                            <img src="{{asset('uploads/welcome/'.$welcome->image)}}" alt="" style="height: 60px; width:180px;">
                        </td>
                        <td>{{$welcome->video}}</td>
                        <td>
                            <a href="{{route('welcome.edit',$welcome->id)}}" class="btn btn-info">Edit</a>
                            <form action="{{route('welcome.destroy',$welcome->id)}}" method="POST" enctype="multipart/form-data" id="welcomedelete{{$welcome->id}}">
                                @csrf
                                @method('DELETE')
                            </form>
                            <button type="submit" class="btn btn-danger" onclick="
                            if(confirm('Are you sure to delete this')){
                                event.preventDefault();
                                document.getElementById('welcomedelete{{$welcome->id}}').submit();
                            }
                            ">Delete</button>
                        </td>
                        
                    </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                  <th>Sl</th>
                    <th>Title</th>
                    <th>Sub Title</th>
                    <th>Point -1</th>
                    <th>Point -1</th>
                    <th>Point -1</th>
                    <th>Details</th>
                    <th>image</th>
                    <th>Video Link</th>
                    <th>Action</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
        </div>
    </div>
</div>
@endsection 
@push('js')
<!-- DataTables  & Plugins -->
<script src="{{asset('backend')}}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{asset('backend')}}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{asset('backend')}}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{asset('backend')}}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="{{asset('backend')}}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{asset('backend')}}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="{{asset('backend')}}/plugins/jszip/jszip.min.js"></script>
<script src="{{asset('backend')}}/plugins/pdfmake/pdfmake.min.js"></script>
<script src="{{asset('backend')}}/plugins/pdfmake/vfs_fonts.js"></script>
<script src="{{asset('backend')}}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="{{asset('backend')}}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="{{asset('backend')}}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
@endpush