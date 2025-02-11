@extends('layouts.main')

@section('contents')
<section class="content-header">
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Tenants</h1>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            @foreach ($data as $tenant)
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title">{{ $tenant->user->name }}</h5>
                    </div>
                    <div class="card-body">
                        <p><strong>Last Status:</strong> {{ $tenant->last_status }}</p>
                        <p><strong>Occupation:</strong> {{ $tenant->occupation }}</p>
                        <p><strong>Leased Duration:</strong> {{ $tenant->leased_duration }}</p>
                        <p><strong>Last Tenancy:</strong> {{ $tenant->last_tenancy }}</p>
                        <p><strong>Landlord Name:</strong> {{ $tenant->last_landlord_name }}</p>
                        <p><strong>Landlord Contact:</strong> {{ $tenant->last_landlord_contact }}</p>
                        <p><strong>No. of Occupants:</strong> {{ $tenant->no_of_occupants }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
