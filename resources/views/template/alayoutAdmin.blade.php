<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>
        LANDSCAMPING.ID
    </title>
    <link rel="icon" href="/templateview/assets/images/logolandscape.png" sizes="60x60" type="image/png">


    <!-- Favicon -->
    <link rel="shortcut icon" href="https://www.trafoindonesia.com/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="/templateview/assets/css/backend-plugin.min.css">
    <link rel="stylesheet" href="/templateview/assets/css/backend.css?v=1.0.0">
    <link rel="stylesheet" href="/templateview/assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css">
    <link rel="stylesheet" href="/templateview/assets/vendor/remixicon/fonts/remixicon.css">

    <link rel="stylesheet" href="/templateview/assets/vendor/tui-calendar/tui-calendar/dist/tui-calendar.css">
    <link rel="stylesheet" href="/templateview/assets/vendor/tui-calendar/tui-date-picker/dist/tui-date-picker.css">
    <link rel="stylesheet" href="/templateview/assets/vendor/tui-calendar/tui-time-picker/dist/tui-time-picker.css">

    <!-- icon  -->
    <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="path/to/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">


</head>

<body class="  ">
    <!-- loader Start -->
    <div id="loading">
        <!-- Menggunakan gambar sebagai latar belakang loader -->
        <div id="loading-center" style="background-image: url('/templateview/assets/images/logolandscape.png');">
        </div>
    </div>
    <!-- loader END -->
    <!-- Wrapper Start -->
    <div class="wrapper">

        <!-- sidebar & navbar  -->
        @yield('sidebar')
        @yield('navbar')


        <!-- start content  -->
        <div class="content-page px-4">
            <div class="container-fluid ">
                <div class="row">

                    @yield('content')
                </div>
            </div>
        </div>
        <!-- end content  -->
    </div>
    <!-- Wrapper End-->


    <!-- footer -->
    @yield('footer')

    <!-- Backend Bundle JavaScript -->
    <script src="/templateview/assets/js/backend-bundle.min.js"></script>

    <!-- Table Treeview JavaScript -->
    <script src="/templateview/assets/js/table-treeview.js"></script>

    <!-- Chart Custom JavaScript -->
    <script src="/templateview/assets/js/customizer.js"></script>

    <!-- Chart Custom JavaScript -->
    <script async src="/templateview/assets/js/chart-custom.js"></script>
    <!-- Chart Custom JavaScript -->
    <script async src="/templateview/assets/js/slider.js"></script>

    <!-- app JavaScript -->
    <script src="/templateview/assets/js/app.js"></script>

    <script src="/templateview/assets/vendor/moment.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

</body>

</html>