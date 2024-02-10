@extends('admin_layouts.app')
@section('heder_title', 'All Item')
@section('title', 'All Item')
@push('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('backend')}}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="{{asset('backend')}}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="{{asset('backend')}}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endpush
@section('admin-content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
        <div class="card">
              <div class="card-header">
                <h3 class="card-title"><a href="{{route('item.create')}}" class="btn btn-info">Add New</a></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Sl</th>
                    <th>category</th>
                    <th>Name</th>
                    <th>details</th>
                    <th>price</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                     @foreach($items as  $key=>$item)
                        <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$item->category->name}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->details}}</td>
                        <td>{{$item->price}}</td>
                        <td>
                            <a href="{{route('item.edit',$item->id)}}" class="btn btn-info">Edit</a>
                            <form id="delete-form-{{$item->id}}" action="{{route('item.destroy',$item->id)}}" method="POST">
                              @csrf
                              @method('DELETE')
                            </form>
                            <button class="btn btn-danger" type="button" onclick="if(confirm('Are You Sure to delete this?')){
                              event.preventDefault();
                              document.getElementById('delete-form-{{$item->id}}').submit();
                            }else{
                              event.preventDefault();
                            }">Delete</button>
                        </td>
                    </tr>

                    @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                  <th>Sl</th>
                    <th>category</th>
                    <th>Name</th>
                    <th>details</th>
                    <th>price</th>
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