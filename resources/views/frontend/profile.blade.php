@extends('frontend.layouts.master')
@section('title')
Holding Info Add
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
        
      <!-- /.container-fluid -->
      <div class="container mt-3">
        <div class="row d-flex justify-content-center">
            <div class="col-md-6">
                {{-- <a href="{{ route('porperty-tax.store') }}" class="btn btn-primary mb-3">Back</a> --}}
                <div class="card card-primary p-4 border-0 shadow-lg">
                    <form action="{{ route('porperty-tax.store') }}" method="post">
                      @csrf
                    <div class="card-body">
                        <h3 class="text-center">Holding Number Added</h3>
                       
                        <div class="mb-3">
                            <select name="divition" id="divition" class="form-control-lg form-control">
                                <option value="">Select Divition</option>
                                @if (!empty($districts))
                                    @foreach ($districts as $district)
                                        <option value="{{ $district->id }}">{{ $district->district_name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="mb-3">
                            <select name="municipality" id="municipality" class="form-control-lg form-control">
                                <option value="">Select Municipality</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <select name="ward" id="ward" class="form-control-lg form-control">
                                <option value="">Select Ward</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <select name="block" id="block" class="form-control-lg form-control">
                                <option value="">Select Block</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <select name="subblock" id="subblock" class="form-control-lg form-control">
                                <option value="">Select Sub block</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <input type="number" class="form-control-lg form-control" name="holding_number" id="holding_number" placeholder="Enter holding number">
                            <p class="invalid-feedback" id="name-error"></p>
                        </div>
                        <div class="mb-3">
                            <input type="file" class="form-control-lg form-control" name="image" id="image" placeholder="Enter image">
                            <p class="invalid-feedback" id="email-error"></p>
                        </div>
                        
                        <div class="d-grid">
                            <button class="btn btn-primary btn-lg">Confirm</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
      <!-- Main content -->
      <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
           

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Total Propartys : {{\App\Models\Poperty_tax::where('user_id',auth()->user()->id)->count()}} </h3>
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
                            {{--<a type="button" data-toggle="modal" data-target="#edit_{{$item->id}}"
                             class="btn-sm btn-info">Assign Tax</a> --}}
                             @if($item->poperty_tax > 0)
                             <span class="badge badge-success">Account Varified</span>
                            @else
                            <form class="float-left px-2" action="{{ route('nid.destroy',$item->id) }}" method="POST">
                                @csrf 
                                @method('delete')
                                <a type="button" data-type="confirm" class="dltBtn btn-sm btn-danger js-sweetalert" title="Delete">Delete</a>

                            </form>
                            @endif
                           
                           
                            
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