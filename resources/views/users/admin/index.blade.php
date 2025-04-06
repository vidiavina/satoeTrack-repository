@extends('layout.app')
@section('title', 'Kelola Admin')
@push('styles_top')
<style>
    #table-admin thead {
        background: linear-gradient(45deg, #07A4E3, #38C8F1);
        color: white;
    }

    .dt-column-title {
        margin-right: 1rem;
    }

    #table-admin>thead>tr>th {
        text-align: center;
        font-weight: bold;
        color: var(--white-color);
        background: #07A4E3;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .action-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 46px;
        height: 42px;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.2s;
        margin: 4px;
    }

    .edit-btn {
        background: linear-gradient(45deg, #07A4E3, #38C8F1);
        color: white;
    }

    .delete-btn {
        background: #ff4757;
        color: white;
    }

    .action-btn i {
        font-size: 22px;
    }

    .action-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    div.dt-container div.dt-layout-row div.dt-layout-cell.dt-layout-end .dt-search {
        display: none !important;
    }

    .search-container {
        background: white;
        border-radius: 28px;
        display: flex;
        align-items: center;
        padding: 0 16px;
        height: 56px;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
        margin: 20px 20px 0;
    }

    .search-container input {
        flex: 1;
        border: none;
        outline: none;
        padding: 12px;
        font-size: 16px;
    }

    .search-icon {
        color: #07A4E3;
        font-size: 22px;
    }

    .no-results {
        text-align: center;
        padding: 20px;
        color: #555;
        font-size: 16px;
    }

    /* Search highlight */
    .highlight {
        background-color: rgba(7, 164, 227, 0.2);
        padding: 2px;
        border-radius: 2px;
    }

    /* Search animation */
    @keyframes searchPulse {
        0% {
            box-shadow: 0 0 0 0 rgba(7, 164, 227, 0.4);
        }

        70% {
            box-shadow: 0 0 0 10px rgba(7, 164, 227, 0);
        }

        100% {
            box-shadow: 0 0 0 0 rgba(7, 164, 227, 0);
        }
    }

    .search-container.active {
        animation: searchPulse 1.5s infinite;
    }

    div.dt-container select.dt-input {
        border-radius: 8px;
        margin: 0 .5rem .5rem 0;
    }

    div.dt-container select.dt-input:focus-visible {
        outline: thin;
    }

    .form-label {
        margin-bottom: .25rem;
        font-weight: bold;
    }

    form label.required:after {
        content: " *";
        color: red;
        font-weight: bold;
    }


    @media (min-width: 992px) {

        #table-admin th,
        #table-admin td {
            padding: 16px;
        }

    }
</style>
@endpush

