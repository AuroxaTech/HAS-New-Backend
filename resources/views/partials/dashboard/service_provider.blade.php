@extends('../layouts.main')
@section('contents')
<section class="content-header">
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Service Providers</h1>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="container-fluid">
        <div class="card">
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th width="60">ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Image</th>
                            <th width="100">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->full_name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->phone_number }}</td>
                                <td>
                                    <img src="{{ asset($item->profile_image) }}" alt="Profile Image" width="50" height="50">
                                </td>
                                <td>
                                    <a href="{{route('admin.services', $item->id)}}" title="View Details">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    @if($item->approved_at == 0)
                                    <a href="{{route('approve.service_provider', $item->id)}}" class="btn btn-success">Approve</a>
                                    @elseif($item->approved_at == 1)
                                    <p>Approved</p>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- /.card -->
</section>
@endsection