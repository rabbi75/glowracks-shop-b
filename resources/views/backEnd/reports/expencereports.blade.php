@extends('backEnd.layouts.master')
@section('title','Expence Reports')
@section('main_content')
 <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Expence Reports</h3>
            </div>
          <!-- /.card-header -->
            <div class="card-body">
              <table  class="example table table-responsive-sm table-bordered table-striped custom-table">
              <thead>
              <tr>
                <th>Id</th>
                <th>Category</th>
                <th>Name</th>
                <th>Amount</th>
                <th>Status</th>
              </tr>
              </thead>
              <tbody>
                @php $total = 0; @endphp
                @foreach($show_data as $key=>$value)
                <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>{{$value->expencecatname}}</td>
                  <td>{{$value->name}}</td>
                  <td>{{$value->ammount}}</td>
                  <td>{{$value->status==1? "Active":"Inactive"}}</td>
                  
                  @php
                    $total += $value->ammount;
                  @endphp
                </tr>
                @endforeach
              </tbody>
              <tfoot>
                <tr>
                  <td></td>
                  <td></td>
                  <td><strong>Total</strong></td>
                  <td><strong>{{$total}}</strong></td>
                  <td></td>
                  <td></td>
                </tr>
              </tfoot>
            </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
    <script>
$(document).ready(function() {
  $('.example').DataTable( {
      dom: 'Bfrtip',
      buttons: [
          {
              extend: 'copy',
              text: 'Copy',
              exportOptions: {
                  columns: [ 0, 1, 2, 3, 4]
              }
          },
          {
              extend: 'excel',
              text: 'Excel',
              exportOptions: {
                  columns: [ 0, 1, 2, 3, 4]
              }
          },
          {
              extend: 'csv',
              text: 'Csv',
              exportOptions: {
                  columns: [ 0, 1, 2, 3, 4]
              }
          },
          {
              extend: 'pdfHtml5',
              exportOptions: {
                 columns: [ 0, 1, 2, 3, 4]
              }
          },
          
          {
              extend: 'print',
              text: 'Print',
              exportOptions: {
                  columns: [ 0, 1, 2, 3, 4]
              }
          },
          {
              extend: 'print',
              text: 'Print all',
              exportOptions: {
                  modifier: {
                      selected: null
                  }
              }
          },
          {
              extend: 'colvis',
          },
          
      ],
      select: true
  } );
  
   table.buttons().container()
      .appendTo( '#example_wrapper .col-md-6:eq(11)' );
});
</script>
@endsection