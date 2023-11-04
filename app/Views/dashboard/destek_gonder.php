<?= $this->extend('layout/admin_template') ?>
<?= $this->section('content') ?>

<div class="content-wrapper container">
    <div>
        <h2>Destek Talebi Gönder</h2>
        <br>
        <form method="post" action="<?= base_url('destek_gonder/gonder'); ?>">
            <div class="form-group">
                <label for="talep_basligi">Başlık:</label>
                <input type="text" class="form-control" id="talep_basligi" name="baslik">
            </div>
            <div class="form-group">
                <label for="talep_metni">Talep Metni:</label>
                <textarea class="form-control" id="talep_metni" name="mesaj" rows="4"></textarea>
            </div>
            <button class="btn btn-primary" type="submit">Destek Talebini Gönder</button>
        </form>
    </div>
</div>

<?= $this->endSection('content') ?>
