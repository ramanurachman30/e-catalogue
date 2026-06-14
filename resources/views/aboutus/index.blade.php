<x-app-layout>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="card-title">About Us Data</h4>
                        @if($data->count() == 0)
                        <a href="{{ route('aboutus.create') }}" class="btn btn-primary btn-icon-text">
                            <i class="ti-plus btn-icon-prepend"></i>
                            Add New Data
                        </a>
                        @endif
                    </div>
                    <div class="table-responsive">
                        <table id="aboutUsTable" class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Sub Title</th>
                                    <th>Description</th>
                                    <th>Image</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ $item->sub_title }}</td>
                                    <td>{!! Str::limit($item->description, 20) !!}</td>
                                    <td>
                                        @if($item->image)
                                            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" style="width: 50px; height: 50px; border-radius: 5px;">
                                        @else
                                            <span class="badge badge-secondary">No Image</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('aboutus.edit', $item->id) }}" class="btn btn-warning btn-sm me-2" title="Edit">
                                                <i class="mdi mdi-pencil"></i>
                                            </a>
                                            <form id="delete-form-{{ $item->id }}" action="{{ route('aboutus.destroy', $item->id) }}" method="POST" class="d-inline">
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
        /* Custom SweetAlert Style */
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
            // Initialize DataTable
            $('#aboutUsTable').DataTable({
                "pageLength": 10,
                "ordering": true,
                "info": true,
                "language": {
                    "search": "Search:",
                    "lengthMenu": "Show _MENU_ entries",
                    "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                    "paginate": {
                        "first": "First",
                        "last": "Last",
                        "next": "Next",
                        "previous": "Previous"
                    }
                }
            });

            // SweetAlert Delete Confirmation
            $('.btn-delete').on('click', function() {
                const id = $(this).data('id');
                const form = $('#delete-form-' + id);

                Swal.fire({
                    title: 'Are you sure?',
                    text: "This data will be permanently deleted!",
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
