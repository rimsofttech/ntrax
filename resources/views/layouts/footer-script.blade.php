        <!-- Vendor js -->
        <script src="{{ URL::asset('assets/js/vendor.min.js')}}"></script>

        @yield('script')
        <script src="{{ URL::asset('assets/libs/jquery-nice-select/jquery-nice-select.min.js')}}"></script>
        <script src="{{ URL::asset('assets/libs/switchery/switchery.min.js')}}"></script>
        <script src="{{ URL::asset('assets/libs/multiselect/multiselect.min.js')}}"></script>
        <script src="{{ URL::asset('assets/libs/select2/select2.min.js')}}"></script>
        {{-- <script src="{{ URL::asset('assets/libs/jquery-mockjax/jquery-mockjax.min.js')}}"></script> --}}
        <script src="{{ URL::asset('assets/libs/autocomplete/autocomplete.min.js')}}"></script>
        <script src="{{ URL::asset('assets/libs/bootstrap-select/bootstrap-select.min.js')}}"></script>
        <script src="{{ URL::asset('assets/libs/bootstrap-touchspin/bootstrap-touchspin.min.js')}}"></script>
        <script src="{{ URL::asset('assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js')}}"></script>
        <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
        
        <!-- Init js-->
        <script src="{{ URL::asset('assets/js/pages/form-advanced.init.js')}}"></script>
        <!-- App js -->
        <script src="{{ URL::asset('assets/js/app.min.js')}}"></script>
        
        @yield('script-bottom')