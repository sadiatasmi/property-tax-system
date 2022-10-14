@extends('frontend.layouts.master')
@section('title')
Tax Pay
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
        
  
      <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
           

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Total Propartys : {{\App\Models\Poperty_tax::count()}} </h3>
                <div class="pull-right" style="text-align:right;">
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>S.N.</th>
                    <th>Photo</th>
                    <th>Nid</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Poperty Tax</th>
                    <th>District</th>
                    <th>Municipalitie</th>
                    <th>Ward</th>
                    <th>Block</th>
                    <th>Subblock</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($userpropartys as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td><img style=" height:50px; width:50px; border-radius: 25px;" src="{{asset($item->image)}}"></td>
                        <td>{{$item->nid_number}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->phone}}</td>
                        <td>
                            @if($item->poperty_tax > 0)
                            {{$item->poperty_tax}} TK- Monthly
                            @else
                            0 TK
                            @endif
                        </td>
                        <td>{{$item->district_name}}</td>
                        <td>{{$item->municipalitie_name}}</td>
                        <td>{{$item->ward_name}}</td>
                        <td>{{$item->block_name}}</td>
                        <td>{{$item->subblock_name}}</td>
                        <td>
                            @if($item->poperty_tax > 0)
                             <span class="badge badge-success">Accept</span>
                            @else
                            <span class="badge badge-warning">Panding</span>
                            @endif
                        </td>
                        <td>
                            
                             @if($item->poperty_tax > 0)
                             <a type="button" data-toggle="modal" data-target="#edit_{{$item->id}}"
                             class="btn-sm btn-info">Payment Amount</a> 
                            @else
                            <form class="float-left px-2" action="{{ route('nid.destroy',$item->id) }}" method="POST">
                                @csrf 
                                @method('delete')
                                <a type="button" data-type="confirm" class="dltBtn btn-sm btn-danger js-sweetalert" title="Delete">Delete</a>

                            </form>
                            @endif
                           
                           
                            
                        </td>
                    </tr>
                  <!-- District Edit model start --> 
                  <div class="modal fade" id="edit_{{$item->id}}">
                                <div class="modal-dialog">
                                <div class="modal-content bg-info">
                                    <div class="modal-header">
                                    <h4 class="modal-title">Payment Proparty Tax </h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <form class="add-contact-form" method="post" action="{{ route('payment_tax.store') }}" enctype="multipart/form-data">
                                        @csrf
                                        <!-- @method('patch') -->
                                        <!-- <input type="hidden" name="id" value="{{$item->id}}" > -->
                                        <div class="modal-body">
                                            
                                            <div class="form-group">
                                                <label for="">Amount</label>
                                                <input type="text" class="form-control" readonly placeholder="Enter poperty tax" value="{{$item->poperty_tax}}" name="amount"  />
                                            </div>

                                            <div class="form-group">
                                            <label for="">Holding Number</label>
                                                <input type="number" class="form-control" readonly placeholder="Enter poperty tax" value="{{$item->holding_number}}" name="holding_number"  />
                                            </div>

                                            <div class="form-group">
                                            <label for="">Select Payment Method</label>
                                                <select name="payment_method" id="" class="form-control">
                                                    <option value="" disabled selected>Select Payment Method</option>
                                                    <option value="bkash">Bkash</option>
                                                    <option value="nagad" >Nagad</option>
                                                    <option value="roket" >Roket</option>
                                                    <option value="dbbl" >DBBL</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="">Transaction Id</label>
                                                <input type="number" class="form-control" placeholder="Enter transaction id" name="transaction_id"  />
                                            </div>
                                            <div class="form-group">
                                                <label for="">Month</label>
                                                <select name="month" class="form-control">
                                                    <option value="" selected disabled>--Select Month--</option>

                                               
                                                    <option value="January" >January</option>
                                                    <option value="February" >February</option>
                                                    <option value="March" >March</option> 
                                                    <option value="April" >April</option> 
                                                    <option value="May" >May</option> 
                                                    <option value="June" >June</option> 
                                                    <option value="July" >July</option> 
                                                    <option value="August">August</option> 
                                                    <option value="September">September</option> 
                                                    <option value="October">October</option> 
                                                    <option value="November" >November</option> 
                                                    <option value="December" >December</option>
                                                    </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="year">Select Year :</label>
                                                <select  class="form-control" name="year" id="year">
                                                    @for($i=1960;$i<=date('Y');$i++)
                                                        <option value="{{ $i; }}" {{ old('year') == $i ? "selected" : "" }}>{{ $i; }}</option>
                                                    @endfor    
                                                </select>
                                                @error('year')
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                           
                                           
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-outline-light">Payment</button>
                                        </div>
                                    </form>  
                                </div>
                                <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->
                            <!-- branch Edit model end -->   
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