@extends('../layouts.main')
@section('contents')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Dashboard</h1>
            </div>
            <div class="col-sm-6">

            </div>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="container-fluid">
        <div class="row">
            <!-- Total Users -->
            <div class="col-lg-3 col-6">
                <div class="small-box card">
                    <div class="inner">
                        <h3>{{ $totalUsers }}</h3>
                        <p>Total Users</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person"></i>
                    </div>
                </div>
            </div>

            <!-- Total Landlords -->
            <div class="col-lg-3 col-6">
                <div class="small-box card">
                    <div class="inner">
                        <h3>{{ $totalLandlords }}</h3>
                        <p>Total Landlords</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-home"></i>
                    </div>
                </div>
            </div>

            <!-- Total Tenants -->
            <div class="col-lg-3 col-6">
                <div class="small-box card">
                    <div class="inner">
                        <h3>{{ $totalTenants }}</h3>
                        <p>Total Tenants</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-stalker"></i>
                    </div>
                </div>
            </div>

            <!-- Total Visitors -->
            <div class="col-lg-3 col-6">
                <div class="small-box card">
                    <div class="inner">
                        <h3>{{ $totalServiceProviders }}</h3>
                        <p>Total Service Providers</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-eye"></i>
                    </div>
                </div>
            </div>

            <!-- Total Visitors -->
            <div class="col-lg-3 col-6">
                <div class="small-box card">
                    <div class="inner">
                        <h3>{{ $totalVisitors }}</h3>
                        <p>Total Visitors</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-eye"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
