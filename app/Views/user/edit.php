<?= $this->extend('layout/page_layout') ?>

<?= $this->section('content') ?>
    <div>
        <form action="<?= base_url('user/update/'.$dt['id'].'')?>" method="post">
            <div>
                <label for="">Nama</label>
                <input type="text" name="name" value="<?= $dt['name'] ?>" class="form-control" required autofocus>
            </div>
            <div>
                <label for="">Username</label>
                <input type="text" name="username" value="<?= $dt['username'] ?>" class="form-control" required>
            </div>
            <div>
                <label for="">Email</label>
                <input type="email" name="email" value="<?= $dt['email'] ?>" class="form-control" required>
            </div>
            <div>
                <label for="">Password</label>
                <input type="password" name="password"  class="form-control" placeholder="Jika tidak ganti password kosongkan">
            </div>
            <div>
                <label for="">Level</label>
                <select name="level" id="" class="form-control" required>
                    <option value="<?= $dt['level'] ?>"><?= $dt['level'] ?></option>
                    <option value="Admin">Admin</option>
                    <option value="Tata Usaha">Tata Usaha</option>
                </select>
            </div>
            <br>
            <div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <button onclick="goBack()" class="btn btn-warning">Kembali</button>
            </div>
        </form>
    </div>
    <script>
    function goBack() {
        window.history.back();
    }
</script>
<?= $this->endSection() ?>