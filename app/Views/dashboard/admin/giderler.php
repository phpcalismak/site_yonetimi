<?= $this->extend('layout/admin_template') ?>
<?= $this->section('content') ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper container">
    <div class="row">
        <div class="col-lg-10">
            <h2>Giderler</h2>
        </div>
        <div class="col-lg-2">
            <button type="button" class="btn btn-warning mb-3" data-bs-toggle="modal" data-bs-target="#kategoriModal">
                Kategorileri Düzenle
            </button>       
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addModal">
                Gider Ekle
            </button>
        </div>


        
    </div>
    <table class="table table-bordered table-striped" id="UserTable">
        <thead>
            <tr>
                <th>Kategori</th>
                <th>Ödenen Tutar</th>
                <th>Ödeme Tarihi</th>
                <th>Açıklama</th>
                <th>Fatura</th>
                <th width="280px">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($giderler as $gider) : ?>
                <tr id="<?= $gider['gider_id']; ?>">
                    <td><?= $gider['kategori_adi']; ?></td>
                    <td><?= $gider['odenen_tutar']; ?></td>
                    <td><?= $gider['son_odeme_tarihi']; ?></td> 
                    <td><?= $gider['aciklama']; ?></td>
                    <td><?= $gider['fatura_foto']; ?></td>
                    <td>
                        <a data-id="<?= $gider['gider_id']; ?>" class="btn btn-primary btnEdit">Düzenle</a>
                        <a data-id="<?= $gider['gider_id']; ?>" class="btn btn-danger btnDelete">Sil</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

<!-- Ekleme Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">Gider Ekle</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="addUser" name="addUser" action="<?= site_url('giderler/store'); ?>" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="txtKategori">Gider Kategorisi:</label>
                            <select class="form-control" id="txtKategori" name="txtKategori">
                                <option value="">Kategori Seçin</option>
                                <?php foreach ($giderKategorileri as $kategori) : ?>
                                    <option value="<?= $kategori['kategori_id']; ?>"><?= $kategori['kategori_adi']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="txtOdenenTutar">Ödenen Tutar:</label>
                            <input type="text" class="form-control" id="txtOdenenTutar" placeholder="Ödenen Tutar" name="txtOdenenTutar">
                        </div>
                            <div class="form-group">
                            <label for="txtSonOdemeTarihi">Son Ödeme Tarihi:</label>
                            <input type="text" class="form-control" id="txtSonOdemeTarihi" placeholder="Son Ödeme Tarihi" name="txtSonOdemeTarihi">
                        </div>
                         <div class="form-group">
                            <label for="txtAciklama">Açıklama:</label>
                            <input type="text" class="form-control" id="txtAciklama" placeholder="Açıklama" name="txtAciklama">
                        </div>
                         <div class="form-group">
                            <label for="txtFoto">Varsa Fatura Fotoğrafı:</label>
                            <input type="file" class="form-control" id="txtFoto" placeholder="" name="txtFoto">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
                        <button type="submit" class="btn btn-primary">Kaydet</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">Update Gider</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="updateUserForm" name="updateUserForm" action="<?= site_url('giderler/update'); ?>" method="post">
                <input type="hidden" name="hdnUserId" id="hdnUserId" />
                <div class="modal-body">
                    <div class="form-group">
                        <label for="txtKategori">Gider Kategorisi:</label>
                        <select class="form-control" id="txtKategori" name="txtKategori">
                            <option value="">Kategori Seçin</option>
                            <?php foreach ($giderKategorileri as $kategori) : ?>
                                <option value="<?= $kategori['kategori_id']; ?>"><?= $kategori['kategori_adi']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="txtOdenenTutar">Ödenen Tutar:</label>
                        <input type="text" class="form-control" id="txtOdenenTutar" name="txtOdenenTutar" placeholder="Ödenen Tutar">
                    </div>
                    <div class="form-group">
                        <label for="txtSonOdemeTarihi">Son Ödeme Tarihi:</label>
                        <input type="text" class="form-control" id="txtSonOdemeTarihi" name="txtSonOdemeTarihi" placeholder="Son Ödeme Tarihi">
                    </div>
                    <div class="form-group">
                        <label for="txtAciklama">Açıklama:</label>
                        <input type="text" class="form-control" id="txtAciklama" name="txtAciklama" placeholder="Açıklama">
                    </div>
                    <div class="form-group">
                        <label for="txtFoto">Fatura Fotoğrafı:</label>
                        <input type="file" class="form-control" id="txtFoto" name="txtFoto" placeholder="Fatura Fotoğrafı">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Gider Kategorisi Modal -->
