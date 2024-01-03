<?= $this->extend('layout/page_layout') ?>

<?= $this->section('content') ?>
    <div>
    <form action="<?= base_url('guru/update/'.$dt['id'].'')?>" method="post" enctype="multipart/form-data"><div class="row">
                <div class="col-2">
                    <label for="">NIP</label>
                </div>
                <div class="col-8">
                    <input type="text" name="nip" value="<?= $dt['nip'] ?>" class="form-control" required>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-2">
                    <label for="">Nama</label>
                </div>
                <div class="col-8">
                    <input type="text" name="nama" value="<?= $dt['nama'] ?>" class="form-control" required>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-2">
                    <label for="">TTL</label>
                </div>
                <div class="col-4">
                    <input type="text" name="tempat" value="<?= $dt['tempat'] ?>" class="form-control" required>
                </div>
                <div class="col-4">
                    <input type="date" name="t_lahir" value="<?= $dt['t_lahir'] ?>" class="form-control" required>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-2">
                    <label for="">Jenis Kelamin</label>
                </div>
                <div class="col-8">
                    <select name="j_kelamin" class="form-control" required id="">
                        <option value="<?= $dt['j_kelamin'] ?>"><?= $dt['j_kelamin'] ?></option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-2">
                    <label for="">Agama</label>
                </div>
                <div class="col-8">
                <select name="agama" class="form-control" required id="">
                        <option value="<?= $dt['agama'] ?>"><?= $dt['agama'] ?></option>
                        <option value="Islam">Islam</option>
                        <option value="Kristen">Kristen</option>
                        <option value="Katolik">Katolik</option>
                        <option value="Hindu">Hindu</option>
                        <option value="Buddha ">Buddha </option>
                        <option value="Khonghucu">Khonghucu</option>
                    </select>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-2">
                    <label for="">No Hp</label>
                </div>
                <div class="col-8">
                    <input type="text" value="<?= $dt['no_hp'] ?>" name="hp" class="form-control" required>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-2">
                    <label for="">Wali Kelas</label>
                </div>
                <div class="col-8">
                <input type="text" name="wakel" class="form-control" value="<?= $dt['wakel'] ?>" required>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-2">
                    <label for="">Foto</label>
                </div>
                <div class="col-8">
                <input type="file" name="foto" class="form-control">
                </div>
            </div>
            <br>
            <div>
                <button class="btn btn-primary" type="submit">Simpan</button>
                <button class="btn btn-danger" type="reset">Reset</button>
            </div>
        </form>
    </div>
<?= $this->endSection() ?>