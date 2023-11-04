 <?= $this->extend('layout/admin_template') ?>
<?= $this->section('content') ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper container">


    <div class="row">
        <div class="col-lg-8">
            <h2>Gelirler</h2>
        </div>



        <div class="col-md-2">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                Gelir Ekle
            </button>
        </div>
    </div>
    <table class="table table-bordered table-striped" id="userTable">
        <thead>
            <tr>
                <th>Açıklama</th>
                <th>Tarih</th>
                <th>Tutar</th>
                <th width="280px">İşlem</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($gelirler as $gelir) : ?>
                <tr id="<?= $gelir['gelir_id']; ?>">
                    <td><?= $gelir['aciklama']; ?></td>
                    <td><?= $gelir['tarih']; ?></td>
                    <td><?= $gelir['tutar']; ?></td>
                    <td>
                        <a data-id="<?= $gelir['gelir_id']; ?>" class="btn btn-primary btnEdit">Düzenle</a>
                        <a data-id="<?= $gelir['gelir_id']; ?>" class="btn btn-danger btnDelete">Sil</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>


    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">Gelir Ekle</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="addUser" name="addUser" action="<?= site_url('gelirler/store'); ?>" method="post">
                    <div class="modal-body">

                        <!--   input alanı -->
                       
                        <div class="form-group">
                            <label for="txtAciklama">Açıklama:</label>
                            <input type="text" class="form-control" id="txtAciklama" placeholder="Açıklama girin" name="txtAciklama">
                        </div>
                         <div class="form-group">
                            <label for="txtTarih">Tarih:</label>
                            <input type="text" class="form-control" id="txtTarih" placeholder="Ödenmesi gereken tarih" name="txtTarih">
                        </div>
                         <div class="form-group">
                            <label for="txtTutar">Tutar:</label>
                            <input type="text" class="form-control" id="txtTutar" placeholder="Aidat Tutarı" name="txtTutar">
                        </div>
                        

                        <!-- input alanı bitiş -->

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
                        <button type="submit" class="btn btn-primary">Kaydet</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">Gelir Düzenle</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="updateUser" name="updateUser" action="<?= site_url('gelirler/update'); ?>" method="post">
                    <div class="modal-body">
                        <input type="hidden" name="hdnUserId" id="hdnUserId"/>
                      <!-- ***************   input alanı ******************* -->
                        <div class="form-group">
                            <label for="txtAciklama">Açıklama:</label>
                            <input type="text" class="form-control" id="txtAciklama" placeholder="Açıklama girin" name="txtAciklama">
                        </div>

                         <div class="form-group">
                            <label for="txtTarih">Ödeme Tarihi:</label>
                            <input type="text" class="form-control" id="txtTarih" placeholder="Enter Password" name="txtTarih">
                        </div>
                         <div class="form-group">
                            <label for="txtTutar">Tutar:</label>
                            <input type="text" class="form-control" id="txtTutar" placeholder="Enter tutar" name="txtTutar">
                        </div>
                      


                         <!--************* input alanı bitiş ***************-->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
                        <button type="submit" class="btn btn-primary">Kaydet</button>
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
    var userTable = $('#userTable').DataTable({
        "paging" : true,
        "pageLength" : 10,
    });
    $(document).ready(function () {
    $("#addUser").validate({
        rules: {
          
            txtAciklama: "required",
            txtTarih: "required",
            txtTutar: "required",
          
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
                        res.data.gelir_id,
                        res.data.aciklama,
                        res.data.tarih,
                        res.data.tutar,
                      
                        '<a data-id="' + res.data.gelir_id + '" class="btn btn-primary btnEdit">Edit</a>' +
                        '<a data-id="' + res.data.gelir_id + '" class="btn btn-danger btnDelete">Delete</a>'
                    ];
                    
                    userTable.row.add(newRow).draw(false);

                    $('#addUser')[0].reset();
                    $('#addModal').modal('hide');
                },
                error: function (data) {}
            });
        }
    });
  // Edit button click event
    $('body').on('click', '.btnEdit', function () {
        var gelir_id = $(this).attr('data-id');
        $.ajax({
            url: 'gelirler/edit/' + gelir_id,
            type: "GET",
            dataType: 'json',
            success: function (res) {
                $('#updateModal').modal('show');
                $('#updateUser #hdnUserId').val(res.data.gelir_id);
                $('#updateUser #txtAciklama').val(res.data.aciklama);
                $('#updateUser #txtTarih').val(res.data.tarih); // Fix the field name
                $('#updateUser #txtTutar').val(res.data.tutar);
            },
            error: function (data) {}
        });
    });
    

    $("#updateUser").validate({
        rules: {
            txtAciklama: "required",
            txtTarih: "required",
            txtTutar: "required",
          
        },
        messages: {},
        submitHandler: function (form) {
            var form_action = $("#updateUser").attr("action");
            $.ajax({
                data: $('#updateUser').serialize(),
                url: form_action,
                type: "POST",
                dataType: 'json',
                success: function (res) {
                    var updatedRow = userTable.row('#' + res.data.gelir_id);
                    updatedRow.data([
                        res.data.gelir_id,
                        res.data.aciklama,
                        res.data.tarih,
                        res.data.tutar,
                      
                        '<a data-id="' + res.data.gelir_id + '" class="btn btn-primary btnEdit">Edit</a>' +
                        '<a data-id="' + res.data.gelir_id + '" class="btn btn-danger btnDelete">Delete</a>'
                    ]).draw();

                    $('#updateUser')[0].reset();
                    $('#updateModal').modal('hide');
                },
                error: function (data) {}
            });
        }
    });
    $('body').on('click', '.btnDelete', function () {
            var gelir_id = $(this).attr('data-id');

            // Show a confirmation dialog
            var confirmDelete = confirm("Silmek istediğinizden emin misiniz?");
            
            if (confirmDelete) {
                $.ajax({
                    url: 'gelirler/delete/' + gelir_id,
                    type: "GET",
                    dataType: 'json',
                    success: function (res) {
                        if (res.status === true) {
                            // Aidat successfully deleted, remove the row
                            userTable.row('#' + gelir_id).remove().draw();
                        } else {
                            // Handle deletion failure, display an error message if needed
                            alert("Silinirken bir hata oluştu.");
                        }
                    },
                    error: function (data) {
                        // Handle AJAX error
                        alert("Silinirken bir hata oluştu.");
                    }
                });
            }
        });
 });
</script>
<?= $this->endSection('pageSpecificScript') ?>
 