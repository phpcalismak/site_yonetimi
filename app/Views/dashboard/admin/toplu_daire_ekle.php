<?= $this->extend('layout/admin_template') ?>
<?= $this->section('content') ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper container">
    <h1>Blok ve Daire Sayısı Formu</h1>

    <form action="<?= base_url('toplu_daire_ekle') ?>" method="post">
        <label for="block_count">Blok Sayısı:</label>
        <input type="number" id="block_count" name="block_count" required>

        <label for="apartments_per_block">Her Bloktaki Daire Sayısı:</label>
        <input type="number" id="apartments_per_block" name="apartments_per_block" required>

        <button type="submit">Oluştur</button>
    </form>
</body>
</html>
<?= $this->endSection('content') ?>