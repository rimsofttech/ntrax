@extends('layouts.master')

@section('css')
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- third party css -->
        <link href="{{ URL::asset('assets/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- third party css end -->
        <link href="{{ URL::asset('assets/libs/custombox/custombox.min.css')}}" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
        <title>Ntrax - Permission Master</title>


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
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Permissions</a></li>
                                            {{-- <li class="breadcrumb-item active">Datatables</li> --}}
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Permissions</h4>
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
                                                    <i class="mdi mdi-plus-circle mr-1"></i> Add Permission
                                                  </button>
                                            </div>
                                        </div>
                                        <div class="row">&nbsp;</div>
                                        <table  class="table table-striped nowrap fetchdata">
                                            <thead>
                                                <tr>
                                                    <th>Sr No.</th>
                                                    <th>Permission Name</th>
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
                              <h5 class="modal-title" id="ModalLongTitle">Add New Permission</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                                <span id="form_result"></span>
                                <form method="post" id="permission_form" class="form-horizontal" enctype="multipart/form-data">
                                        @csrf
                                    <div class="alert alert-success d-none" id="msg_div">
                                          <span id="res_message"></span>
                                     </div>
                                  
                                  <div class="form-group">
                                    <label for="permissionname">Permission Name</label>
                                    <input type="text" name="permissionname" class="form-control" id="permissionname" placeholder="Please enter Permission name">
                                    <span class="text-danger">{{ $errors->first('permissionname') }}</span>
                                  </div>
                                  <div class="form-group">
                                    <label for="displayname">Display Name</label>
                                    <input type="text" name="displayname" class="form-control" id="displayname" placeholder="Please enter Display name">
                                    <span class="text-danger">{{ $errors->first('displayname') }}</span>
                                  </div>
                                  <div class="form-group">
                                    <label for="country">Description</label>
                                    <input type="text" class="form-control" name="description" id="description">
                                    <span class="text-danger">{{ $errors->first('description') }}</span>
                                  </div>
                                  <input type="hidden" name="action" id="action" />
                                  <input type="hidden" name="hidden_id" id="hidden_id" />
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-outline-danger btn-rounded waves-effect waves-light" data-dismiss="modal">Close</button>
                              <input type="submit" name="action_button" id="action_button" class="btn btn-outline-success btn-rounded waves-effect waves-light" value="Add" style="display:block" />
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
         $('.fetchdata').DataTable({
          processing: true,
          serverSide: true,
          responsive: true,
          bDestroy: true,
          ajax:{
           url: "{{ route('permission.index') }}",
          },
        //   data: data,
          columns:[
            {
                data:'DT_RowIndex',
                name:'DT_RowIndex'

            },
           {
            data: 'name',
             name:'rolename'
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
            $('#permissionname').val('');
            $('#displayname').val('');
            $('#description').val('');
            $('.modal-title').text("Add New Record");
            $('#action_button').val("Add");
            $('#action').val("Add");
            $('#formModal').modal('show');
        });

        $('#permission_form').on('submit', function(event){
            event.preventDefault();
            if($('#action').val() == 'Add')
            {
            $.ajax({
                url:"{{ route('permission.store') }}",
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
                $('#permission_form')[0].reset();
                $('.fetchdata').DataTable().ajax.reload();
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
            url:"{{ route('permission.update') }}",
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
            $('.fetchdata').DataTable().ajax.reload();
            }
            setTimeout(function(){
                $("#action_button").css("display","block");
                $("#action_buttonone").css("display","none");
            }, 3000);
            }
        });
        }   
        });
        $(document).on('click', '.edit', function(){
            $('#permissionname').val('');
            $('#displayname').val('');
            $('#description').val('');
            var id = $(this).attr('id');
            $('#form_result').html('');
            $.ajax({
            url:"/admin/permission/"+id+"/edit",
            dataType:"json",
            success:function(html){
                $('#permissionname').val(html.data.name);
                $('#displayname').val(html.data.display_name);
                $('#description').val(html.data.description);
                $('#hidden_id').val(html.data.id);
                $('.modal-title').text("Edit New Record");
                $('#action_button').val("Edit");
                $('#action').val("Edit");
                $('#formModal').modal('show');
            }
            })
            });
            var permission_id;

            $(document).on('click', '.delete', function(){
            permission_id = $(this).attr('id');
            $('#ok_button').text('Ok');
            $('#confirmModal').modal('show');
            });

            $('#ok_button').click(function(){
            $.ajax({
            url:"/admin/permission/destroy/"+permission_id,
            beforeSend:function(){
                $("#ok_button").css("display","none")
                $("#ok_button1").css("display","block")
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