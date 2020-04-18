@extends('layouts.master')

@section('css')
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- third party css -->
        <link href="{{ URL::asset('assets/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- third party css end -->
        <link href="{{ URL::asset('assets/libs/custombox/custombox.min.css')}}" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />



@endsection

@section('content')

                    <!-- Start Content-->
                    <div class="container-fluid">
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">UBold</a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                                            <li class="breadcrumb-item active">Datatables</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Datatables</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <button type="button" class="btn btn-primary" data-toggle="modal"  name="create_record" id="create_record">
                                                    <i class="mdi mdi-plus-circle mr-1"></i> Add Zone
                                                  </button>
                                            </div>
                                        </div>
                                        <div class="row">&nbsp;</div>
                                        <table  class="table table-striped nowrap fetchdata">
                                            <thead>
                                                <tr>
                                                    <th>Zone Name</th>
                                                    <th>Country</th>
                                                    <th>States</th>
                                                    <th>City</th>
                                                    <th>Created At</th>
                                                    <th>Updated At</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                        
                                        <tbody>

                                        </tbody>
                                        </table>
                                        
                                    </div> <!-- end card body-->
                                </div> <!-- end card -->
                            </div><!-- end col-->
                        </div>
                        <!-- end row-->

                        
                    </div> <!-- container -->
                   
                      <!-- Modal -->
                      <div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="ModalLongTitle">Add New Zone</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                                <span id="form_result"></span>
                                <form method="post" id="zone_form" class="form-horizontal" enctype="multipart/form-data">
                                        @csrf
                                    <div class="alert alert-success d-none" id="msg_div">
                                          <span id="res_message"></span>
                                     </div>
                                  
                                  <div class="form-group">
                                    <label for="zonename">Name</label>
                                    <input type="text" name="zonename" class="form-control" id="zonename" placeholder="Please enter Zone name">
                                    <span class="text-danger">{{ $errors->first('zonename') }}</span>
                                  </div>
                                  <div class="form-group">
                                    <label for="country">Country</label>
                                    <select class="form-control select2-multiple country-select2" data-toggle="select2" multiple="multiple" data-placeholder="Choose Country..." id="country" name="country" style="width:100%">
                                             
                                    </select>
                                    
                                  </div>
                                  <div class="form-group">
                                    <label for="state">State</label>
                                    <select class="form-control select2-multiple state-select2" data-toggle="select2" multiple="multiple" data-placeholder="Choose State..." id="state" name="state[]" style="width:100%">
                                             
                                    </select>
                                  
                                  </div>
                                  <div class="form-group">
                                    <label for="city">City</label>
                                    <select class="form-control select2-multiple city-select2" data-toggle="select2" multiple="multiple" data-placeholder="Choose City..." id="city" name="city[]" autocomplete="off" style="width:100%">
                                        
                                </select>
                                 
                                  </div>
                                  <input type="hidden" name="action" id="action" />
                                  <input type="hidden" name="hidden_id" id="hidden_id" />
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-outline-danger btn-rounded waves-effect waves-light" data-dismiss="modal">Close</button>
                              <input type="submit" name="action_button" id="action_button" class="btn btn-outline-success btn-rounded waves-effect waves-light" value="Add" />
                            </form>

                            </div>
                          </div>
                        </div>
                      </div>
                      <div id="confirmModal" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="">Confirmation</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                <div class="modal-body">
                                    <h4 align="center" style="margin:0;">Are you sure you want to remove this data?</h4>
                                </div>
                                <div class="modal-footer">
                                 <button type="button" name="ok_button" id="ok_button" class="btn btn-outline-danger btn-rounded waves-effect waves-light" style="display:block">OK</button>
                                 <button class="btn btn-outline-danger btn-rounded waves-effect waves-light" id="ok_button1" type="button" disabled style="display:none">
                                    <span class="spinner-border spinner-border-sm mr-1" role="status" aria-hidden="true"></span>
                                    Deleting...
                                </button> 
                                    <button type="button" class="btn btn-outline-dark btn-rounded waves-effect waves-light" data-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
@endsection

