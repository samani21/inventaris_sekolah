<?= $this->extend('layout/page_layout') ?>

<?= $this->section('content') ?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?= $data ?>    
        </div>
    </div>
</div>
<?= $this->endSection() ?>
