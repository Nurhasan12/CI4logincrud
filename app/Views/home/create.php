<?php $this->extend('template/header'); ?>

<?php $this->section('content'); ?>


<div class="container mt-5">
    <h1 class="text-center mt-3">Tambah Data Mahasiswa</h1>


    <form action="/save" method="post">
        <?= csrf_field(); ?>

        <!-- Input Nama -->
        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" value="<?= old('nama'); ?>" required>
        </div>

        <!-- Input NIM -->
        <div class="mb-3">
            <label for="nim" class="form-label">NIM</label>
            <input type="text" class="form-control" id="nim" name="nim" value="<?= old('nim'); ?>" required>
        </div>

        <!-- Input email -->
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?= old('email'); ?>" required>
        </div>

        <!-- Button Submit -->
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="/home" class="btn btn-secondary">Kembali</a>
    </form>
</div>
<?php $this->endsection(); ?>