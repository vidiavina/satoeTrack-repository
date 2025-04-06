@extends('layout.app')
@section('title', 'Preview Data Excel Peminjam')
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
        margin: 20px 0;
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

    #table-peminjam th,
    #table-peminjam td {
        padding: 16px;
    }

    @media (max-width: 991px) {

        .button-group,
        .preview-text {
            justify-content: center !important;
        }
    }
</style>
@endpush
@section('content')
<section class="mt-3 pt-3">
    <form action="{{ route('simpan-excel-peminjam') }}" method="post" id="form-simpan-excel-peminjam">
        @csrf
        <div class="mb-4">
            <div class="card p-3">
                <div class="row gap-lg-0 gap-2">
                    <div class="col-lg-6 col-12 d-flex align-items-center preview-text">
                        <h1 class="fw-bold text-center">Preview Data Excel Peminjam</h1>
                    </div>
                    <div class="col-lg-6 col-12 d-flex-jend gap-3 button-group">
                        <a href="{{ route('kelola-peminjam') }}" class="btn btn-danger">Kembali</a>
                        <button type="submit" class="btn btn-main column-gap-2">Simpan <i class="bx bx-save"></i></button>
                    </div>
                </div>
                <hr>
                <div class="col-12 pt-2 text-center">
                    <p class="inter fs-4 text-muted">Berikut adalah data yang akan diimpor ke sistem. <br>Silakan <span class="fw-bold">
                            periksa kembali</span> sebelum disimpan.</p>
                    <p class="inter">Menampilkan <span class="fw-bold">{{ count($data) }} data </span> dari file Excel. <br>Pastikan semuanya sudah sesuai sebelum melanjutkan.
                </div>

                <div class="search-container">
                    <input type="text" id="searchInput" placeholder="Search...">
                    <i class="bx bx-search search-icon"></i>
                </div>
                <div class="table-responsive py-2">
                    <table
                        class="table data-table table-striped table-vcenter table-hover text-center align-middle rounded-3 overflow-hidden"
                        style="border-radius: 8px" id="table-peminjam">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 5%">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">NIS</th>
                                <th scope="col">NIP</th>
                                <th scope="col">Email</th>
                                <th scope="col">No. Telp</th>
                                <th scope="col">Password</th>
                                <th scope="col">Status</th>
                                <th scope="col">Role</th>
                                <!-- <th scope="col">Action</th> -->
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
                                <td>{{ $datas->nis }}</td>
                                <td>{{ $datas->nip }}</td>
                                <td>{{ $datas->email }}</td>
                                <td class="text-center">{{ $datas->no_telp ?? '-' }}</td>
                                <td>{{ $datas->password }}</td>
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
                                <!-- <td class="d-flex justify-content-center p-4">
                            <div data-bs-toggle="modal" data-bs-target="#editPeminjam" class="action-btn edit-btn" data-id="{{ $datas->id }}">
                                <i class="bx bx-edit"></i>
                            </div>
                            <div class="action-btn delete-btn" data-id="{{ $datas->id }}">
                                <i class="bx bx-trash"></i>
                            </div>
                            </td> -->

                                <input type="hidden" name="id" value="{{ $datas->id }}">
                                <input type="hidden" name="nama[]" value="{{ $datas->nama }}">
                                <input type="hidden" name="nis[]" value="{{ $datas->nis }}">
                                <input type="hidden" name="nip[]" value="{{ $datas->nip }}">
                                <input type="hidden" name="email[]" value="{{ $datas->email }}">
                                <input type="hidden" name="no_telp[]" value="{{ $datas->no_telp }}">
                                <input type="hidden" name="password[]" value="{{ $datas->password }}">
                                <input type="hidden" name="status[]" value="{{ $datas->status }}">
                                <input type="hidden" name="role[]" value="{{ $datas->role }}">
                            </tr>
                            @endforeach

                            <div id="noResults" class="no-results" style="display: none;">No matching records found! :(</div>
                        </tbody>
                    </table>
                </div>
            </div>
    </form>
</section>
@endsection
@push('scripts_bottom')
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
<script>
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
</script>
@endpush