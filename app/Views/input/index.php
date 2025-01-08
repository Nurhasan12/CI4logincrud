<?php $this->extend('template/header'); ?>

<?php $this->section('content'); ?>


<!-- <div class="container mt-3 mb-3">


    <div class="row mb-3">
        <div class="col-lg-6">
            <button type="button" class="btn btn-primary tombolTambahData" data-bs-toggle="modal"
                data-bs-target="#formModal">
                Add Data
            </button>
        </div>
    </div> -->


<!-- Tambah data mahasiswa -->
<!-- <div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="judulModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="judulModal">Add New Data</h1>
                    <button type="button" class="btn-close tombolTambahData" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div> -->
<!-- <div class="modal-body"> -->
<!-- form tambah data mahasiswa -->
<!-- <form action="/mahasiswa/tambahh" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" id="id">
                        <div class="mb-3">
                            <label for="name" class="form-label">name</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>

                        <div class="mb-3">
                            <label for="university" class="form-label">Part Number</label>
                            <input type="text" class="form-control" id="university" name="university">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> -->


<div class="container mt-3 mb-3">
    <div class="row mb-3">
        <div class="col-lg-6">
            <button type="button" class="btn btn-primary tombolTambahData" data-bs-toggle="modal"
                data-bs-target="#formModal">
                Add Data
            </button>
        </div>
    </div>

    <!-- Tambah data inventory -->
    <div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="judulModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="judulModal">Add New Data</h1>
                    <button type="button" class="btn-close tombolTambahData" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form tambah data inventory -->
                    <form id="addDataForm" action="/inventory/tambah" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" id="id">

                        <!-- Input Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name">
                            <div id="nameSuggestions"></div> <!-- Untuk menampilkan saran nama -->
                        </div>

                        <!-- Input Part Number -->
                        <div class="mb-3">
                            <label for="partNumber" class="form-label">Part Number</label>
                            <input type="text" class="form-control" id="partNumber" name="partNumber">
                            <div id="partSuggestions"></div> <!-- Untuk menampilkan saran part number -->
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
</div>










<div class="container">
    <table class="table mt-5">
        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Part Number</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>3</td>
                <td>2</td>
            </tr>

        </tbody>
    </table>
</div>

<script>
    // Pencarian untuk Name
    document.getElementById("name").addEventListener("input", function () {
        const name = this.value;

        if (name.length > 2) {  // Mulai pencarian setelah 3 karakter dimasukkan
            fetch(`/inventory/search-name?query=${name}`)
                .then(response => response.json())
                .then(data => {
                    let suggestions = data.map(item => `<div class="suggestion-item">${item.name}</div>`).join('');
                    document.getElementById("nameSuggestions").innerHTML = suggestions;

                    // Tambahkan event listener untuk memilih name
                    document.querySelectorAll(".suggestion-item").forEach(item => {
                        item.addEventListener("click", function () {
                            document.getElementById("name").value = this.textContent;
                            document.getElementById("nameSuggestions").innerHTML = '';  // Clear suggestions
                        });
                    });
                });
        } else {
            document.getElementById("nameSuggestions").innerHTML = '';  // Clear suggestions
        }
    });

    // Pencarian untuk Part Number
    document.getElementById("partNumber").addEventListener("input", function () {
        const partNumber = this.value;

        if (partNumber.length > 2) {  // Mulai pencarian setelah 3 karakter dimasukkan
            fetch(`/inventory/search-part-number?query=${partNumber}`)
                .then(response => response.json())
                .then(data => {
                    let suggestions = data.map(item => `<div class="suggestion-item">${item.part_number}</div>`).join('');
                    document.getElementById("partSuggestions").innerHTML = suggestions;

                    // Tambahkan event listener untuk memilih part number
                    document.querySelectorAll(".suggestion-item").forEach(item => {
                        item.addEventListener("click", function () {
                            document.getElementById("partNumber").value = this.textContent;
                            document.getElementById("partSuggestions").innerHTML = '';  // Clear suggestions
                        });
                    });
                });
        } else {
            document.getElementById("partSuggestions").innerHTML = '';  // Clear suggestions
        }
    });
</script>

<?php $this->endsection(); ?>