
<footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                2022&copy; LaxmiPriya by <a href="">TechRil</a>
                            </div>

                        </div>
                    </div>
</footer>
				<script src="{{ asset('js/vendor.min.js') }}"></script>

        <!-- App js -->
		<script src="{{ asset('libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
        <script src="{{  asset('libs/flatpickr/flatpickr.min.js') }}"></script>

        <!-- Init js-->
        {{-- <script src="{{  asset('js/pages/form-pickers.init.js') }}"></script> --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
        <script src="{{ asset('libs/jquery-lazyload/lazyload.js')}}"></script>
        <script src="{{ asset('libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
        <script src="{{ asset('libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
        <script src="{{ asset('libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>
        <script src="{{ asset('libs/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
        <script src="{{ asset('libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js')}}"></script>
        <script src="{{ asset('libs/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
        <script src="{{ asset('libs/datatables.net-buttons/js/buttons.flash.min.js')}}"></script>
        <script src="{{ asset('libs/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
        <script src="{{ asset('libs/datatables.net-keytable/js/dataTables.keyTable.min.js')}}"></script>
        <script src="{{ asset('libs/datatables.net-select/js/dataTables.select.min.js')}}"></script>
        <script src="{{ asset('js/pages/datatables.init.js')}}"></script>
		<script src="{{ asset('js/app.min.js') }}"></script>

        <script type="text/javascript">
           $(document).ready(function(){
             setTimeout(function()
             {
               $('div.alert').remove();
             },3000);
           });
        </script>

    </body>
</html>
