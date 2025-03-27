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

        .role-badge {
            display: inline-block;
            padding: 8px 20px;
            border-radius: 20px;
            background: rgba(7, 164, 227, 0.1);
            color: #07A4E3;
            font-weight: bold;
        }

        .role-badge.purple {
            background: rgba(156, 39, 176, 0.1);
            color: #9c27b0;
        }

        .role-badge.green {
            background: rgba(76, 175, 80, 0.1);
            color: #4CAF50;
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
                    <button class="btn btn-main column-gap-2">Tambah Admin <i class="bx bx-plus"></i></button>
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
                        <th scope="col" style="width: 40%">Email</th>
                        <th scope="col">Role</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="">
                        <td scope="row" class="text-center">1</td>
                        <td>Akhtar</td>
                        <td>muhammadakhtarmalikislamy@gmail.com</td>
                        <td><span class="role-badge">Superadmin</span></td>
                        <td class="d-flex justify-content-center">
                            <div class="action-btn edit-btn">
                                <i class="bx bx-edit"></i>
                            </div>
                            <div class="action-btn delete-btn">
                                <i class="bx bx-trash"></i>
                            </div>
                        </td>
                    </tr>
                    <tr class="">
                        <td scope="row" class="text-center">2</td>
                        <td>Aloudya</td>
                        <td>aloudyafathya@gmail.com</td>
                        <td><span class="role-badge purple">Admin TU</span></td>
                        <td>
                            <i class="bg-primary bx bx-edit fs-3 img-thumbnail me-3" style="color: white;"></i>
                            <i class="bg-danger bx bx-trash fs-3 img-thumbnail" style="color: white;"></i>
                        </td>
                    </tr>
                    <tr class="">
                        <td scope="row" class="text-center">2</td>
                        <td>Aisha</td>
                        <td>aisha@gmail.com</td>
                        <td><span class="role-badge green">Admin Jurusan</span></td>
                        <td>
                            <i class="bg-primary bx bx-edit fs-3 img-thumbnail me-3" style="color: white;"></i>
                            <i class="bg-danger bx bx-trash fs-3 img-thumbnail" style="color: white;"></i>
                        </td>
                    </tr>
                    <tr class="">
                        <td scope="row" class="text-center">1</td>
                        <td>Akhtar</td>
                        <td>muhammadakhtarmalikislamy@gmail.com</td>
                        <td><span class="role-badge">Superadmin</span></td>
                        <td>
                            <div class="action-btn edit-btn">
                                <i class="bx bx-edit"></i>
                            </div>
                            <div class="action-btn delete-btn">
                                <i class="bx bx-trash"></i>
                            </div>
                        </td>
                    </tr>
                    <tr class="">
                        <td scope="row" class="text-center">2</td>
                        <td>Aloudya</td>
                        <td>aloudyafathya@gmail.com</td>
                        <td><span class="role-badge purple">Admin TU</span></td>
                        <td>
                            <i class="bg-primary bx bx-edit fs-3 img-thumbnail me-3" style="color: white;"></i>
                            <i class="bg-danger bx bx-trash fs-3 img-thumbnail" style="color: white;"></i>
                        </td>
                    </tr>
                    <tr class="">
                        <td scope="row" class="text-center">2</td>
                        <td>Aisha</td>
                        <td>aisha@gmail.com</td>
                        <td><span class="role-badge green">Admin Jurusan</span></td>
                        <td>
                            <i class="bg-primary bx bx-edit fs-3 img-thumbnail me-3" style="color: white;"></i>
                            <i class="bg-danger bx bx-trash fs-3 img-thumbnail" style="color: white;"></i>
                        </td>
                    </tr>
                    <tr class="">
                        <td scope="row" class="text-center">1</td>
                        <td>Akhtar</td>
                        <td>muhammadakhtarmalikislamy@gmail.com</td>
                        <td><span class="role-badge">Superadmin</span></td>
                        <td>
                            <div class="action-btn edit-btn">
                                <i class="bx bx-edit"></i>
                            </div>
                            <div class="action-btn delete-btn">
                                <i class="bx bx-trash"></i>
                            </div>
                        </td>
                    </tr>
                    <tr class="">
                        <td scope="row" class="text-center">2</td>
                        <td>Aloudya</td>
                        <td>aloudyafathya@gmail.com</td>
                        <td><span class="role-badge purple">Admin TU</span></td>
                        <td>
                            <i class="bg-primary bx bx-edit fs-3 img-thumbnail me-3" style="color: white;"></i>
                            <i class="bg-danger bx bx-trash fs-3 img-thumbnail" style="color: white;"></i>
                        </td>
                    </tr>
                    <tr class="">
                        <td scope="row" class="text-center">2</td>
                        <td>Aisha</td>
                        <td>aisha@gmail.com</td>
                        <td><span class="role-badge green">Admin Jurusan</span></td>
                        <td>
                            <i class="bg-primary bx bx-edit fs-3 img-thumbnail me-3" style="color: white;"></i>
                            <i class="bg-danger bx bx-trash fs-3 img-thumbnail" style="color: white;"></i>
                        </td>
                    </tr>
                    <tr class="">
                        <td scope="row" class="text-center">1</td>
                        <td>Akhtar</td>
                        <td>muhammadakhtarmalikislamy@gmail.com</td>
                        <td><span class="role-badge">Superadmin</span></td>
                        <td>
                            <div class="action-btn edit-btn">
                                <i class="bx bx-edit"></i>
                            </div>
                            <div class="action-btn delete-btn">
                                <i class="bx bx-trash"></i>
                            </div>
                        </td>
                    </tr>
                    <tr class="">
                        <td scope="row" class="text-center">2</td>
                        <td>Aloudya</td>
                        <td>aloudyafathya@gmail.com</td>
                        <td><span class="role-badge purple">Admin TU</span></td>
                        <td>
                            <i class="bg-primary bx bx-edit fs-3 img-thumbnail me-3" style="color: white;"></i>
                            <i class="bg-danger bx bx-trash fs-3 img-thumbnail" style="color: white;"></i>
                        </td>
                    </tr>
                    <tr class="">
                        <td scope="row" class="text-center">2</td>
                        <td>Aisha</td>
                        <td>aisha@gmail.com</td>
                        <td><span class="role-badge green">Admin Jurusan</span></td>
                        <td>
                            <i class="bg-primary bx bx-edit fs-3 img-thumbnail me-3" style="color: white;"></i>
                            <i class="bg-danger bx bx-trash fs-3 img-thumbnail" style="color: white;"></i>
                        </td>
                    </tr>
                    <tr class="">
                        <td scope="row" class="text-center">1</td>
                        <td>Akhtar</td>
                        <td>muhammadakhtarmalikislamy@gmail.com</td>
                        <td><span class="role-badge">Superadmin</span></td>
                        <td>
                            <div class="action-btn edit-btn">
                                <i class="bx bx-edit"></i>
                            </div>
                            <div class="action-btn delete-btn">
                                <i class="bx bx-trash"></i>
                            </div>
                        </td>
                    </tr>
                    <tr class="">
                        <td scope="row" class="text-center">2</td>
                        <td>Aloudya</td>
                        <td>aloudyafathya@gmail.com</td>
                        <td><span class="role-badge purple">Admin TU</span></td>
                        <td>
                            <i class="bg-primary bx bx-edit fs-3 img-thumbnail me-3" style="color: white;"></i>
                            <i class="bg-danger bx bx-trash fs-3 img-thumbnail" style="color: white;"></i>
                        </td>
                    </tr>
                    <tr class="">
                        <td scope="row" class="text-center">2</td>
                        <td>Aisha</td>
                        <td>aisha@gmail.com</td>
                        <td><span class="role-badge green">Admin Jurusan</span></td>
                        <td>
                            <i class="bg-primary bx bx-edit fs-3 img-thumbnail me-3" style="color: white;"></i>
                            <i class="bg-danger bx bx-trash fs-3 img-thumbnail" style="color: white;"></i>
                        </td>
                    </tr>
                    <tr class="">
                        <td scope="row" class="text-center">1</td>
                        <td>Akhtar</td>
                        <td>muhammadakhtarmalikislamy@gmail.com</td>
                        <td><span class="role-badge">Superadmin</span></td>
                        <td>
                            <div class="action-btn edit-btn">
                                <i class="bx bx-edit"></i>
                            </div>
                            <div class="action-btn delete-btn">
                                <i class="bx bx-trash"></i>
                            </div>
                        </td>
                    </tr>
                    <tr class="">
                        <td scope="row" class="text-center">2</td>
                        <td>Aloudya</td>
                        <td>aloudyafathya@gmail.com</td>
                        <td><span class="role-badge purple">Admin TU</span></td>
                        <td>
                            <i class="bg-primary bx bx-edit fs-3 img-thumbnail me-3" style="color: white;"></i>
                            <i class="bg-danger bx bx-trash fs-3 img-thumbnail" style="color: white;"></i>
                        </td>
                    </tr>
                    <tr class="">
                        <td scope="row" class="text-center">2</td>
                        <td>Aisha</td>
                        <td>aisha@gmail.com</td>
                        <td><span class="role-badge green">Admin Jurusan</span></td>
                        <td>
                            <i class="bg-primary bx bx-edit fs-3 img-thumbnail me-3" style="color: white;"></i>
                            <i class="bg-danger bx bx-trash fs-3 img-thumbnail" style="color: white;"></i>
                        </td>
                    </tr>
                    <tr class="">
                        <td scope="row" class="text-center">1</td>
                        <td>Akhtar</td>
                        <td>muhammadakhtarmalikislamy@gmail.com</td>
                        <td><span class="role-badge">Superadmin</span></td>
                        <td>
                            <div class="action-btn edit-btn">
                                <i class="bx bx-edit"></i>
                            </div>
                            <div class="action-btn delete-btn">
                                <i class="bx bx-trash"></i>
                            </div>
                        </td>
                    </tr>
                    <tr class="">
                        <td scope="row" class="text-center">2</td>
                        <td>Aloudya</td>
                        <td>aloudyafathya@gmail.com</td>
                        <td><span class="role-badge purple">Admin TU</span></td>
                        <td>
                            <i class="bg-primary bx bx-edit fs-3 img-thumbnail me-3" style="color: white;"></i>
                            <i class="bg-danger bx bx-trash fs-3 img-thumbnail" style="color: white;"></i>
                        </td>
                    </tr>
                    <tr class="">
                        <td scope="row" class="text-center">2</td>
                        <td>Aisha</td>
                        <td>aisha@gmail.com</td>
                        <td><span class="role-badge green">Admin Jurusan</span></td>
                        <td>
                            <i class="bg-primary bx bx-edit fs-3 img-thumbnail me-3" style="color: white;"></i>
                            <i class="bg-danger bx bx-trash fs-3 img-thumbnail" style="color: white;"></i>
                        </td>
                    </tr>
                    <tr class="">
                        <td scope="row" class="text-center">1</td>
                        <td>Akhtar</td>
                        <td>muhammadakhtarmalikislamy@gmail.com</td>
                        <td><span class="role-badge">Superadmin</span></td>
                        <td>
                            <div class="action-btn edit-btn">
                                <i class="bx bx-edit"></i>
                            </div>
                            <div class="action-btn delete-btn">
                                <i class="bx bx-trash"></i>
                            </div>
                        </td>
                    </tr>
                    <tr class="">
                        <td scope="row" class="text-center">2</td>
                        <td>Aloudya</td>
                        <td>aloudyafathya@gmail.com</td>
                        <td><span class="role-badge purple">Admin TU</span></td>
                        <td>
                            <i class="bg-primary bx bx-edit fs-3 img-thumbnail me-3" style="color: white;"></i>
                            <i class="bg-danger bx bx-trash fs-3 img-thumbnail" style="color: white;"></i>
                        </td>
                    </tr>
                    <tr class="">
                        <td scope="row" class="text-center">2</td>
                        <td>Aisha</td>
                        <td>aisha@gmail.com</td>
                        <td><span class="role-badge green">Admin Jurusan</span></td>
                        <td>
                            <i class="bg-primary bx bx-edit fs-3 img-thumbnail me-3" style="color: white;"></i>
                            <i class="bg-danger bx bx-trash fs-3 img-thumbnail" style="color: white;"></i>
                        </td>
                    </tr>
                    <div id="noResults" class="no-results" style="display: none;">No matching records found! :(</div>
                </tbody>
            </table>
        </div>
    </div>


</section>
@endsection

@push('scripts_bottom')
    <script>
        // Real-time search functionality
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('searchInput');
            const tableRows = document.querySelectorAll('#table-admin tbody tr');
            const noResults = document.getElementById('noResults');
            const searchContainer = document.querySelector('.search-container');

            searchInput.addEventListener('input', function () {
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
                    if (text.includes(searchTerm)) {
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