<!-- jQuery -->
<script src="{{ asset('backend/plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('backend/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('backend/plugins/chart.js/Chart.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('backend/plugins/sparklines/sparkline.js') }}"></script>
<!-- JQVMap -->
<script src="{{ asset('backend/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('backend/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('backend/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('backend/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('backend/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('backend/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('backend/plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('backend/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('backend/dist/js/adminlte.js') }}"></script>

<script src="{{ asset('backend/dist/js/html5-qrcode.min.js') }}"></script>
<script src="{{asset('js/app.js')}}"></script>

<script>
  $(function () {
    $('#summernote').summernote()
  })
</script>

<!-- Select2 -->
<script src="{{ asset('backend/plugins/select2/js/select2.full.min.js') }}"></script>
<script>
  $(function () {
    // Initialize Select2 Elements with Bootstrap 4 theme
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    });
  });
</script>


<script>
  $(function(){
      $('.select2').select2({
        theme: 'bootstrap4'
      });
      $('#select-all-btn').on('click', function() {
            $('.select2').val($('.select2').children().map(function() {
                return $(this).val();
            }).get());

            $('.select2').trigger('change'); 
      });
      $('#deselect-all-btn').on('click', function() {
            $('.select2').val(null);
            $('.select2').trigger('change'); 
      });
  })
</script>

<!-- Toastr -->
<script src="{{ asset('backend/plugins/toastr/toastr.min.js') }}"></script>
@if (Session::has('success'))
<script>
    toastr.options = {
        "progressBar": true,
        "closeButton": true,
    }
    toastr.success("{{ Session::get('success') }}");
</script>
@endif

@if (!empty($errors->all()))
<script>
    @foreach($errors -> all() as $error)
    toastr.error("{{ $error }}")
    @endforeach
</script>
@endif

@if (Session::has('error'))
<script>
    toastr.options = {
        "progressBar": true,
        "closeButton": true,
    }
    toastr.error("{{ Session::get('error') }}");
</script>
@endif

<!-- Sweetalert2 -->
<script src="{{ asset('backend/dist/js/sweetalert.min.js') }}"></script>
<script>
  $('.delete-confirmation').click(function(event) {
       var form =  $(this).closest("form");
       var name = $(this).data("name");
       event.preventDefault();
       swal({
           title: `Are you sure you want to delete this record?`,
           text: "You will not be able to revert this!",
           icon: "warning",
           buttons: true,
           dangerMode: true,
       })
       .then((willDelete) => {
         if (willDelete) {
           form.submit();
         }
       });
   });

   $('#start-reservationdate').datetimepicker({
        format: 'YYYY-MM-DD'
  });

  $('#end-reservationdate').datetimepicker({
        format: 'YYYY-MM-DD'
  });
</script>

@stack('child-scripts')