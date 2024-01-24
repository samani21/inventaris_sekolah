<?= $this->extend('layout/page_layout') ?>

<?= $this->section('content') ?>

<form action="<?= base_url('tata_usaha/profil/'.session()->get('id_guru').'/'.session()->get('id').'') ?>" method="post" enctype="multipart/form-data">
<div class="row">
    <div class="col-6">
        <div>
            <label for="">NIP</label>
            <input type="text" name="nip" class="form-control" value="<?= $d_guru['nip'] ?>">
        </div>
        <div>
            <label for="">Nama</label>
            <input type="text" name="nama" class="form-control" value="<?= $d_guru['nama'] ?>">
        </div>
        <div>
            <label for="">Tempat Lahir</label>
            <div class="row">
                <div class="col-6">
                    <input type="text" name="tempat" class="form-control" value="<?= $d_guru['tempat'] ?>">
                </div>
                <div class="col-6">
                    <input type="date" name="t_lahir" class="form-control" value="<?= $d_guru['t_lahir'] ?>">
                </div>
            </div>
        </div>
        <div>
            <label for="">Jenis Kelamin</label>
            <input type="text" name="j_kelamin" class="form-control" value="<?= $d_guru['j_kelamin'] ?>">
        </div>
        <div>
            <label for="">Agama</label>
            <input type="text" name="agama" class="form-control" value="<?= $d_guru['agama'] ?>">
        </div>
        <div>
            <label for="">No Hp</label>
            <input type="text" name="hp" class="form-control" value="<?= $d_guru['no_hp'] ?>">
        </div>
    </div>
    <div class="col-6">
        <div align="center">
            <img src="<?= base_url() ?>/public/images/<?= $d_guru['foto'] ?>" class="img" alt="" width="27%">
        </div>
        <div>
            <label for="">Foto</label>
            <input type="file" name="foto" class="form-control">
        </div>
        <div>
            <label for="">Username</label>
            <input type="text" name="username" class="form-control" value="<?= session()->get('username') ?>">
        </div>
        <div>
            <label for="">Email</label>
            <input type="text" name="email" class="form-control" value="<?= session()->get('email') ?>">
        </div>
        <div>
            <label for="">Password</label>
            <input type="password" name="password" class="form-control" value="">
        </div>
        <br>
        <div>
            <button class="btn btn-primary">Ubah</button>
        </div>
    </div>
</div>
</form>
<?= $this->endSection() ?>
