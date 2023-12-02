<script defer src="{{ asset('assets/js/dataTables.bootstrap5.min.js') }}"></script>


<script>
    $(document).ready(function() {
        var message = $('#message');
        if (message.length) {
            message.fadeIn(500);
            setTimeout(function() {
                message.fadeOut(500);
            }, 3000); // Change the duration (in milliseconds) as needed
        }
    });
</script>

@livewireScripts
<script defer type="module" src="{{ asset('assets/js/module.js') }}"></script>

<!-- plugins:js -->
<script defer src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
<!-- endinject -->

<!-- Plugin js for this page -->
<script defer src="{{ asset('assets/vendors/chart.js/Chart.min.js') }}"></script>
<script defer src="{{ asset('assets/js/jquery.cookie.js') }}" type="text/javascript"></script>
<!-- End plugin js for this page -->

<!-- inject:js -->
<script defer src="{{ asset('assets/js/off-canvas.js') }}"></script>
<script defer src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
<script defer src="{{ asset('assets/js/misc.js') }}"></script>
<!-- endinject -->

<!-- Custom js for this page -->
<script defer src="{{ asset('assets/js/dashboard.js') }}"></script>
<script defer src="{{ asset('assets/js/todolist.js') }}"></script>
<script defer src="{{ asset('assets/js/chart.js') }}"></script>
<!-- End custom js for this page -->

<!-- jQuery -->
<script defer src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


</body>

</html>
