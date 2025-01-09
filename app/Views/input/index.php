<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        #nameSuggestions,
        #partSuggestions {
            position: absolute;
            background: white;
            border: 1px solid #ddd;
            border-radius: 4px;
            max-height: 200px;
            overflow-y: auto;
            width: 100%;
            z-index: 1000;
            display: none;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .suggestion-item {
            padding: 8px 12px;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .suggestion-item:hover {
            background-color: #f8f9fa;
        }

        .modal-body {
            position: relative;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light container">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
                aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="/home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/testinput">Part</a>
                    </li>
                </ul>
                <a href="/auth/logout">
                    <span class="navbar-text">
                        log out
                    </span>
                </a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mt-3 mb-3">
        <div class="row mb-3">
            <div class="col-lg-6">
                <button type="button" class="btn btn-primary tombolTambahData" data-bs-toggle="modal"
                    data-bs-target="#formModal">
                    Add Data
                </button>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="judulModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="judulModal">Add New Data</h1>
                        <button type="button" class="btn-close tombolTambahData" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="addDataForm" action="/inventoryController/tambah" method="post"
                            enctype="multipart/form-data">
                            <input type="hidden" name="id" id="id">

                            <!-- Input Name -->
                            <div class="mb-3 position-relative">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name">
                                <div id="nameSuggestions"></div>
                            </div>

                            <!-- Input Part Number -->
                            <div class="mb-3 position-relative">
                                <label for="partNumber" class="form-label">Part Number</label>
                                <input type="text" class="form-control" id="partNumber" name="partNumber">
                                <div id="partSuggestions"></div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" form="addDataForm" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table untuk menampilkan data -->
        <div class="table-responsive mt-4">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Name</th>
                        <th>Part Number</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (isset($input)): ?>
                        <?php foreach ($input as $i): ?>
                            <tr>
                                <td><?= $i['name'] ?></td>
                                <td><?= $i['part_number'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JavaScript -->
    <script>
        $(document).ready(function () {
            let searchTimeout;

            // Live search untuk name
            $('#name').keyup(function () {
                clearTimeout(searchTimeout);
                const searchTerm = $(this).val();

                if (searchTerm.length >= 2) {
                    searchTimeout = setTimeout(function () {
                        $.ajax({
                            url: '/searchName',
                            method: 'GET',
                            dataType: 'json',
                            data: {
                                search: searchTerm,
                                field: 'ItemName'
                            },
                            success: function (response) {
                                let html = '';
                                if (response && response.length > 0) {
                                    response.forEach(item => {
                                        html += `<div class="suggestion-item" data-name="${item.ItemName}" data-partnumber="${item.ItemCode}">
                                              ${item.ItemName}
                                           </div>`;
                                    });
                                    $('#nameSuggestions').html(html).show();
                                } else {
                                    $('#nameSuggestions').hide();
                                }
                            },
                            error: function (xhr, status, error) {
                                console.error('Error:', error);
                                $('#nameSuggestions').hide();
                            }
                        });
                    }, 300);
                } else {
                    $('#nameSuggestions').hide();
                }
            });

            // Live search untuk part number
            $('#partNumber').keyup(function () {
                clearTimeout(searchTimeout);
                const searchTerm = $(this).val();

                if (searchTerm.length >= 2) {
                    searchTimeout = setTimeout(function () {
                        $.ajax({
                            url: '/searchPartNumber',
                            method: 'GET',
                            dataType: 'json',
                            data: {
                                search: searchTerm,
                                field: 'ItemCode'
                            },
                            success: function (response) {
                                let html = '';
                                if (response && response.length > 0) {
                                    response.forEach(item => {
                                        html += `<div class="suggestion-item" data-name="${item.ItemName}" data-partnumber="${item.ItemCode}">
                                              ${item.ItemCode} - ${item.ItemName}
                                           </div>`;
                                    });
                                    $('#partSuggestions').html(html).show();
                                } else {
                                    $('#partSuggestions').hide();
                                }
                            },
                            error: function (xhr, status, error) {
                                console.error('Error:', error);
                                $('#partSuggestions').hide();
                            }
                        });
                    }, 300);
                } else {
                    $('#partSuggestions').hide();
                }
            });

            // Handle klik suggestion
            $(document).on('click', '.suggestion-item', function () {
                const name = $(this).data('name');
                const partNumber = $(this).data('partnumber');

                $('#name').val(name);
                $('#partNumber').val(partNumber);

                $('#nameSuggestions').hide();
                $('#partSuggestions').hide();
            });

            // Hide suggestions when clicking outside
            $(document).on('click', function (e) {
                if (!$(e.target).closest('.mb-3').length) {
                    $('#nameSuggestions, #partSuggestions').hide();
                }
            });

            // Form submit handler
            $('#addDataForm').on('submit', function (e) {
                if (!$('#name').val() || !$('#partNumber').val()) {
                    e.preventDefault();
                    alert('Please fill in all fields');
                }
            });
        });
    </script>
</body>

</html>