@section('content')
<section class="mt-3 pt-3">
    <div class="mb-4">
        <div class="card p-3">
            <div class="row">
                <div class="col-6 d-flex align-items-center">
                    <h1 class="fw-bold">Kelola Admin</h1>
                </div>
                <div class="col-6 d-flex-jend">
                    <button type="modal" data-bs-toggle="modal" data-bs-target="#tambahAdmin" class="btn btn-main column-gap-2">Tambah Admin <i class="bx bx-plus"></i></button>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="search-container">
            <input type="text" id="searchInput" placeholder="Search...">
            <i class="bx bx-search search-icon"></i>
        </div>
        <div class="table-responsive px-4 py-2">
            <table
                class="table data-table table-striped table-vcenter table-hover text-center align-middle rounded-3 overflow-hidden"
                style="border-radius: 8px" id="table-admin">
                <thead>
                    <tr>
                        <th scope="col" style="width: 5%">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col" style="width: 25%">Email</th>
                        <th scope="col">No. Telp</th>
                        <th scope="col">Role</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $no = 1;
                    @endphp
                    @foreach ($data as $datas)
                    <tr>
                        <td scope="row" class="text-center">{{ $no++ }}</td>
                        <td>{{ $datas->nama }}</td>
                        <td>{{ $datas->email }}</td>
                        <td class="text-center">{{ $datas->no_telp ?? '-' }}</td>
                        <td>
                            <span class="role-badge 
                                @if ($datas->role == 1) blue 
                                @elseif ($datas->role == 2) purple 
                                @elseif ($datas->role == 3) green 
                                @endif
                            ">

                                @if ($datas->role == 1)
                                Superadmin
                                @elseif ($datas->role == 2)
                                Admin TU
                                @elseif ($datas->role == 3)
                                Admin Jurusan
                                @else
                                Unknown Role
                                @endif
                            </span>
                        </td>
                        <td class="d-flex justify-content-center">
                            <div data-bs-toggle="modal" data-bs-target="#editAdmin" class="action-btn edit-btn" data-id="{{ $datas->id }}">
                                <i class="bx bx-edit"></i>
                            </div>
                            <div class="action-btn delete-btn" data-id="{{ $datas->id }}">
                                <i class="bx bx-trash"></i>
                            </div>
                        </td>
                    </tr>
                    @endforeach

                    <div id="noResults" class="no-results" style="display: none;">No matching records found! :(</div>
                </tbody>
            </table>
        </div>
    </div>

    <!-- tambah admin modal -->
    <div class="modal fade" id="tambahAdmin" tabindex="-1" aria-labelledby="tambahAdminLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fw-bold fs-5" id="tambahAdminLabel">Tambah Admin</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('simpan-admin') }}" method="post" id="form-tambah-admin">
                        @csrf
                        <div class="col">
                            <div class="mb-3">
                                <label for="tambah-nama-admin" class="form-label required">Nama</label>
                                <input
                                    type="text"
                                    name="nama"
                                    id="tambah-nama-admin"
                                    class="form-control"
                                    placeholder="Masukkan Nama"
                                    aria-describedby="helpId" required autofocus />
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="tambah-email-admin" class="form-label required">Email</label>
                                <input
                                    type="email"
                                    name="email"
                                    id="tambah-email-admin"
                                    class="form-control"
                                    placeholder="Masukkan Email"
                                    aria-describedby="helpId" required />
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="tambah-no_telp-admin" class="form-label">No. Telepon</label>
                                <input type="text"
                                    name="no_telp"
                                    id="tambah-no_telp-admin"
                                    class="form-control"
                                    placeholder="Masukkan Nomor Telepon"
                                    aria-describedby="helpId"
                                    onkeypress="return isNumber(event)"
                                    minlength="12"
                                    maxlength="15">
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="tambah-password-admin" class="form-label required">Password</label>
                                <input
                                    type="password"
                                    name="password"
                                    id="tambah-password-admin"
                                    class="form-control"
                                    placeholder="Masukkan Kata Sandi"
                                    minlength="8"
                                    aria-describedby="helpId" required />
                                <small id="helpId" class="text-muted">Password minimal berisi 8 karakter</small>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="tambah-role-admin" class="form-label required">Role</label>
                                <select name="role" id="tambah-role-admin" class="select2 w-100" aria-describedby="helpId" required>
                                    <option value="" selected hidden>Pilih Role</option>
                                    <option value="1">Superadmin</option>
                                    <option value="2">Admin TU</option>
                                    <option value="3">Admin Jurusan</option>
                                </select>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-main">Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- edit admin modal -->
    <div class="modal fade" id="editAdmin" tabindex="-1" aria-labelledby="editAdminLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fw-bold fs-5" id="editAdminLabel">Edit Admin</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form action="{{ isset($datas) ? route('update-admin', ['id' => $datas->first()->id]) : '#' }}" method="post" id="form-edit-admin">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id-admin" id="edit-id-admin">
                        <div class="col">
                            <div class="mb-3">
                                <label for="nama-admin" class="form-label required">Nama</label>
                                <input
                                    type="text"
                                    name="nama"
                                    id="edit-nama-admin"
                                    class="form-control"
                                    placeholder="Masukkan Nama"
                                    aria-describedby="helpId" required autofocus />
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="email-admin" class="form-label required">Email</label>
                                <input
                                    type="email"
                                    name="email"
                                    id="edit-email-admin"
                                    class="form-control"
                                    placeholder="Masukkan Email"
                                    aria-describedby="helpId" required />
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="no_telp-admin" class="form-label">No. Telepon</label>
                                <input type="text"
                                    name="no_telp"
                                    id="edit-no_telp-admin"
                                    class="form-control"
                                    placeholder="Masukkan Nomor Telepon"
                                    pattern="[0-9]{10,15}"
                                    aria-describedby="helpId"
                                    onkeypress="return isNumber(event)"
                                    minlength="12"
                                    maxlength="15">
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="password-admin" class="form-label">Password</label>
                                <input
                                    type="password"
                                    name="password"
                                    id="edit-password-admin"
                                    class="form-control"
                                    placeholder="Masukkan Kata Sandi"
                                    minlength="8"
                                    aria-describedby="helpId" />
                                <small id="helpId" class="text-muted">Password minimal berisi 8 karakter</small>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="role-admin" class="form-label required">Role</label>
                                <select name="role" id="edit-role-admin" class="select2 w-100" aria-describedby="helpId" required>
                                    <option value="" selected hidden>Pilih Role</option>
                                    <option value="1">Superadmin</option>
                                    <option value="2">Admin TU</option>
                                    <option value="3">Admin Jurusan</option>
                                </select>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-main">Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts_bottom')
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
<script>
    // Real-time search functionality
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        const tableRows = document.querySelectorAll('#table-admin tbody tr');
        const noResults = document.getElementById('noResults');
        const searchContainer = document.querySelector('.search-container');

        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase().trim();
            let matchCount = 0;

            // Add active class for search animation
            if (searchTerm.length > 0) {
                searchContainer.classList.add('active');
            } else {
                searchContainer.classList.remove('active');
            }

            tableRows.forEach(row => {
                const text = row.textContent.toLowerCase();
                const numericText = row.textContent.replace(/\D/g, ''); // Extract numeric content
                if (text.includes(searchTerm) || numericText.includes(searchTerm)) {
                    row.style.display = '';
                    matchCount++;

                    // Highlight matching text if search term is not empty
                    if (searchTerm.length > 0) {
                        highlightText(row, searchTerm);
                    } else {
                        // Remove highlights if search is cleared
                        removeHighlights(row);
                    }
                } else {
                    row.style.display = 'none';
                }
            });

            // Show "No results" message if no matches found
            if (matchCount === 0 && searchTerm.length > 0) {
                noResults.style.display = 'block';
            } else {
                noResults.style.display = 'none';
            }
        });

        // Function to highlight matching text
        function highlightText(row, searchTerm) {
            // First remove any existing highlights
            removeHighlights(row);

            // Only highlight text in name, email, and role columns (skip the action column)
            const cells = [
                row.querySelector('td:nth-child(2)'), // Name
                row.querySelector('td:nth-child(3)'), // Email
                row.querySelector('td:nth-child(4)') // Role
            ];

            cells.forEach(cell => {
                if (!cell) return;

                // Skip if the cell contains complex HTML (like role badges)
                if (cell.querySelector('.role-badge')) {
                    const roleText = cell.querySelector('.role-badge').textContent;
                    if (roleText.toLowerCase().includes(searchTerm)) {
                        cell.querySelector('.role-badge').innerHTML = roleText.replace(
                            new RegExp('(' + searchTerm + ')', 'gi'),
                            '<span class="highlight">$1</span>'
                        );
                    }
                } else {
                    const originalText = cell.textContent;
                    if (originalText.toLowerCase().includes(searchTerm)) {
                        cell.innerHTML = originalText.replace(
                            new RegExp('(' + searchTerm + ')', 'gi'),
                            '<span class="highlight">$1</span>'
                        );
                    }
                }
            });
        }

        // Function to remove highlights
        function removeHighlights(row) {
            const cells = row.querySelectorAll('td');
            cells.forEach(cell => {
                if (cell.querySelector('.role-badge')) {
                    const badge = cell.querySelector('.role-badge');
                    const originalText = badge.textContent;
                    badge.innerHTML = originalText;
                } else if (cell.querySelector('.highlight')) {
                    cell.innerHTML = cell.textContent;
                }
            });
        }

        function isNumber(evt) {
            let charCode = evt.which ? evt.which : evt.keyCode;
            if (charCode < 48 || charCode > 57) {
                return false; // Only allow digits (0-9)
            }
            return true;
        }
    });

    $(document).ready(function() {
        $('.modal').on('shown.bs.modal', function() {
            $(this).find('.select2').select2({
                dropdownParent: $(this), // Ensures dropdown appears inside the modal
                placeholder: "Pilih Role",
            });
        });

        $('.edit-btn').on('click', function() {
            let adminId = $(this).data('id'); // Get Admin ID from button
            console.log(adminId);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "/get-admin/" + adminId, // Ensure this matches your route
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    // console.log(data);
                    console.log(response);
                    // console.log(response.data);
                    // Populate modal inputs with data from JSON
                    $('#edit-id-admin').val(response.id);
                    // console.log(admin.id);
                    $('#edit-nama-admin').val(response.nama);
                    $('#edit-email-admin').val(response.email);
                    $('#edit-no_telp-admin').val(response.no_telp);
                    $('#edit-role-admin').val(response.role).trigger('change');

                    // Show the modal
                    $('#editAdmin').modal('show');
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    console.log(xhr.responseText); // Debugging
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: xhr.responseJSON?.error || 'Terjadi kesalahan!',
                    });
                }
            });
        });

        $('.delete-btn').on('click', function() {
            console.log(this); // Log the clicked button element
            let adminId = $(this).data('id'); // Get ID
            console.log(adminId);

            Swal.fire({
                title: 'Hapus Admin?',
                text: 'Kamu tidak akan bisa mengembalikan ini!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus',
                cancelButtonText: 'Batalkan'
            }).then((result) => {
                if (result.isConfirmed) { // Ensure correct confirmation check
                    $.ajax({
                        type: 'POST',
                        url: "{{ url('/kelola-admin/hapus') }}/" + adminId, // Use Laravel's URL helper
                        data: {
                            _method: 'DELETE', // Specify the method
                            _token: '{{ csrf_token() }}', // Use Blade directive for CSRF token
                            id: adminId // Pass the ID 
                        },
                        // dataType: 'json',
                        success: function(response) {
                            console.log(response)
                            Swal.fire({
                                title: 'Berhasil Hapus Admin',
                                icon: 'success',
                                timer: 2000,
                                timerProgressBar: true,
                                showConfirmButton: false
                            }).then(() => {
                                location.reload(); // Reload after successful deletion
                            });
                        },
                        error: function(xhr) {
                            console.error(xhr.responseText);
                            Swal.fire({
                                title: 'Gagal Hapus Admin',
                                text: xhr.responseJSON?.message || 'Terjadi kesalahan',
                                icon: 'error',
                                timer: 2000,
                                timerProgressBar: true,
                                showConfirmButton: false
                            }).then(() => {
                                location.reload(); // Reload after successful deletion
                            });
                        }
                    });
                }
            });
        });
    });
</script>
@endpush