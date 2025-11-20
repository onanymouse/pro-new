<div class="container-fluid">
    <h1 class="mb-4">Daftar Pelanggan</h1>
    <a href="/customers/create" class="btn btn-primary mb-3">Tambah Pelanggan</a>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Telepon</th>
                <th>PPPoE Username</th>
                <th>MikroTik Host</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($customers as $c): ?>
            <tr>
                <td><?= $c['id'] ?></td>
                <td><?= htmlspecialchars($c['name']) ?></td>
                <td><?= htmlspecialchars($c['email']) ?></td>
                <td><?= htmlspecialchars($c['phone']) ?></td>
                <td><?= htmlspecialchars($c['pppoe_username']) ?></td>
                <td><?= htmlspecialchars($c['mikrotik_host'] ?? '-') ?></td>
                <td>
                    <a href="/customers/edit/<?= $c['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                    <a href="/customers/delete/<?= $c['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>