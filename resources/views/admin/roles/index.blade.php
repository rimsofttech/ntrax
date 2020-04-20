@extends('layouts.master')

@section('css')
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- third party css -->
        <link href="{{ URL::asset('assets/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- third party css end -->
        <link href="{{ URL::asset('assets/libs/custombox/custombox.min.css')}}" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
        <title>Ntrax - Roles Master</title>

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
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Roles & Permissions</a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Roles</a></li>
                                            {{-- <li class="breadcrumb-item active">Datatables</li> --}}
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Roles Master</h4>
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
                                                    <i class="mdi mdi-plus-circle mr-1"></i> Add Role
                                                  </button>
                                            </div>
                                        </div>
                                        <div class="row">&nbsp;</div>
                                        <table  class="table table-striped nowrap fetchdata">
                                            <thead>
                                                <tr>
                                                    <th>Sr No.</th>
                                                    <th>Role Name</th>
                                                    <th>Display Name</th>
                                                    <th>Description</th>
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
                              <h5 class="modal-title" id="ModalLongTitle">Add New Role</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                                <span id="form_result"></span>
                                <form method="post" id="role_form" class="form-horizontal" enctype="multipart/form-data">
                                        @csrf
                                    <div class="alert alert-success d-none" id="msg_div">
                                          <span id="res_message"></span>
                                     </div>
                                  
                                  <div class="form-group">
                                    <label for="rolename">Role Name</label>
                                    <input type="text" name="rolename" class="form-control" id="rolename" placeholder="Please enter Role name">
                                    <span class="text-danger">{{ $errors->first('rolename') }}</span>
                                  </div>
                                  <div class="form-group">
                                    <label for="displayname">Display Name</label>
                                    <input type="text" class="form-control" name="displayname" id="displayname" placeholder="Please enter Display name">
                                    <span class="text-danger">{{ $errors->first('displayname') }}</span>
                                  </div>
                                  <div class="form-group">
                                    <label for="description">Description</label>
                                    <input type="text" class="form-control" name="description" id="description" placeholder="Please enter Discription">
                                    <span class="text-danger">{{ $errors->first('description') }}</span>
                                  </div>
                                  <div class="form-group">
                                      <label for="permission">Select Permission</label>
                                      <select class="form-control select2-multiple permission-select2" data-toggle="select2" multiple="multiple" data-placeholder="Choose Permission..." id="permission" name="permission[]" style="width:100%">
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
          responsive: true,
          bDestroy: true,
          ajax:{
           url: "{{ route('role.index') }}",
          },
        //   data: data,
          columns:[
            {
                data:'DT_RowIndex',
                name:'DT_RowIndex'

            },
            {
            data: 'name',
             name:'name'
           },
           {
            data: 'display_name',
             name:'display_name'
           },
           { data: 'description',
                name:'description'
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
            $('#rolename').val('');
            $('#displayname').val('');
            $('#description').val('');
            $(".permission-select2 option:selected").attr('selected',false).trigger('change');
            $('.modal-title').text("Add New Record");
            $('#action_button').val("Add");
            $('#action').val("Add");
            $('#formModal').modal('show');
        });

        $('#role_form').on('submit', function(event){
            event.preventDefault();
            if($('#action').val() == 'Add')
            {
            $.ajax({
                url:"{{ route('role.store') }}",
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
                $('#role_form')[0].reset();
                $('.fetchdata').DataTable().ajax.reload();
                $('#rolename').val('');
                $('#displayname').val('');
                $('#description').val('');
                $(".permission-select2 option:selected").attr('selected',false).trigger('change');

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
            url:"{{ route('role.update') }}",
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
            // $('#role_form')[0].reset();
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
            $('#rolename').val('');
            $('#displayname').val('');
            $('#description').val('');
            $(".permission-select2 option:selected").attr('selected',false).trigger('change');
            var id = $(this).attr('id');
            $('#form_result').html('');
            $.ajax({
            url:"/admin/role/"+id+"/edit",
            dataType:"json",
            success:function(html){
                $('#rolename').val(html.data.name);
                $('#displayname').val(html.data.display_name);
                $('#description').val(html.data.description);
                var htmlText='';
                $.each(html.data.permissions, function(key, val) {
                    htmlText +="<option value="+html.data.permissions[key].id+" selected>"+html.data.permissions[key].name+"</option>";
                })
                $('.permission-select2').append(htmlText).trigger('change');
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
            role_id = $(this).attr('id');
            $('#ok_button').text('Ok');
            $("#ok_button").css("display","block");
            $("#ok_button1").css("display","none");
            $('#confirmModal').modal('show');
            });

            $('#ok_button').click(function(){
            $.ajax({
            url:"/admin/role/destroy/"+role_id,
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