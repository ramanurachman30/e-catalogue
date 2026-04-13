<x-app-layout>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="card-title">Events Data</h4>
                        <a href="{{ route('events.create') }}" class="btn btn-primary btn-icon-text">
                            <i class="ti-plus btn-icon-prepend"></i>
                            Add New Event
                        </a>
                    </div>
                    <div class="table-responsive">
                        <table id="eventsTable" class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Date</th>
                                    <th>Location</th>
                                    <th>Image</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="font-weight-bold">{{ $item->name }}</div>
                                        <small class="text-muted">{{ Str::limit($item->description, 30) }}</small>
                                    </td>
                                    <td>
                                        <div>{{ \Carbon\Carbon::parse($item->start_date)->format('d M Y') }}</div>
                                        @if($item->start_date != $item->end_date)
                                            <small class="text-muted">until {{ \Carbon\Carbon::parse($item->end_date)->format('d M Y') }}</small>
                                        @endif
                                    </td>
                                    <td>{{ $item->location }}</td>
                                    <td>
                                        @if($item->image)
                                            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}" style="width: 50px; height: 50px; border-radius: 5px;">
                                        @else
                                            <span class="badge badge-secondary">No Image</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('events.edit', $item->id) }}" class="btn btn-warning btn-sm me-2" title="Edit">
                                                <i class="mdi mdi-pencil"></i>
                                            </a>
                                            <form id="delete-form-{{ $item->id }}" action="{{ route('events.destroy', $item->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger btn-sm btn-delete" data-id="{{ $item->id }}" title="Delete">
                                                    <i class="mdi mdi-trash-can"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $data->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
    <link rel="stylesheet" href="{{ asset('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <style>
        .table img {
            object-fit: cover;
        }
        .dataTables_wrapper .dataTable thead th {
            border-bottom: 0;
            padding-top: 15px;
            padding-bottom: 15px;
        }
        .dataTables_wrapper .dataTable tbody td {
            padding-top: 15px;
            padding-bottom: 15px;
        }
        .swal2-popup {
            font-family: 'Nunito', sans-serif;
            border-radius: 15px;
        }
    </style>
    @endpush

    @push('scripts')
    <script src="{{ asset('assets/vendors/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('#eventsTable').DataTable({
                "pageLength": 10,
                "ordering": true,
                "info": true,
                "paging": false, // Handled by Laravel pagination
                "language": {
                    "search": "Search:",
                }
            });

            $('.btn-delete').on('click', function() {
                const id = $(this).data('id');
                const form = $('#delete-form-' + id);

                Swal.fire({
                    title: 'Are you sure?',
                    text: "This event will be permanently deleted!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#ef5350',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
    @endpush
</x-app-layout>
