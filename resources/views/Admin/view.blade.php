@extends('_layouts.main')

@section('content')
    <div class="col-11 mx-auto mt-5 border overflow-hidden">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center p-4">
            <h1 class="fs-5 mb-3 mb-sm-0">Data Anggota</h1>
            <a href="#" class="btn btn-success align-self-end" data-action="create" data-bs-toggle="modal"
                data-bs-target="#createModal">
                <span>Tambah Anggota</span>
            </a>
        </div>
        {{-- Table --}}
        <div class="table-responsive px-3 pb-3">
            <table class="table table-hover mt-3" id="table-pegawai">
                <thead class="table-light border-top border-bottom">
                    <tr>
                        <th class="text-tertiary fw-semibold text-center px-3 text-nowrap">NO</th>
                        <th class="text-tertiary fw-semibold px-3 text-nowrap">Nama</th>
                        <th class="text-tertiary fw-semibold px-3 text-nowrap">Posisi</th>
                        <th class="text-tertiary fw-semibold px-3 text-nowrap">Perusahaan</th>
                        <th class="text-tertiary fw-semibold px-3 text-nowrap">No Handphone</th>
                        <th class="text-tertiary fw-semibold px-3 text-nowrap">Email</th>
                        <th class="text-tertiary fw-semibold text-center px-3 text-nowrap">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Data will be populated here by JavaScript -->
                </tbody>
            </table>
        </div>
    </div>


    <!-- Modals -->
    <!-- Detail Modal -->
    <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel">User Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- User details will be shown here -->
                    <div id="userDetails"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Create Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Tambah User Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="createForm">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama">
                        </div>
                        <div class="mb-3">
                            <label for="posisi" class="form-label">Posisi</label>
                            <input type="text" class="form-control" id="posisi" name="posisi">
                        </div>
                        <div class="mb-3">
                            <label for="perusahaan" class="form-label">Perusahaan</label>
                            <input type="text" class="form-control" id="perusahaan" name="perusahaan">
                        </div>
                        <div class="mb-3">
                            <label for="nomer_hp" class="form-label">No Handphone</label>
                            <input type="text" class="form-control" id="nomer_hp" name="nomer_hp">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModalLabel">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="userForm">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama_edit" name="nama">
                        </div>
                        <div class="mb-3">
                            <label for="posisi" class="form-label">Posisi</label>
                            <input type="text" class="form-control" id="posisi_edit" name="posisi">
                        </div>
                        <div class="mb-3">
                            <label for="perusahaan" class="form-label">Perusahaan</label>
                            <input type="text" class="form-control" id="perusahaan_edit" name="perusahaan">
                        </div>
                        <div class="mb-3">
                            <label for="nomer_hp" class="form-label">No Handphone</label>
                            <input type="text" class="form-control" id="nomer_hp_edit" name="nomer_hp">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email_edit" name="email">
                        </div>
                        <input type="hidden" id="userId">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
@endpush
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function fetchData() {
            $.ajax({
                dataType: "json",
                url: "{{ route('admin.view') }}",
                success: function(response) {
                    var table = $('#table-pegawai').DataTable();
                    table.clear().draw();
                    if (response.data && response.data.length > 0) {
                        $.each(response.data, function(index, user) {
                            table.row.add([
                                index + 1,
                                user.nama,
                                user.posisi,
                                user.perusahaan,
                                user.nomer_hp,
                                user.email,
                                '<button type="button" class="btn btn-outline-primary" data-action="detail" data-id="' +
                                user.id +
                                '" data-bs-toggle="modal" data-bs-target="#detailModal"><i class="bi bi-book-fill"></i> Detail</button> ' +
                                '<button type="button" class="btn btn-outline-secondary" data-action="edit" data-id="' +
                                user.id +
                                '" data-bs-toggle="modal" data-bs-target="#editModal"><i class="bi bi-pencil-fill"></i> Edit</button> ' +
                                '<button type="button" class="btn btn-outline-danger" data-action="delete" data-id="' +
                                user.id +
                                '"><i class="bi bi-trash"></i> Delete</button>'
                            ]).draw(false);
                        });
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error("AJAX request failed: " + textStatus + ', ' + errorThrown);
                }
            });
        }

        $('#table-pegawai').DataTable();

        fetchData();

        // Handle button actions
        $('#table-pegawai tbody').on('click', 'button', function() {
            var action = $(this).data('action');
            var id = $(this).data('id');

            if (action === 'detail') {
                $.ajax({
                    type: "GET",
                    url: "{{ url('Admin/user') }}/" + id,
                    success: function(response) {
                        if (response.data) {
                            $('#userDetails').html('<p>Nama: ' + response.data.nama +
                                '</p>' +
                                '<p>Posisi: ' + response.data.posisi + '</p>' +
                                '<p>Perusahaan: ' + response.data.perusahaan + '</p>' +
                                '<p>No Handphone: ' + response.data.nomer_hp + '</p>' +
                                '<p>Email: ' + response.data.email + '</p>');
                        }
                    }
                });
            }

            if (action === 'edit') {
                $.ajax({
                    type: "GET",
                    url: "{{ url('Admin/user') }}/" + id,
                    success: function(response) {
                        if (response.data) {
                            $('#userId').val(response.data.id);
                            $('#nama_edit').val(response.data.nama);
                            $('#posisi_edit').val(response.data.posisi);
                            $('#perusahaan_edit').val(response.data.perusahaan);
                            $('#nomer_hp_edit').val(response.data.nomer_hp);
                            $('#email_edit').val(response.data.email);
                            $('#formModalLabel').text(
                                'Edit User'); // Pastikan label modal sesuai
                            $('#formModal').modal('show'); // Tampilkan modal
                        }
                    }
                });
            }

            if (action === 'delete') {
                if (confirm('Are you sure you want to delete this user?')) {
                    $.ajax({
                        type: "DELETE",
                        url: "{{ url('Admin/user') }}/" + id,
                        success: function(response) {
                            alert(response.message);
                            fetchData();
                        }
                    });
                }
            }

            if (action === 'create') {
                $('#createForm')[0].reset(); // Reset form create
                $('#createModalLabel').text('Tambah User Baru'); // Pastikan label modal sesuai
                $('#createModal').modal('show'); // Tampilkan modal create
            }
        });

        // Form submission for creating user
        $('#createForm').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "{{ route('admin.user.store') }}",
                data: $(this).serialize(),
                success: function(response) {
                    alert(response.message);
                    $('#createModal').modal('hide'); // Sembunyikan modal setelah sukses
                    fetchData(); // Ambil data kembali setelah berhasil menyimpan
                }
            });
        });

        // Form submission for editing user
        $('#userForm').on('submit', function(e) {
            e.preventDefault();
            var id = $('#userId').val();
            $.ajax({
                type: "PUT",
                url: "{{ url('Admin/user') }}/" + id,
                data: $(this).serialize(),
                success: function(response) {
                    alert(response.message);
                    $('#formModal').modal('hide');
                    fetchData(); // Ambil data kembali setelah berhasil mengedit
                }
            });
        });
    });
</script>
