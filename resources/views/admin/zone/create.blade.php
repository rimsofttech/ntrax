@extends('layouts.master')

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
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Pages</a></li>
                                            <li class="breadcrumb-item active">Starter</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Starter</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                    <form action="{{route('zone.store')}}" method="post">
                                        {{csrf_field()}}
                                        <div class="row">
                                            <div class="col-md-3">
                                                <input type="text" class="form-control" name="zonename" id="" placeholder="Enter ZoneName">
                                                <small id="helpId" class="text-muted">Enter Zone Name <span class="red" style="color:red;font-size:12px">*</span></small>
                                            </div>

                                            <div class="col-md-3">
                                                <select class="form-control select2-multiple country-select2" data-toggle="select2" data-placeholder="Choose Country..." name="country_name[]" id="country_name">
                                                </select>
                                            </div>

                                            <div class="col-md-3">
                                                <select class="form-control select2-multiple state-select2" data-toggle="select2" multiple="multiple" data-placeholder="Choose State..." name="state_name[]" id="state_name">
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <select class="form-control select2-multiple city-select2" data-toggle="select2" multiple="multiple" data-placeholder="Choose City..." name="city_name[]" id="city_name">
                                                </select>
                                            </div>
                                           <div class="col-md-3">
                                                <button type="submit" class="btn btn-outline-success btn-rounded waves-effect waves-light">Save</button>
                                           </div>
                                        </div> 
                                    </form>

                                    </div> 
                                </div> 
                            </div> 
                        </div> 
                        
                    </div> <!-- container -->

@endsection
@section('script')
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
  @endsection