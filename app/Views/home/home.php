<?php $this->extend('template/header'); ?>


<?php $this->section('content'); ?>

<div class="container">
    <h1 class="text-center">CRUD Mahasiswa</h1>
    <table class="table mt-5">
        <thead>
            <a href="/create"><button type="button" class="btn btn-success">Tambah Data</button></a>
            <tr>
                <th scope="col">Nama</th>
                <th scope="col">Nim</th>
                <th scope="col">Email</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>

            <?php foreach ($mahasiswa as $siswa): ?>
                <tr>
                    <td><?= $siswa['nama']; ?></td>
                    <td><?= $siswa['nim']; ?></td>
                    <td><?= $siswa['email']; ?></td>
                    <td>
                        <a href="/edit/<?= $siswa['id']; ?>"><button type="button" class="btn btn-warning">edit</button></a>
                        <a href="/delete/<?= $siswa['id']; ?>"><button type="button" class="btn btn-danger"
                                onclick="return confirm('Apakah anda yakin?')">hapus</button></a>
                    </td>

                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?= $this->endSection() ?>