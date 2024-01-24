<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        
    <title>Tambah Guru</title>
</head>
<body>
    <div class="container">
        <h2 align="center">TAMBAH DATA GURU</h2>
        <hr>
        <form action="<?= base_url('tata_usaha/store')?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="user_id" value="<?= session()->get('id'); ?>" class="form-control" required>
            <div class="row">
                <div class="col-2">
                    <label for="">NIP</label>
                </div>
                <div class="col-8">
                    <input type="text" name="nip" class="form-control" required>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-2">
                    <label for="">Nama</label>
                </div>
                <div class="col-8">
                    <input type="text" name="nama" class="form-control" required>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-2">
                    <label for="">TTL</label>
                </div>
                <div class="col-4">
                    <input type="text" name="tempat" class="form-control" required>
                </div>
                <div class="col-4">
                    <input type="date" name="t_lahir" class="form-control" required>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-2">
                    <label for="">Jenis Kelamin</label>
                </div>
                <div class="col-8">
                    <select name="j_kelamin" class="form-control" required id="">
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
                    <input type="text" name="no_hp" class="form-control" required>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-2">
                    <label for="">Foto</label>
                </div>
                <div class="col-8">
                <input type="file" name="foto" class="form-control" required>
                </div>
            </div>
            <br>
            <div>
                <button class="btn btn-primary" type="submit">Simpan</button>
                <button class="btn btn-danger" type="reset">Reset</button>
            </div>
        </form>
    </div>
</body>
</html>