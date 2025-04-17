@extends('layout.app')
@section('title', 'Kelola Peminjam')
@push('styles_top')
<style>
    #table-peminjam thead {
        background: linear-gradient(45deg, #07A4E3, #38C8F1);
        color: white;
    }

    .dt-column-title {
        margin-right: 1rem;
    }

    #table-peminjam>thead>tr>th {
        text-align: center;
        font-weight: bold;
        color: var(--white-color);
        background: #07A4E3;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    #table-peminjam td {
        text-align: center !important;
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

    .status-toggle {
        display: flex;
        justify-content: center;
        align-items: center;
        column-gap: .5rem;
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

        #table-peminjam th {
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
                <div class="col-lg-6 col-12 d-flex align-items-center">
                    <h1 class="fw-bold">Kelola Peminjam</h1>
                </div>
                <div class="col-lg-6 col-12 d-flex-jend gap-3">
                    <button type="modal" data-bs-toggle="modal" data-bs-target="#importPeminjam" class="btn btn-main column-gap-2">Import Excel <i class='bx bx-spreadsheet'></i></button>
                    <button type="modal" data-bs-toggle="modal" data-bs-target="#tambahPeminjam" class="btn btn-main column-gap-2">Tambah Peminjam <i class="bx bx-plus"></i></button>
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
                style="border-radius: 8px" id="table-peminjam">
                <thead>
                    <tr>
                        <th scope="col" style="width: 5%">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">NIS/NIP</th>
                        <th scope="col">Email</th>
                        <th scope="col">No. Telp</th>
                        <th scope="col">Status</th>
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
                        <td>{{ $datas->nis }} {{ $datas->nip }}</td>
                        <td>{{ $datas->email ?? "-" }}</td>
                        <td class="text-center">{{ $datas->no_telp ?? '-' }}</td>
                        <td>
                            <span class="role-badge status-toggle 
                                @if ($datas->status == 1) green @else gray @endif"
                                data-id="{{ $datas->id }}"
                                data-status="{{ $datas->status }}"
                                style="cursor: pointer;" data-bs-toggle="tooltip"
                                data-bs-title="Ganti status akun">

                                @if ($datas->status == 1)
                                Aktif
                                @elseif ($datas->status == 0)
                                Nonaktif
                                @else
                                Tidak diketahui
                                @endif
                                <i class="bx bx-info-circle" style="font-size: 1.30rem"></i>
                            </span>
                        </td>

                        <td>
                            <span class="role-badge 
                                @if ($datas->role == 1) blue 
                                @else ($datas->role == 2) purple 
                                @endif
                            ">

                                @if ($datas->role == 1)
                                Siswa
                                @elseif ($datas->role == 2)
                                Guru
                                @else
                                Tidak diketahui
                                @endif
                            </span>
                        </td>
                        <td class="d-flex justify-content-center p-4">
                            <div data-bs-toggle="modal" data-bs-target="#editPeminjam" class="action-btn edit-btn" data-id="{{ $datas->id }}">
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

    <!-- tambah peminjam modal -->
    <div class="modal fade" id="tambahPeminjam" tabindex="-1" aria-labelledby="tambahPeminjamLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fw-bold fs-5" id="tambahPeminjamLabel">Tambah Peminjam</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('simpan-peminjam') }}" method="post" id="form-tambah-peminjam">
                        @csrf
                        <div class="col">
                            <div class="mb-3">
                                <label for="tambah-nama-peminjam" class="form-label required">Nama</label>
                                <input
                                    type="text"
                                    name="nama"
                                    id="tambah-nama-peminjam"
                                    class="form-control"
                                    placeholder="Masukkan Nama"
                                    aria-describedby="helpId" required autofocus />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-12">
                                <div class="mb-3">
                                    <label for="tambah-role-peminjam" class="form-label required">Role</label>
                                    <select name="role" id="tambah-role-peminjam" class="select2 w-100" aria-describedby="helpId" onchange="checkRole(this);" required>
                                        <option value="" selected hidden>Pilih Role</option>
                                        <option value="1">Siswa</option>
                                        <option value="2">Guru</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12" id="checkNis" style="display:none">
                                <div class="mb-3">
                                    <label for="tambah-nis-peminjam" class="form-label required">NIS</label>
                                    <input type="text"
                                        name="nis"
                                        id="tambah-nis-peminjam"
                                        class="form-control"
                                        placeholder="Masukkan NIS"
                                        aria-describedby="helpId"
                                        onkeypress="return isNumber(event)"
                                        maxlength="10">
                                </div>
                            </div>
                            <div class="col-lg-6 col-12" id="checkNip" style="display:none">
                                <div class="mb-3">
                                    <label for="tambah-nip-peminjam" class="form-label required">NIP</label>
                                    <input type="text"
                                        name="nip"
                                        id="tambah-nip-peminjam"
                                        class="form-control"
                                        placeholder="Masukkan NIP"
                                        aria-describedby="helpId"
                                        onkeypress="return isNumber(event)"
                                        maxlength="18">
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="tambah-email-peminjam" class="form-label required">Email</label>
                                <input
                                    type="email"
                                    name="email"
                                    id="tambah-email-peminjam"
                                    class="form-control"
                                    placeholder="Masukkan Email"
                                    aria-describedby="helpId" required />
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="tambah-no_telp-peminjam" class="form-label">No. Telepon</label>
                                <input type="text"
                                    name="no_telp"
                                    id="tambah-no_telp-peminjam"
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
                                <label for="tambah-password-peminjam" class="form-label required">Password</label>
                                <input
                                    type="password"
                                    name="password"
                                    id="tambah-password-peminjam"
                                    class="form-control"
                                    placeholder="Masukkan Kata Sandi"
                                    minlength="8"
                                    aria-describedby="helpId" required />
                                <small id="helpId" class="text-muted">Password minimal berisi 8 karakter</small>
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

    <!-- edit peminjam modal -->
    <div class="modal fade" id="editPeminjam" tabindex="-1" aria-labelledby="editPeminjamLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fw-bold fs-5" id="editPeminjamLabel">Edit Peminjam</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ isset($datas) ? route('update-peminjam', ['id' => $datas->first()->id]) : '#' }}" method="post" id="form-edit-peminjam">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id-peminjam" id="edit-id-peminjam">
                        <div class="col">
                            <div class="mb-3">
                                <label for="nama-peminjam" class="form-label required">Nama</label>
                                <input
                                    type="text"
                                    name="nama"
                                    id="edit-nama-peminjam"
                                    class="form-control"
                                    placeholder="Masukkan Nama"
                                    aria-describedby="helpId" required autofocus />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-12">
                                <div class="mb-3">
                                    <label for="edit-role-peminjam" class="form-label required">Role</label>
                                    <select name="role" id="edit-role-peminjam" class="select2 w-100" aria-describedby="helpId" onchange="checkEditRole(this);" required>
                                        <option value="" selected hidden>Pilih Role</option>
                                        <option value="1">Siswa</option>
                                        <option value="2">Guru</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12" id="checkeditNis" style="display: none">
                                <div class="mb-3">
                                    <label for="edit-nis-peminjam" class="form-label required">NIS</label>
                                    <input type="text"
                                        name="nis"
                                        id="edit-nis-peminjam"
                                        class="form-control"
                                        placeholder="Masukkan NIS"
                                        aria-describedby="helpId"
                                        onkeypress="return isNumber(event)"
                                        maxlength="10">
                                </div>
                            </div>
                            <div class="col-lg-6 col-12" id="checkeditNip" style="display: none">
                                <div class="mb-3">
                                    <label for="edit-nip-peminjam" class="form-label required">NIP</label>
                                    <input type="text"
                                        name="nip"
                                        id="edit-nip-peminjam"
                                        class="form-control"
                                        placeholder="Masukkan NIP"
                                        aria-describedby="helpId"
                                        onkeypress="return isNumber(event)"
                                        maxlength="18">
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="email-peminjam" class="form-label required">Email</label>
                                <input
                                    type="email"
                                    name="email"
                                    id="edit-email-peminjam"
                                    class="form-control"
                                    placeholder="Masukkan Email"
                                    aria-describedby="helpId" required />
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="no_telp-peminjam" class="form-label">No. Telepon</label>
                                <input type="text"
                                    name="no_telp"
                                    id="edit-no_telp-peminjam"
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
                                <label for="password-peminjam" class="form-label">Password</label>
                                <input
                                    type="password"
                                    name="password"
                                    id="edit-password-peminjam"
                                    class="form-control"
                                    placeholder="Masukkan Kata Sandi"
                                    minlength="8"
                                    aria-describedby="helpId" />
                                <small id="helpId" class="text-muted">Password minimal berisi 8 karakter</small>
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

    <!-- import peminjam modal -->
    <div class="modal fade" id="importPeminjam" tabindex="-1" aria-labelledby="importPeminjamLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fw-bold fs-5" id="importPeminjamLabel">Import Peminjam</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('import-excel-peminjam') }}" method="post" id="form-import-peminjam" enctype="multipart/form-data">
                        @csrf
                        <div class="col">
                            <div class="mb-3">
                                <label for="import-file-peminjam" class="form-label required">File (Excel/Spreadsheet .xls .xlsx .xltx .xltm .csv)</label>
                                <input
                                    type="file"
                                    name="file"
                                    id="import-file-peminjam"
                                    class="form-control dropify"
                                    placeholder="Masukkan File"
                                    data-allowed-file-extensions="xls xlsx xltx xltm csv"
                                    data-bs-toggle="tooltip"
                                    data-bs-title="Masukkan file excel/spreadsheet (dengan akhiran .xls, .xlsx, .xltx, .xltm, atau .csv saja)" data-bs-placement="left" required />
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
    function checkRole(that) {
        if (that.value == "1") {
            document.getElementById("checkNis").style.display = "block";
            document.getElementById("tambah-nis-peminjam").setAttribute("required", "required");
            document.getElementById("checkNip").style.display = "none";
            document.getElementById("tambah-nip-peminjam").removeAttribute("required");
        } else if (that.value == "2") {
            document.getElementById("checkNip").style.display = "block";
            document.getElementById("tambah-nip-peminjam").setAttribute("required", "required");
            document.getElementById("checkNis").style.display = "none";
            document.getElementById("tambah-nis-peminjam").removeAttribute("required");
        } else {
            document.getElementById("checkNis").style.display = "none";
            document.getElementById("checkNip").style.display = "none";
            document.getElementById("tambah-nis-peminjam").removeAttribute("required");
            document.getElementById("tambah-nip-peminjam").removeAttribute("required");
        }
    }

    function checkEditRole(that) {
        let nis = document.getElementById("checkeditNis");
        let nip = document.getElementById("checkeditNip");
        let inputNis = document.getElementById("edit-nis-peminjam");
        let inputNip = document.getElementById("edit-nip-peminjam");

        if (that.value == "1") {
            nis.style.display = "block";
            nip.style.display = "none";
            inputNis.required = true;
            inputNip.required = false;
        } else if (that.value == "2") {
            nis.style.display = "none";
            nip.style.display = "block";
            inputNis.required = false;
            inputNip.required = true;
        } else {
            nis.style.display = "none";
            nip.style.display = "none";
            inputNis.required = false;
            inputNip.required = false;
        }
    }

    // Real-time search functionality
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        const tableRows = document.querySelectorAll('#table-peminjam tbody tr');
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
    });

    $(document).ready(function() {
        $('.modal').on('shown.bs.modal', function() {
            $(this).find('.select2').select2({
                dropdownParent: $(this), // Ensures dropdown appears inside the modal
                placeholder: "Pilih Role",
            });
        });

        $('.edit-btn').on('click', function() {
            let peminjamId = $(this).data('id'); // Get peminjam ID from button
            console.log(peminjamId);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "/get-peminjam/" + peminjamId, // Ensure this matches your route
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    console.log(response);

                    let checkNis = document.getElementById("checkeditNis");
                    let checkNip = document.getElementById("checkeditNip");

                    // Ensure elements exist
                    if (!checkNis || !checkNip) {
                        console.error("Element checkNis or checkNip not found!");
                        return;
                    }

                    // Populate modal inputs
                    $('#edit-id-peminjam').val(response.id);
                    $('#edit-nama-peminjam').val(response.nama);
                    $('#edit-role-peminjam').val(response.role).trigger('change');
                    $('#edit-email-peminjam').val(response.email);
                    $('#edit-no_telp-peminjam').val(response.no_telp);

                    // Show correct field based on role
                    console.log("🟡 Checking which field to show...");
                    console.log("response.nis:", response.nis);
                    console.log("response.nip:", response.nip);

                    if (response.role == 1) {
                        console.log("✅ Showing #checkNis");
                        checkNis.style.display = "block";
                        $('#edit-nis-peminjam').val(response.nis);
                        checkNip.style.display = "none";
                        $('#edit-nip-peminjam').val('');
                    } else if (response.role == 2) {
                        console.log("✅ Showing #checkNip");
                        checkNip.style.display = "block";
                        $('#edit-nip-peminjam').val(response.nip);
                        checkNis.style.display = "none";
                        $('#edit-nis-peminjam').val('');
                    } else {
                        console.log("✅ Hiding both fields");
                        checkNis.style.display = "none";
                        checkNip.style.display = "none";
                        $('#edit-nis-peminjam').val('');
                        $('#edit-nip-peminjam').val('');
                    }

                    // Show the modal
                    $('#editPeminjam').modal('show');
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
            let peminjamId = $(this).data('id'); // Get ID
            console.log(peminjamId);

            Swal.fire({
                title: 'Hapus Peminjam?',
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
                        url: "{{ url('/kelola-peminjam/hapus') }}/" + peminjamId, // Use Laravel's URL helper
                        data: {
                            _method: 'DELETE', // Specify the method
                            _token: '{{ csrf_token() }}', // Use Blade directive for CSRF token
                            id: peminjamId // Pass the ID 
                        },
                        // dataType: 'json',
                        success: function(response) {
                            console.log(response)
                            Swal.fire({
                                title: 'Berhasil Hapus Peminjam',
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
                                title: 'Gagal Hapus Peminjam',
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

        $(".status-toggle").click(function() {
            let badge = $(this);
            let peminjamId = badge.data("id");
            let statusNow = badge.data("status");
            let statusNew = statusNow == 1 ? 0 : 1;

            // Simpan teks asli
            let originalText = badge.text();

            // Tampilkan animasi loading
            badge.html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Memuat...`);

            $.ajax({
                url: "{{ route('update-status-peminjam') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: peminjamId,
                    status: statusNew
                },
                success: function(response) {
                    if (response.success) {
                        badge
                            .removeClass("green gray")
                            .addClass(statusNew == 1 ? "green" : "gray")
                            .html(`${statusNew == 1 ? "Aktif" : "Nonaktif"} <i class="bx bx-info-circle" style="font-size: 1.30rem"></i>`)
                            .data("status", statusNew);

                        // Optional: Notifikasi cepat tanpa reload
                        Swal.fire({
                            title: 'Status Diperbarui',
                            icon: 'success',
                            timer: 1500,
                            showConfirmButton: false,
                            timerProgressBar: true,
                        });
                    } else {
                        badge.html(originalText);
                        Swal.fire({
                            title: 'Gagal Memperbarui',
                            text: response.message,
                            icon: 'error',
                            timer: 2000,
                            showConfirmButton: false,
                            timerProgressBar: true,
                        });
                    }
                },
                error: function() {
                    badge.html(originalText);
                    Swal.fire({
                        title: 'Terjadi Kesalahan',
                        text: 'Gagal terhubung ke server.',
                        icon: 'error',
                        timer: 2000,
                        showConfirmButton: false,
                        timerProgressBar: true,
                    });
                }
            });
        });

    });
</script>
@endpush