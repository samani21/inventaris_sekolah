<?= $this->extend('layout/page_layout') ?>

<?= $this->section('content') ?>
    <div>
        <form action="<?= base_url('user/store')?>" method="post">
            <div>
                <label for="">Nama</label>
                <input type="text" name="name" class="form-control" required autofocus>
            </div>
            <div>
                <label for="">Username</label>
                <input type="text" name="username" class="form-control" required>
            </div>
            <div>
                <label for="">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div>
                <label for="">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div>
                <label for="">Level</label>
                <select name="level" id="" class="form-control" required>
                    <option value="Admin">Admin</option>
                    <option value="Guru">Guru</option>
                </select>
            </div>
            <br>
            <div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <button type="reset" class="btn btn-danger">Reset</button>
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