
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function fetchData() {
        $.ajax({
            dataType: "json",
            url: "{{ route('admin.view') }}",
            success: function (response) {
                var table = $('#table-pegawai').DataTable();
                table.clear().draw();
                if (response.data && response.data.length > 0) {
                    $.each(response.data, function (index, user) {
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
            error: function (jqXHR, textStatus, errorThrown) {
                console.error("AJAX request failed: " + textStatus + ', ' + errorThrown);
            }
        });
    }

    $('#table-pegawai').DataTable();

    fetchData();

    // Handle button actions
    $('#table-pegawai tbody').on('click', 'button', function () {
        var action = $(this).data('action');
        var id = $(this).data('id');

        if (action === 'detail') {
            $.ajax({
                type: "GET",
                url: "{{ url('Admin/user') }}/" + id,
                success: function (response) {
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
                success: function (response) {
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
                    success: function (response) {
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
    $('#createForm').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "{{ route('admin.user.store') }}",
            data: $(this).serialize(),
            success: function (response) {
                alert(response.message);
                $('#createModal').modal('hide'); // Sembunyikan modal setelah sukses
                fetchData(); // Ambil data kembali setelah berhasil menyimpan
            }
        });
    });

    // Form submission for editing user
    $('#userForm').on('submit', function (e) {
        e.preventDefault();
        var id = $('#userId').val();
        $.ajax({
            type: "PUT",
            url: "{{ url('Admin/user') }}/" + id,
            data: $(this).serialize(),
            success: function (response) {
                alert(response.message);
                $('#formModal').modal('hide');
                fetchData(); // Ambil data kembali setelah berhasil mengedit
            }
        });
    });
});
