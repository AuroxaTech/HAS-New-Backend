<!DOCTYPE html>
<html lang="en">

<head>
    @include('../layouts.components.header')
</head>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        @include('../layouts.components.nav')
        <!-- /.navbar -->
        <!-- Main Sidebar Container -->
        @include('../layouts.components.sidebar')
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            
            <!-- Content Header (Page header) -->
            @yield('contents')
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        @include('../layouts/components/footer')

    </div>
    <!-- ./wrapper -->
    <!-- jQuery -->
    @include('../layouts/components/scriptpart')

</body>

</html>