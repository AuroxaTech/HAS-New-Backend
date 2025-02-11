@extends('layouts.main')

@section('contents')
<section class="content-header">
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Services</h1>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            @foreach ($data as $service)
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title">{{ $service->service_name }},</h5>
                        <p class="text-muted">{{ $service->city }}, {{ $service->country }}</p>
                    </div>
                    <div class="card-body">
                        <p><strong>Description:</strong> {{ $service->description }}</p>
                        <p><strong>Pricing:</strong> ${{ number_format($service->pricing, 2) }}</p>
                        <p><strong>Duration:</strong> {{ $service->duration }} hours</p>
                        <p><strong>Start Time:</strong> {{ $service->start_time }}</p>
                        <p><strong>End Time:</strong> {{ $service->end_time }}</p>
                        <p><strong>Location:</strong> {{ $service->location }}</p>

                
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
