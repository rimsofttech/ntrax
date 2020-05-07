@extends('layouts.master')

@section('css')
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- third party css -->
        <link href="{{ URL::asset('assets/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- third party css end -->
        <link href="{{ URL::asset('assets/libs/custombox/custombox.min.css')}}" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
        <title>Ntrax - SubSubProduct</title>
        <link href="{{ URL::asset('assets/libs/jquery-toast/jquery-toast.min.css')}}" rel="stylesheet" type="text/css" />
        <style>
            .floatRight {
            float: right;
            margin-left:10px;
            }
        </style>

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
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">SubSubProduct</a></li>
                                            {{-- <li class="breadcrumb-item active">Datatables</li> --}}
                                        </ol>
                                    </div>
                                    <h4 class="page-title">SubSubProduct Master</h4>
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
                                                @php  
                                                $createsubsubproduct = ''; 
                                                $createtext = '';
                                                if(!Entrust::can('Create SubSubProduct'))
                                                {
                                                    $createsubsubproduct = ''; 
                                                    $createtext = 'You dont Have permission To Create';
                                                }
                                            @endphp
                                                {{-- <button type="button" class="btn btn-primary" data-toggle="modal"  name="create_record" id="create_record">
                                                    <i class="mdi mdi-plus-circle mr-1"></i> Add Channel Partner
                                                  </button> --}}
                                            </div>
                                        </div>
                                        <div class="row">&nbsp;</div>
                                        <table  class="table table-striped nowrap fetchdata" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>Sr No.</th>
                                                    <th>SubProduct Name</th>
                                                    <th>SubSubProduct Name</th>
                                                    <th>Rate</th>
                                                    <th>Margin</th>
                                                    <th>Max Discount</th>
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
                              <h5 class="modal-title" id="ModalLongTitle">Add New Partner Channel</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                                <span id="form_result"></span>
                                <form method="post" id="subsubproduct_form" class="form-horizontal" enctype="multipart/form-data">
                                        @csrf
                                    <div class="alert alert-success d-none" id="msg_div">
                                          <span id="res_message"></span>
                                     </div>
                                     <div class="form-group">
                                        <label for="channeltype">Select SubProduct Name</label>
                                        <select class="form-control"  data-placeholder="Choose SubProduct Name..." id="subproduct_name" name="subproduct_name" style="width:100%">
                                        
                                      </select>
                                    </div>
                                  <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control" id="name" placeholder="Please enter name">
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                  </div>
                                  <div class="form-group">
                                    <label for="name">Rate</label>
                                    <input type="text" name="rate" class="form-control" id="rate" placeholder="Please Enter Rate">
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                  </div>
                                  <div class="form-group">
                                    <label for="name">Margin</label>
                                    <input type="text" name="margin" class="form-control" id="margin" placeholder="Please Enter Margin">
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                  </div>
                                  <div class="form-group">
                                    <label for="name">Max Discount</label>
                                    <input type="text" name="discount" class="form-control" id="discount" placeholder="Please Enter Max Discount">
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
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
            $("#subproduct_name").select2({
            ajax: {
                url: function (params) {
                    return "{{route('search.subproduct')}}";
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
    });
        </script>
         <script>
            $(document).ready(function(){
                var datatable = '';
         var reportdatatable =   "{{ Entrust::can('Reporting Zone') ? 'true' : 'false' }}";
         var addsubsubproductcheck = "{{ Entrust::can('Create SubSubProduct') ? 'true' : 'false' }}";
         datatable = $('.fetchdata').DataTable({
          processing: true,
          serverSide: true,
          bDestroy: true,
          scrollX: true,
          ajax:{
           url: "{{ route('subsubproduct.index') }}",
          },
        //   data: data,
          columns:[
            {
                data:'DT_RowIndex',
                name:'DT_RowIndex'

            },
            {
                data : 'subproduct_id',
                name : 'subproduct_id'
           },
            {
                data : 'name',
                name : 'name'
           },
            {
                data : 'rate',
                name : 'rate'
           },
            {
                data : 'margin',
                name : 'margin'
           },
            {
                data : 'max_discount',
                name : 'max_discount'
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
                {
                text: '<i class="fas fa-sync-alt"></i>',
                className:'btn btn-info',
                attr:{
                    title:'Reload Data'
                },
                action: function () {
                    datatable.ajax.reload();
                },
                
            },
            ],
        "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
         });
         if ( reportdatatable != 'false') {
            datatable.button().add(null, {extend: ['copy'],className:'btn btn-warning',text:'<i class="fe-copy"></i>',attr:{title:'Copy'}});
            datatable.button().add(null, {extend: ['csv'],className:'btn btn-success',text:'<i class="fas fa-file-csv"></i>',attr:{title:'Generate CSV'}});
            datatable.button().add(null, {extend: ['excel'],className:'btn btn-primary',text:'<i class=" mdi mdi-file-excel"></i>',attr:{title:'Generate Excel'}});
            datatable.button().add(null, {extend: ['print'],className:'btn btn-pink',text:'<i class="mdi mdi-printer"></i>',attr:{title:'Print'}});
            datatable.button().add(null, {extend: ['pdf'],className:'btn btn-danger',text:'<i class="mdi mdi-file-pdf"></i>',attr:{title:'Generate PDF'}});
        }
        var erroraddcheck = '';
        if(addsubsubproductcheck!='true')
        {
            erroraddcheck = 'You do not have proper permission to Create Record';
        }
        datatable.button().add(null, {className:'btn btn-danger',text:'<i class="mdi mdi-plus-circle mr-1"></i> Add SubSubProduct',className:'btn btn-success floatRight align-right',attr:{title:erroraddcheck,id:'create_record'}});
         $('#create_record').click(function(){
            var createsubsubproduct = "{{Entrust::can('Create SubProduct')? true : false }}";
                if(createsubsubproduct != true)
                {
                    unauthorized();
                    return false;
                }
            
            $('#subproduct_name option[value=""]').attr('selected', true);
            $('#name').val('');
            $('#rate').val('');
            $('#margin').val('');
            $('#discount').val('');
            $('.modal-title').text("Add New Record");
            $('#action_button').val("Add");
            $('#action').val("Add");
            $('#formModal').modal('show');
        });
        $('#subsubproduct_form').on('submit', function(event){
            event.preventDefault();
            if($('#action').val() == 'Add')
            {
            $.ajax({
                url:"{{ route('subsubproduct.store') }}",
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
                if(data.success)
                {
                    toastr.success(''+data.success+'','Success',{
                    closeButton:true,
                    progressBar:true,
                });
                $('#subsubproduct_form')[0].reset();
                $('.fetchdata').DataTable().ajax.reload();
                $('#product_name option[value=""]').attr('selected', true);
                $('#name').val('');
                $('#rate').val('');
                $('#margin').val('');
                $('#discount').val('');
                }
                setTimeout(function(){
                $("#action_button").css("display","block");
                $("#action_buttonone").css("display","none");
                }, 3000);
                },error: function (jqXHR, exception) {
                setTimeout(function(){
                $("#action_button").css("display","block");
                $("#action_buttonone").css("display","none");
                }, 3000);
                 var msg = '';
                if (jqXHR.status === 0) {
                    msg = 'Not connect.\n Verify Network.';
                } else if (exception === 'timeout') {
                    msg = 'Time out error.';
                }
                else if (jqXHR.status == 403){
                    unauthorized();
                    return false;
                }
                 else if(jqXHR.responseJSON.errors){
                    $.each(jqXHR.responseJSON.errors, function(key, val) {
                        toastr.error(''+val+'','Error',{
                        closeButton:true,
                        progressBar:true,
                        });
                    });
                    return false;
                }
                else{
                    msg = "Something Went Wrong please try agian, Or Reload page and try";
                    
                }
                $.NotificationApp.send(msg,"Yes! check this <a href='https://github.com/kamranahmedse/jquery-toast-plugin/commits/master'>To Report Error</a>.",'top-right', '#bf441d', 'error', 8000, 100, 'fade');
                
            }
            })
            }
            if($('#action').val() == "Edit")
        {
           
        $.ajax({
            url:"{{ route('subsubproduct.update') }}",
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
            datatable.ajax.reload();
            // $('#channelpartner_form')[0].reset();
            //$('.fetchdata').DataTable().ajax.reload();
            }
            setTimeout(function(){
            $("#action_button").css("display","block");
            $("#action_buttonone").css("display","none");
            // $('#formModal').modal('hide');
                }, 3000);
            },error: function (jqXHR, exception) {
                setTimeout(function(){
                $("#action_button").css("display","block");
                $("#action_buttonone").css("display","none");
                }, 3000);
                 var msg = '';
                if (jqXHR.status === 0) {
                    msg = 'Not connect.\n Verify Network.';
                } else if (exception === 'timeout') {
                    msg = 'Time out error.';
                }
                else if (jqXHR.status == 403){
                    unauthorized();
                    return false;
                }
                 else if(jqXHR.responseJSON.errors){
                    $.each(jqXHR.responseJSON.errors, function(key, val) {
                        toastr.error(''+val+'','Error',{
                        closeButton:true,
                        progressBar:true,
                        });
                    });
                    return false;
                }
                else{
                    msg = "Something Went Wrong please try agian, Or Reload page and try";
                    
                }
                $.NotificationApp.send(msg,"Yes! check this <a href='https://github.com/kamranahmedse/jquery-toast-plugin/commits/master'>To Report Error</a>.",'top-right', '#bf441d', 'error', 8000, 100, 'fade');
                
            }
        });
        }   
        });
        $(document).on('click', '.edit', function(){
            var editsubproduct = "{{Entrust::can('Edit SubSubProduct')? true : false }}";
                if(editsubproduct != true)
                {
                    unauthorized();
                    return false;

                }
            $("#subproduct_name option:selected").attr('selected',false).trigger('change');
            $('#name').val('');
            $('#rate').val('');
            $('#margin').val('');
            $('#discount').val('');
            
            var id = $(this).attr('id');
            $('#form_result').html('');
            $.ajax({
            url:"/admin/subsubproduct/"+id+"/edit",
            dataType:"json",
            success:function(html){
                //console.log(html);
                $('#subproduct_name').append("<option value="+html.data.subproduct_id+" selected>"+html.data.subproductname+"</option>").trigger('change');
                $('#name').val(html.data.name);
                $('#rate').val(html.data.rate);
                $('#margin').val(html.data.margin);
                $('#discount').val(html.data.max_discount);
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
                var deletesubproduct = "{{Entrust::can('Delete SubSubProduct')? true : false }}";
                if(deletesubproduct != true)
                {
                    unauthorized();
                    return false;
                }
            subproduct_id = $(this).attr('id');
            $('#ok_button').text('Ok');
            $("#ok_button").css("display","block");
            $("#ok_button1").css("display","none");
            $('#confirmModal').modal('show');
            });

            $('#ok_button').click(function(){
            $.ajax({
            url:"/admin/subsubproduct/destroy/"+subproduct_id,
            beforeSend:function(){
                $("#ok_button").css("display","none");
                $("#ok_button1").css("display","block");
                $('#ok_button').text('Deleting...');
            },
            success:function(data)
            {
                if(data.errors)
            {
                toastr.error(''+data.errors+'','Warning',{
                closeButton:true,
                progressBar:true,
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
            },error: function (jqXHR, exception) {
                $('#confirmModal').modal('hide');
                var msg = '';
                if (jqXHR.status === 0) {
                    msg = 'Not connect.\n Verify Network.';
                } else if (exception === 'timeout') {
                    msg = 'Time out error.';
                }
                else if (jqXHR.status == 403){
                    unauthorized();
                    return false;
                }
                else{
                    msg = "Something Went Wrong please try agian, Or Reload page and try";
                    
                }
                $.NotificationApp.send(msg,"Yes! check this <a href='https://github.com/kamranahmedse/jquery-toast-plugin/commits/master'>To Report Error</a>.",'top-right', '#bf441d', 'error', 8000, 100, 'fade');
            }
            })
            });
            function unauthorized()
            {
                $.NotificationApp.send("You Are not unauthorized to do this action.", "Yes! check this <a href='https://github.com/kamranahmedse/jquery-toast-plugin/commits/master'>To Request For Approval</a>.",'top-right', '#bf441d', 'error', 8000, 100, 'fade');
            }
        });
        </script>
      <script src="{{ URL::asset('assets/libs/jquery-toast/jquery-toast.min.js')}}"></script>

      <!-- toastr init js-->
      <script src="{{ URL::asset('assets/js/pages/toastr.init.js')}}"></script>
 <script src="{{ URL::asset('assets/libs/custombox/custombox.min.js')}}"></script>

@endsection