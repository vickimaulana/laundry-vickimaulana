<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>{{ $title }}</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  @include('inc.css')

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  @include('inc.header')
  <!-- End Header -->

  <!-- ======= Sidebar ======= -->
  @include('inc.sidebar')
  <!-- End Sidebar-->

  <main id="main" class="main">

    <section class="section">
      @yield('content')
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  @include('inc.footer')
  <!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  @include('inc.js')
  @include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@11"])

<script>
    function confirmAndDelete(userId) {
        Swal.fire({
            title: 'Are you Sure?',
            text: "This action cannot be undone!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.getElementById(`delete-form-${userId}`);
                if (form) {
                    form.submit();
                }
            }
        });
    }

    //   document.getElementById('id_customer').addEventListener('change', function(){
    //         const selectedOption = .options[this.selectedIndex];
    //         const phone = this.options[this.selectedIndex].getAttribute('data-phone');
    //         const address = this.options[this.selectedIndex].getAttribute('data-address');

    //         document.getElementById('customerPhone').value = phone;
    //         document.getElementById('customerAddress').value = address;
    //   });
</script>

</body>

</html>
