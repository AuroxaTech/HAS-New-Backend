@extends('layouts.main')

@section('contents')
<section class="content-header">
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Properties</h1>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            @foreach ($data as $property)
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title">{{ $property->type }} in {{ $property->city }}</h5>
                    </div>
                    <div class="card-body">
                        <p><strong>Address:</strong> {{ $property->address }}</p>
                        <p><strong>Price:</strong> ${{ number_format($property->amount, 2) }}</p>
                        <p><strong>Area:</strong> {{ $property->area_range }} sqft</p>
                        <p><strong>Bedrooms:</strong> {{ $property->bedroom }}</p>
                        <p><strong>Bathrooms:</strong> {{ $property->bathroom }}</p>
                        <p><strong>Description:</strong> {{ $property->description }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
