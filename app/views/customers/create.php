<div class="container-fluid">
    <h1 class="mb-4">Tambah Pelanggan</h1>
    <form action="/customers/store" method="post">
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control">
        </div>
        <div class="mb-3">
            <label>Telepon</label>
            <input type="text" name="phone" class="form-control">
        </div>
        <div class="mb-3">
            <label>PPPoE Username</label>
            <input type="text" name="pppoe_username" class="form-control">
        </div>
        <div class="mb-3">
            <label>PPPoE Password</label>
            <input type="text" name="pppoe_password" class="form-control">
        </div>
        <h5>Integrasi MikroTik (Opsional)</h5>
        <div class="mb-3">
            <label>Host</label>
            <input type="text" name="mikrotik_host" class="form-control" placeholder="IP Router">
        </div>
        <div class="mb-3">
            <label>API Username</label>
            <input type="text" name="mikrotik_user" class="form-control">
        </div>
        <div class="mb-3">
            <label>API Password</label>
            <input type="password" name="mikrotik_pass" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="/customers" class="btn btn-secondary">Batal</a>
    </form>
</div>