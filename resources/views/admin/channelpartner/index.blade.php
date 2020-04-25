@extends('layouts.master')

@section('css')
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- third party css -->
        <link href="{{ URL::asset('assets/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- third party css end -->
        <link href="{{ URL::asset('assets/libs/custombox/custombox.min.css')}}" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
        <title>Ntrax - Channel Partner</title>

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
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Masters</a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Channel Partner</a></li>
                                            {{-- <li class="breadcrumb-item active">Datatables</li> --}}
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Channel Partner Master</h4>
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
                                                    <i class="mdi mdi-plus-circle mr-1"></i> Add Channel Partner
                                                  </button>
                                            </div>
                                        </div>
                                        <div class="row">&nbsp;</div>
                                        <table  class="table table-striped nowrap fetchdata">
                                            <thead>
                                                <tr>
                                                    <th>Sr No.</th>
                                                    <th>Name</th>
                                                    <th>Company Name</th>
                                                    <th>Email</th>
                                                    <th>Additional Email</th>
                                                    <th>Phone</th>
                                                    <th>Additional Phone</th>
                                                    <th>Commission Percentage</th>
                                                    <th>Channel Partner</th>
                                                    <th>Creted At</th>
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
                              <h5 class="modal-title" id="ModalLongTitle">Add New Partner Channel</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                                <span id="form_result"></span>
                                <form method="post" id="channelpartner_form" class="form-horizontal" enctype="multipart/form-data">
                                        @csrf
                                    <div class="alert alert-success d-none" id="msg_div">
                                          <span id="res_message"></span>
                                     </div>
                                  
                                  <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control" id="name" placeholder="Please enter name">
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                  </div>

                                  <div class="form-group">
                                    <label for="companyname">Company Name</label>
                                    <input type="text" class="form-control" name="companyname" id="companyname" placeholder="Please enter Company Name">
                                    <span class="text-danger">{{ $errors->first('companyname') }}</span>
                                  </div>

                                  <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control" name="email" id="email" placeholder="Please enter Email">
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                  </div>

                                  <div class="form-group">
                                    <label for="additionalemail">Additional Email</label>
                                    <input type="text" class="form-control" name="additionalemail" id="additionalemail" placeholder="Please enter Additional Email">
                                    <span class="text-danger">{{ $errors->first('additionalemail') }}</span>
                                  </div>

                                  <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="text" class="form-control" name="phone" id="phone" placeholder="Please enter Phone Number">
                                    <span class="text-danger">{{ $errors->first('phone') }}</span>
                                  </div>

                                  <div class="form-group">
                                    <label for="additionalphone">Additional Phone</label>
                                    <input type="text" class="form-control" name="additionalphone" id="additionalphone" placeholder="Please enter Additional Phone Number">
                                    <span class="text-danger">{{ $errors->first('additionalphone') }}</span>
                                  </div>

                                  <div class="form-group">
                                    <label for="commissionpercentage">Commission Percentage in (%)</label>
                                    <input type="number" class="form-control" name="commissionpercentage" id="commissionpercentage" placeholder="Please enter Commission Percentage in (%)">
                                    <span class="text-danger">{{ $errors->first('commissionpercentage') }}</span>
                                  </div>

                                  <div class="form-group">
                                      <label for="channeltype">Select Channel Partner Type</label>
                                      <select class="form-control"  data-placeholder="Choose Channel Type..." id="channelpartnertype" name="channelpartnertype" style="width:100%">
                                        <option value="" disabled>Select Channel Partner Type</option>
                                        <option value="1">A</option>
                                        <option value="2">B</option>
                                        <option value="3">C</option>
                                    </select>
                                  </div>
                                  <input type="hidden" name="action" id="action" />
                                  <input type="hidden" name="hidden_id" id="hidden_id" />
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-outline-danger btn-rounded waves-effect waves-light" data-dismiss="modal">Close</button>
                              <input type="submit" name="action_button" id="action_button" class="btn btn-outline-success btn-rounded waves-effect waves-light" value="Add" style="display:block"/>
                              <button class="btn btn-outline-danger btn-rounded waves-effect waves-light" id="action_buttonone" type="button" disabled style="display:none">
                                <span class="spinner-border spinner-border-sm mr-1" role="status" aria-hidden="true"></span><span id="a_button1">
                                Updating...<span>
                            </button>  
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
        $(document).ready(function(){
            $(".permission-select2").select2({
            ajax: {
                url: function (params) {
                    return "{{route('search.permission')}}";
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
            // minimumInputLength: 3,
        });
         $('.fetchdata').DataTable({
          processing: true,
          serverSide: true,
          bDestroy: true,
          scrollX: true,
          ajax:{
           url: "{{ route('channelpartner.index') }}",
          },
        //   data: data,
          columns:[
            {
                data:'DT_RowIndex',
                name:'DT_RowIndex'

            },
            {
                data : 'name',
                name : 'name'
           },
           {
                data : 'company_name',
                name : 'company_name'
           },
           {
                data : 'email',
                name : 'email'
           },
            {   data : 'addn_email',
                name : 'addn_email'
            },
           {
                data : 'phone',
                name : 'phone'
           },
           {
                data : 'addn_phone',
                name : 'addn_phone'
           },
           {
                data : 'commission_percentage',
                name : 'commission_percentage'
           },
           {
                data : 'partner_type',
                name : 'partner_type'
           },
           {
                data : 'created_at',
                name : 'created_at'
           },
           {
                data : 'updated_at',
                name : 'updated_at'
           },
           {
                data : 'action',
                name : 'action',
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
            $('#name').val('');
            $('#companyname').val('');
            $('#email').val('');
            $('#additionalemail').val('');
            $('#phone').val('');
            $('#additionalphone').val('');
            $('#channelpartnertype option[value=""]').attr('selected', true);
            $('#commissionpercentage').val('');
            $('.modal-title').text("Add New Record");
            $('#action_button').val("Add");
            $('#action').val("Add");
            $('#formModal').modal('show');
        });
        $('#channelpartner_form').on('submit', function(event){
            event.preventDefault();
            if($('#action').val() == 'Add')
            {
            $.ajax({
                url:"{{ route('channelpartner.store') }}",
                method:"POST",
                data: new FormData(this),
                contentType: false,
                cache:false,
                processData: false,
                dataType:"json",
                beforeSend:function(){
                $("#action_button").css("display","none");
                $("#a_button1").text("Adding...");
                $("#action_buttonone").css("display","block");
                },
                success:function(data)
                {
                    
                    
                var html = '';
                if(data.errors)
                {
                    $.each(data.errors, function(key, val) {
                        toastr.error(''+data.errors[key]+'','Error',{
                        closeButton:true,
                        progressBar:true,
                    });
                });
                }
                if(data.success)
                {
                    toastr.success(''+data.success+'','Success',{
                    closeButton:true,
                    progressBar:true,
                });
                $('#channelpartner_form')[0].reset();
                $('.fetchdata').DataTable().ajax.reload();
                $('#name').val('');
                $('#companyname').val('');
                $('#email').val('');
                $('#additionalemail').val('');
                $('#phone').val('');
                $('#additionalphone').val('');
                $('#additionalphone').val();
                $('#commissionpercentage').val('');
                $('#channelpartnertype option[value=""]').attr('selected', true);
                }
                setTimeout(function(){
                $("#action_button").css("display","block");
                $("#action_buttonone").css("display","none");
                }, 3000);
                }
            })
            }
            if($('#action').val() == "Edit")
        {
           
        $.ajax({
            url:"{{ route('channelpartner.update') }}",
            method:"POST",
            data:new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType:"json",
            beforeSend:function(){
                $("#action_button").css("display","none");
                $("#a_button1").text("Updating...");
                $("#action_buttonone").css("display","block");
                },
            success:function(data)
            {
            var html = '';
            if(data.errors)
            {
                $.each(data.errors, function(key, val) {
                        toastr.error(''+data.errors[key]+'','Error',{
                        closeButton:true,
                        progressBar:true,
                    });
                });
            }
            if(data.success)
            {
                toastr.success(''+data.success+'','Success',{
                closeButton:true,
                progressBar:true,
            });
            // $('#channelpartner_form')[0].reset();
            $('.fetchdata').DataTable().ajax.reload();
            }
            $("#action_button").css("display","block");
            $("#action_buttonone").css("display","none");
            // $('#formModal').modal('hide');
            }
        });
        }   
        });
        $(document).on('click', '.edit', function(){
            $('#name').val('');
            $('#companyname').val('');
            $('#email').val('');
            $('#additionalemail').val();
            $('#phone').val();
            $('#additionalphone').val();
            $("#channelpartnertype option:selected").attr('selected',false).trigger('change');
            var id = $(this).attr('id');
            $('#form_result').html('');
            $.ajax({
            url:"/admin/channelpartner/"+id+"/edit",
            dataType:"json",
            success:function(html){
                $('#name').val(html.data.name);
                $('#companyname').val(html.data.company_name);
                $('#email').val(html.data.email);
                $('#additionalemail').val(html.data.addn_email);
                $('#phone').val(html.data.phone);
                $('#additionalphone').val(html.data.addn_phone)
                $('#commissionpercentage').val(html.data.commission_percentage);
                $('#channelpartnertype option[value='+html.data.partner_type+']').attr('selected', true);
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
            channelpartner_id = $(this).attr('id');
            $('#ok_button').text('Ok');
            $("#ok_button").css("display","block");
            $("#ok_button1").css("display","none");
            $('#confirmModal').modal('show');
            });

            $('#ok_button').click(function(){
            $.ajax({
            url:"/admin/channelpartner/destroy/"+channelpartner_id,
            beforeSend:function(){
                $("#ok_button").css("display","none");
                $("#ok_button1").css("display","block");
                $('#ok_button').text('Deleting...');
            },
            success:function(data)
            {
                if(data.errors)
            {
                $.each(data.errors, function(key, val) {
                        toastr.error(''+data.errors[key]+'','Error',{
                        closeButton:true,
                        progressBar:true,
                    });
                });
            }
            if(data.success)
            {
                toastr.success(''+data.success+'','Success',{
                closeButton:true,
                progressBar:true,
            });
            }
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