<div class="modal fade" id="kategoriModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">Kategorileri Düzenle</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Kategori Adı</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($giderKategorileri as $kategori): ?>
                            <tr id="<?= $kategori['kategori_id'] ?>">
                                <td><?= $kategori['kategori_adi'] ?></td>
                                <td>
                                    <button type="button" class="btn btn-primary btnEditKategori" data-id="<?= $kategori['kategori_id'] ?>">Düzenle</button>
                                    <button type="button" class="btn btn-danger btnDeleteKategori" data-id="<?= $kategori['kategori_id'] ?>">Sil</button>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
            <form id="addKategori" name="addKategori" action="<?= site_url('giderler/kategori'); ?>" method="post">
                <div class="modal-footer">
                    <div class="form-group">
                        <input type="text" class="form-control" id="txtKategori" placeholder="Gider Kategorisi" name="txtKategori">
                    </div>
                    <button type="submit" class="btn btn-primary">Kategoriyi Ekle</button>
                </div>
            </form>
        </div>
    </div>
</div>

</div>
<!-- /.content-wrapper -->
<?= $this->endSection('content') ?>


<?= $this->section('pageSpecificScript') ?>
<script>
     $(document).ready(function () {
        var userTable = $('#UserTable').DataTable();

        $("#addUser").validate({
            rules: {
                txtKategori: "required",
                txtSonOdemeTarihi: "required",
                txtAciklama: "required",

            },
            messages: {},
            submitHandler: function (form) {
                var form_action = $("#addUser").attr("action");
                $.ajax({
                    data: $('#addUser').serialize(),
                    url: form_action,
                    type: "POST",
                    dataType: 'json',
                    success: function (res) {
                        var newRow = [
                            res.data.gider_id,
                            res.data.kategori_id,
                            res.data.odenen_tutar,
                            res.data.son_odeme_tarihi,
                            res.data.aciklama,
                            '<a data-id="' + res.data.gider_id + '" class="btn btn-primary btnEdit">Düzenle</a>' +
                            '<a data-id="' + res.data.gider_id + '" class="btn btn-danger btnDelete">Sil</a>'
                        ];
                        
                        userTable.row.add(newRow).draw(false);

                        $('#addUser')[0].reset();
                        $('#addModal').modal('hide');
                    },
                    error: function (data) {}
                });
            }
        });


      
    $('body').on('click', '.btnEdit', function () {
    var gider_id = $(this).attr('data-id');
    $.ajax({
        url: 'giderler/edit/' + gider_id,
        type: "GET",
        dataType: 'json',
        success: function (res) {
            $('#updateModal').modal('show');
            $('#updateUserForm #hdnUserId').val(res.data.gider_id);
            $('#updateUserForm #txtKategori').val(res.data.kategori_id);
            $('#updateUserForm #txtOdenenTutar').val(res.data.odenen_tutar);
            $('#updateUserForm #txtSonOdemeTarihi').val(res.data.son_odeme_tarihi);
            $('#updateUserForm #txtAciklama').val(res.data.aciklama);
        },
        error: function (data) {}
    });
});

$("#updateUserForm").validate({
    rules: {
        txtKategori: "required",
        txtOdenenTutar: "required",
        txtSonOdemeTarihi: "required",
        txtAciklama: "required"
    },
    messages: {},
    submitHandler: function (form) {
        var form_action = $("#updateUserForm").attr("action");
        $.ajax({
            data: $('#updateUserForm').serialize(),
            url: form_action,
            type: "POST",
            dataType: 'json',
            success: function (res) {
                var updatedRow = userTable.row('#' + res.data.gider_id);
                updatedRow.data([
                    res.data.gider_id,
                    res.data.kategori_id,
                    res.data.odenen_tutar,
                    res.data.son_odeme_tarihi,
                    res.data.aciklama,
                    '<a data-id="' + res.data.gider_id + '" class="btn btn-primary btnEdit">Düzenle</a>' +
                    '<a data-id="' + res.data.gider_id + '" class="btn btn-danger btnDelete">Sil</a>'
                ])
                $('#updateUserForm')[0].reset();
                $('#updateModal').modal('hide');
                location.reload();
            },
            error: function (data) {}
        });
    }
});

        $('body').on('click', '.btnEditKategori', function () {
            var kategori_id = $(this).attr('data-id');

            $.ajax({
                url: '<?= site_url('giderler/giderkategoriduzenle/') ?>' + kategori_id,
                type: 'GET',
                dataType: 'json',
                success: function (res) {
                    if (res.status) {
                        // Populate the edit modal with category details
                        $('#editKategoriModal #kategori_id').val(res.data.kategori_id);
                        $('#editKategoriModal #txtEditKategori').val(res.data.kategori_adi);
                        $('#editKategoriModal').modal('show');
                    } else {
                        alert('Kategori bilgileri alınamadı.');
                    }
                },
                error: function () {
                    alert('Bir hata oluştu.');
                }
            });
        });
    
    });

// EXCEL BUTONU 

  
</script>
<?= $this->endSection('pageSpecificScript') ?>
 