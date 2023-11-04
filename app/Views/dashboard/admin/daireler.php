<?= $this->extend('layout/admin_template') ?>
<?= $this->section('content') ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper container">

    <div class="row">
        <div class="col-lg-8">
            <h2>Daireler</h2>
        </div>
        <div class="col-md-2">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">Daire Ekle</button>
        </div>
        
    </div>

    <table class="table table-bordered table-striped" id="userTable">
        <thead>
            <tr>
                <th>Blok Adı</th>
                <th>Daire No</th>
                <th>Daire Sakini</th> 
                <th>Aidat Borcu</th>
                <th width="280px">Action</th>
            </tr>
        </thead>
       <tbody>
    <?php foreach ($daireler as $daire) : ?>
        <tr id="<?= $daire['daire_id']; ?>">
            <td><?= $daire['blok_adi']; ?></td>
            <td><?= $daire['daire_no']; ?></td>
            <td><?= $daireSahipleri[$daire['daire_id']] ?? 'Daire sakini bulunamadı.'; ?></td>
            <td>
                <?php
                 if (empty($aidatBorcu) || $aidatBorcu==0) {
                    echo 'aidat borcu bulunamadı';
                 }
                if (!empty($aidatBorcu)) {
                    foreach ($aidatBorcu as $aidat) {
                        echo 'Aidat Tutarı: ' . $aidat['tutar'] . '<br>';
                        echo 'Aidat Ödeme Tarihi: ' . $aidat['odeme_tarihi'] . '<br>';
                    }
                } 
                ?>
            </td>
            <td>
                <a data-id="<?= $daire['daire_id']; ?>" class="btn btn-primary btnEdit">Edit</a>
                <a data-id="<?= $daire['daire_id']; ?>" class="btn btn-danger btnDelete">Delete</a>
                <a href="<?= base_url('profil/' . $daire['daire_id']) ?>" class="btn btn-info">Profil</a>
            </td>
        </tr>
    <?php endforeach; ?>
</tbody>

    </table>

    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">Daire Ekle</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="addUser" name="addUser" action="<?= site_url('daireler/store'); ?>" method="post">
                    <div class="modal-body">
                        <!-- input alanı -->
                        <div class="form-group">
                            <label for="txtBlokAdi">Blok Adı:</label>
                            <input type="text" class="form-control" id="txtBlokAdi" placeholder="Enter Blok Adı" name="txtBlokAdi">
                        </div>
                        <div class="form-group">
                            <label for="txtDaireNo">Daire No:</label>
                            <input type="text" class="form-control" id="txtDaireNo" placeholder="Enter Daire No" name="txtDaireNo">
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

    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">Update User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="updateUser" name="updateUser" action="<?= site_url('daireler/update'); ?>" method="post">
                    <div class="modal-body">
                        <input type="hidden" name="hdnUserId" id="hdnUserId"/>
                        <!-- input alanı -->
                        <div class="form-group">
                            <label for="txtBlokAdi">Blok Adı:</label>
                            <input type="text" class="form-control" id="txtBlokAdi" placeholder="Enter Blok Adı" name="txtBlokAdi">
                        </div>
                        <div class="form-group">
                            <label for="txtDaireNo">Daire No:</label>
                            <input type="text" class="form-control" id="txtDaireNo" placeholder="Enter Daire No" name="txtDaireNo">
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

<!-- /.content-wrapper -->
<?= $this->endSection('content') ?>

<?= $this->section('pageSpecificScript') ?>
<script>
   var userTable = $('#userTable').DataTable({
        "columnDefs": [
            { "targets": [3], "orderable": false },  // Disable sorting for column 3 (Aidat Borcu)
        ]
    });
    $(document).ready(function () {
        $("#addUser").validate({
            rules: {
                txtBlokAdi: "required",
                txtDaireNo: "required",
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
                            res.data.blok_adi,
                            res.data.daire_no,
                             'Daire sakini bulunamadı',
                'aidat borcu bulunamadı',
                            '<a data-id="' + res.data.daire_id + '" class="btn btn-primary btnEdit">Edit</a>' +
                            '<a data-id="' + res.data.daire_id + '" class="btn btn-danger btnDelete">Delete</a>'
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
            var daire_id = $(this).attr('data-id');
            $.ajax({
                url: 'daireler/edit/' + daire_id,
                type: "GET",
                dataType: 'json',
                success: function (res) {
                    $('#updateModal').modal('show');
                    $('#updateUser #hdnUserId').val(res.data.daire_id);
                    $('#updateUser #txtBlokAdi').val(res.data.blok_adi);
                    $('#updateUser #txtDaireNo').val(res.data.daire_no);
                },
                error: function (data) {}
            });
        });

        $("#updateUser").validate({
            rules: {
                txtBlokAdi: "required",
                txtDaireNo: "required",
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
                        var updatedRow = userTable.row('#' + res.data.daire_id);
                        updatedRow.data([
                            res.data.daire_id,
                            res.data.blok_adi,
                            res.data.daire_no,

                            '<a data-id="' + res.data.daire_id + '" class="btn btn-primary btnEdit">Edit</a>' +
                            '<a data-id="' + res.data.daire_id + '" class="btn btn-danger btnDelete">Delete</a>'
                        ]).draw();

                        $('#updateUser')[0].reset();
                        $('#updateModal').modal('hide');
                    },
                    error: function (data) {}
                });
            }
        });

        $('body').on('click', '.btnDelete', function () {
            var daire_id = $(this).attr('data-id');
            $.get('daireler/delete/' + daire_id, function (data) {
                userTable.row('#' + daire_id).remove().draw();
            });
        });
    
    });


  

</script>
<?= $this->endSection('pageSpecificScript') ?>
