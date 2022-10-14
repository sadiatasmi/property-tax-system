@extends('frontend.layouts.master')
@section('title')
Payment History
@endsection
@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
  <meta name="_token" content="{{ csrf_token() }}">
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
  

   <!-- Main content -->
   <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
           

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Total Payment : {{\App\Models\payment::where('user_id',auth()->user()->id)->count()}} </h3>
                <div class="pull-right" style="text-align:right;">
                   
                </div>
                
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>S.N.</th>
                    <th>Name</th>
                    <th>NID</th>
                    <th>Holding Number</th>
                    <th>Payment Method</th>
                    <th>Amount</th>
                    <th>Transaction Id</th>
                    <th>Month</th>
                    <th>Year</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($payments as $item)
                    <tr>
                        
                        <td>{{$loop->iteration}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->nid_number}}</td>
                        <td>{{$item->holding_number}}</td>
                        <td>{{$item->payment_method}}</td>
                        <td>{{$item->amount}}</td>
                        <td>{{$item->transaction_id}}</td>
                        <td>{{$item->month}}</td>
                        <td>{{$item->year}}</td>
                       
                        <td>
                               
<span class="badge badge-success">Successfully Payment</span>
                            
                        </td>
                    </tr>
                         
                  @endforeach   
                  </tbody>
                
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" ></script>
    









    <script>
    $.ajaxSetup({
         headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
         }
   });

   $(document).ready(function(){
        $("#divition").change(function(){
            var municipality_id = $(this).val();
           // alert(divition_id);

            if (municipality_id == "") {
                var municipality_id = 0;
            } 

            $.ajax({
                url: '{{ url("/fetch-municipality/") }}/'+municipality_id,
                type: 'post',
                dataType: 'json',
                success: function(response) {                    
                    $('#municipality').find('option:not(:first)').remove();
                    $('#ward').find('option:not(:first)').remove();
                    $('#block').find('option:not(:first)').remove();
                    $('#subblock').find('option:not(:first)').remove();

                    if (response['municipalities'].length > 0) {
                        $.each(response['municipalities'], function(key,value){
                            $("#municipality").append("<option value='"+value['id']+"'>"+value['municipalitie_name']+"</option>")
                        });
                    } 
                }
            });            
        });

        $("#municipality").change(function(){
            var ward_id = $(this).val();
            if (ward_id == "") {
                var ward_id = 0;
            } 

            $.ajax({
                url: '{{ url("/fetch-ward/") }}/'+ward_id,
                type: 'post',
                dataType: 'json',
                success: function(response) {                    
                    $('#block').find('option:not(:first)').remove();
                    $('#subblock').find('option:not(:first)').remove();

                    if (response['wards'].length > 0) {
                        $.each(response['wards'], function(key,value){
                            $("#ward").append("<option value='"+value['id']+"'>"+value['ward']+"</option>")
                        });
                    } 
                }
            });            
        });

        $("#ward").change(function(){
            var block_id = $(this).val();
            if (block_id == "") {
                var block_id = 0;
            } 

            $.ajax({
                url: '{{ url("/fetch-block/") }}/'+block_id,
                type: 'post',
                dataType: 'json',
                success: function(response) {                    
                    $('#subblock').find('option:not(:first)').remove();
                    if (response['blocks'].length > 0) {
                        $.each(response['blocks'], function(key,value){
                            $("#block").append("<option value='"+value['id']+"'>"+value['block_name']+"</option>")
                        });
                    } 
                }
            });            
        });


        $("#block").change(function(){
            var subblock_id = $(this).val();

            console.log(subblock_id);

            if (subblock_id == "") {
                var subblock_id = 0;
            } 

            $.ajax({
                url: '{{ url("/fetch-subblock/") }}/'+subblock_id,
                type: 'post',
                dataType: 'json',
                success: function(response) {                    
                    $('#subblock').find('option:not(:first)').remove();
                    if (response['subblocks'].length > 0) {
                        $.each(response['subblocks'], function(key,value){
                            $("#subblock").append("<option value='"+value['id']+"'>"+value['subblock_name']+"</option>")
                        });
                    } 
                }
            });            
        });

   });

   $("#frm").submit(function(event){
        event.preventDefault();
        $.ajax({
            url: '{{ url("/save") }}',
            type: 'post',
            data: $("#frm").serializeArray(),
            dataType: 'json',
            success: function(response) {                    
                if(response['status'] == 1) {
                    window.location.href="{{ url('list') }}";
                } else {
                    if (response['errors']['name']) {
                        $("#name").addClass('is-invalid');
                        $("#name-error").html(response['errors']['name']);
                    } else {
                        $("#name").removeClass('is-invalid');
                        $("#name-error").html("");
                    }

                    if (response['errors']['email']) {
                        $("#email").addClass('is-invalid');
                        $("#email-error").html(response['errors']['email']);
                    } else {
                        $("#email").removeClass('is-invalid');
                        $("#email-error").html("");
                    }
                }
            }
        }); 
   })
</script>
@endsection