@section('script')
        <script src="{{ URL::asset('assets/libs/datatables/datatables.min.js')}}"></script>
        <!-- third party js -->
        <script src="{{ URL::asset('assets/libs/pdfmake/pdfmake.min.js')}}"></script>
        <!-- third party js ends -->
        <script src="{{ URL::asset('assets/libs/custombox/custombox.min.js')}}"></script>
        <!-- Datatables init -->
        <script src="{{ URL::asset('assets/js/pages/datatables.init.js')}}"></script>

        <script>
            $(document).ready(function () {
                 $(".country-select2").select2({
                   ajax: {
                       url: function (params) {
                           return "{{route('search.country').'/'}}" + params.term;
                       },
                       dataType: 'json',
                       delay: 250,
                       data: function (params) {
                           return {q: params.term, };
                       },
                       processResults: function (data, params) {
                           return {results: data};
                       },
                       cache: true
                   },
                   minimumInputLength: 3,
               });
           
           
               $( ".country-select2" ) .change(function () {
                   $("#state_name").val('');
                   $("#city_name").val('');
                   let param_new = $(this).val();
                   var param_country = "?country_id="+param_new;
                   $(".state-select2").select2({
                   ajax: {
                       url: function (param) {
                           return "{{route('search.state').'/'}}" + param.term + param_country;
                       },
                       dataType: 'json',
                       delay: 250,
                       data: function (param) {
                           return {q: param.term, };
                       },
                       processResults: function (data, param) {
                           return {results: data};
                       },
                       cache: true
                   },
                   // minimumInputLength: 3,
               });
               });
           
               $( ".state-select2" ) .change(function () {
                   $("#city_name").val('');
                   let param_new = $(this).val();
                   var param_state = "?state_id="+param_new;
                   $(".city-select2").select2({
                   ajax: {
                       url: function (param) {
                           return "{{route('search.city').'/'}}" + param.term + param_state;
                       },
                       dataType: 'json',
                       delay: 250,
                       data: function (param) {
                           return {q: param.term, };
                       },
                       processResults: function (data, param) {
                           return {results: data};
                       },
                       cache: true
                   },
                   // minimumInputLength: 3,
               });
               });
           });
        </script>
       
       <script>
        $(document).ready(function(){
         $('.fetchdata').DataTable({
          processing: true,
          serverSide: true,
          responsive: true,
          bDestroy: true,
          ajax:{
           url: "{{ route('zone.index') }}",
          },
        //   data: data,
          columns:[
           {
            data: 'zonename',
             name:'zonename'
           },
           { data: 'country',
                name:'country'
            },
            {
                data: 'state',
                name: 'state',
                orderable: false,
                searchable: false
            },
           {
                data: 'city',
                name: 'city',
                orderable: false,
                searchable: false
           },
           {
            data: 'created_at',
            name: 'created_at'
           },
           {
            data: 'updated_at',
            name: 'updated_at'
           },
           {
            data: 'action',
            name: 'action',
            rderable: false,
            searchable: false
           }
          ],
          dom: 'lBfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
        "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
         });
         $('#create_record').click(function(){
            $('#zonename').val('');
            $(".country-select2 option:selected").attr('selected',false).trigger('change');
            $(".state-select2 option:selected").attr('selected',false).trigger('change');
            $(".city-select2 option:selected").attr('selected',false).trigger('change');
            $('.modal-title').text("Add New Record");
            $('#action_button').val("Add");
            $('#action').val("Add");
            $('#formModal').modal('show');
        });

        $('#zone_form').on('submit', function(event){
            event.preventDefault();
            if($('#action').val() == 'Add')
            {
            $.ajax({
                url:"{{ route('zone.store') }}",
                method:"POST",
                data: new FormData(this),
                contentType: false,
                cache:false,
                processData: false,
                dataType:"json",
                success:function(data)
                {
                var html = '';
                if(data.errors)
                {
                html = '<div class="alert alert-danger">';
                for(var count = 0; count < data.errors.length; count++)
                {
                html += '<p>' + data.errors[count] + '</p>';
                }
                html += '</div>';
                }
                if(data.success)
                {
                html = '<div class="alert alert-success">' + data.success + '</div>';
                $('#zone_form')[0].reset();
                $('.fetchdata').DataTable().ajax.reload();
                }
                $('#form_result').html(html);
                }
            })
            }
            if($('#action').val() == "Edit")
        {
           
        $.ajax({
            url:"{{ route('zone.update') }}",
            method:"POST",
            data:new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType:"json",
            success:function(data)
            {
            var html = '';
            if(data.errors)
            {
            html = '<div class="alert alert-danger">';
            for(var count = 0; count < data.errors.length; count++)
            {
            html += '<p>' + data.errors[count] + '</p>';
            }
            html += '</div>';
            }
            if(data.success)
            {
            html = '<div class="alert alert-success">' + data.success + '</div>';
            $('#zone_form')[0].reset();
            $('.fetchdata').DataTable().ajax.reload();
            }
            $('#form_result').html(html);
            }
        });
        }   
        });
        $(document).on('click', '.edit', function(){
            $('#zonename').val('');
            $(".country-select2 option:selected").attr('selected',false).trigger('change');
            $(".state-select2 option:selected").attr('selected',false).trigger('change');
            $(".city-select2 option:selected").attr('selected',false).trigger('change');
            var id = $(this).attr('id');
            $('#form_result').html('');
            $.ajax({
            url:"/admin/zone/"+id+"/edit",
            dataType:"json",
            success:function(html){
                $('#zonename').val(html.data.zonename);
                $('.country-select2').append("<option value="+html.data.country+" selected>"+html.data.country_name+"</option>").trigger('change');
                var htmlText='';
                var htmlTextCity='';
                $.each(html.data.state_id, function(key, val) {
                    htmlText +="<option value="+html.data.state_id[key]+" selected>"+html.data.state_name[key]+"</option>";
                })

                $.each(html.data.city_id, function(key, val) {
                    htmlTextCity +="<option value="+html.data.city_id[key]+" selected>"+html.data.city_name[key]+"</option>";
                })
                
                $('.state-select2').append(htmlText).trigger('change');
                $('.city-select2').append(htmlTextCity).trigger('change');
              
                $('#hidden_id').val(html.data.id);
                $('.modal-title').text("Edit New Record");
                $('#action_button').val("Edit");
                $('#action').val("Edit");
                $('#formModal').modal('show');
            }
            })
            });
            var user_id;

            $(document).on('click', '.delete', function(){
            zone_id = $(this).attr('id');
            $('#ok_button').text('Ok');
            $('#confirmModal').modal('show');
            });

            $('#ok_button').click(function(){
            $.ajax({
            url:"/admin/zone/destroy/"+zone_id,
            beforeSend:function(){
                $("#ok_button").css("display","none")
                $("#ok_button1").css("display","block")
            $('#ok_button').text('Deleting...');
            },
            success:function(data)
            {
            setTimeout(function(){
                $('#confirmModal').modal('hide');
                $('.fetchdata').DataTable().ajax.reload();
            }, 2000);
            }
            })
            });
        });
        </script>
     
 <script src="{{ URL::asset('assets/libs/custombox/custombox.min.js')}}"></script>
@endsection