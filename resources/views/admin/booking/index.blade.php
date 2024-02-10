@extends('admin_layouts.app')
@section('heder_title', 'All Booking')
@section('title', 'All Booking')
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
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Sl</th>
                    <th>Name</th>
                    <th>email</th>
                    <th>phone</th>
                    <th>Date And Time</th>
                    <th>Person</th>
                    <th>message</th>
                    <th>status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                     @foreach($bookings as  $key=>$booking)
                        <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$booking->name}}</td>
                        <td>{{$booking->email}}</td>
                        <td>{{$booking->phone}}</td>
                        <td>{{$booking->date}}|| {{$booking->time}}</td>
                        <td>{{$booking->person}}</td>
                        <td>{{$booking->message}}</td>
                        <td>
                          @if($booking->status == 0)

                          <form action="confirm{{$booking->id}}" method="POST" id="confirm{{$booking->id}}">
                            @csrf
                          </form>

                          <a href="" class="btn btn-success btn-sm" onclick="if(confirm('are you sure to confirm this ?')){
                            event.preventDefault();
                            document.getElementById('confirm{{$booking->id}}').submit();
                          }">confirm</a>

                          <a href="" class="btn btn-warning btn-sm" onclick="if(confirm('are you sure to confirm this ?')){
                            event.preventDefault();
                            document.getElementById('confirm{{$booking->id}}').submit();
                          }">pending</a>

                          @elseif($booking->status == 1)
                          <form action="complet{{$booking->id}}" method="POST" id="complete{{$booking->id}}">
                            @csrf
                          </form>

                          <a href="" class="btn btn-primary btn-sm" onclick="if(confirm('are you sure to complet this ?')){
                            event.preventDefault();
                            document.getElementById('complete{{$booking->id}}').submit();
                          }">Completed</a>

                          @else
                          <p class="text-success">Order Complet</p>
                          @endif
                          
                        </td>
                        <td>
                            <form id="delete-form-{{$booking->id}}" action="{{route('booking.destroy',$booking->id)}}" method="POST">
                              @csrf
                              @method('DELETE')
                            </form>
                            <button class="btn btn-danger" type="button" onclick="if(confirm('Are You Sure to delete this?')){
                              event.preventDefault();
                              document.getElementById('delete-form-{{$booking->id}}').submit();
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
                    <th>Name</th>
                    <th>email</th>
                    <th>phone</th>
                    <th>Date And Time</th>
                    <th>Person</th>
                    <th>message</th>
                    <th>status</th>
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