<?= $this->extend('layout/admin_template') ?>
<?= $this->section('content') ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper me-3 container">

    <div class="row">
        <div class="col-lg-8">
            <h2>Personeller</h2>
        </div>

        <div class="col-md-2">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                Personel Ekle
            </button>
        </div>
    </div>
    <table class="table table-bordered table-striped" id="userTable">
        <thead>
            <tr>
                <th>Ad Soyad</th>
                <th>Pozisyon</th>
                <th>Kimlik No</th>
                <th>Telefon</th>
                <th>E-posta adresi</th>
                <th>Maaş</th>
                <th width="280px">İşlem</th>
            </tr>
        </thead>
        <tbody>
               <?php foreach ($personeller as $personel) : ?>
               <tr id="<?= $personel['personel_id']; ?>">
                    <td><?= $personel['ad_soyad'] ?></td>
                      <td><?= $personel['pozisyon']; ?></td>
                    <td><?= $personel['kimlik_no']; ?></td>
                     <td><?= $personel['telefon']; ?></td>
                      <td><?= $personel['eposta']; ?></td>
                      <td><?= $personel['maas']; ?></td>

            <td>
        <a data-id="<?= $personel['personel_id']; ?>" class="btn btn-primary btnEdit">Düzenle</a>
        <a data-id="<?= $personel['personel_id']; ?>" class="btn btn-danger btnDelete">Sil</a>
    </td>
</tr>
         <?php endforeach; ?>         
        
        </tbody>
    </table>


    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">Personel Ekle</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="addUser" name="addUser" action="<?= site_url('personel/store'); ?>" method="post">
                    <div class="modal-body">

                        <!--   input alanı -->
                        <div class="form-group">
                            <label for="txtAdSoyad">Ad Soyad:</label>
                            <input type="text" class="form-control" id="txtAdSoyad"  name="txtAdSoyad">
                        </div>
                          <!--   input alanı -->
                        <div class="form-group">
                            <label for="txtPozisyon">Pozisyon:</label>
                            <input type="text" class="form-control" id="txtPozisyon"  name="txtPozisyon">
                        </div>
                      
                         <div class="form-group">
                            <label for="txtKimlikNo">Tc Kimlik No:</label>
                            <input type="text" class="form-control" id="txtKimlikNo"  name="txtKimlikNo">
                        </div>
                       <div class="form-group">
                            <label for="txtTelefon">Telefon:</label>
                            <input type="text" class="form-control" id="txtTelefon"  name="txtTelefon">
                        </div>
                       <div class="form-group">
                            <label for="txtEposta">Eposta:</label>
                            <input type="text" class="form-control" id="txtEposta"  name="txtEposta">
                        </div>
                          <div class="form-group">
                            <label for="txtMaas">Maaş:</label>
                            <input type="number" class="form-control" id="txtMaas"  name="txtMaas">
                        </div>
                     
                        

                        <!-- input alanı bitiş -->

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
                    <h5 class="modal-title" id="ModalLabel">Personel Verilerini Güncelle</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="updateUser" name="updateUser" action="<?= site_url('personel/update'); ?>" method="post">
                    <div class="modal-body">
                        <input type="hidden" name="hdnUserId" id="hdnUserId"/>
                      <!-- ***************   input alanı ******************* -->
                       <!--   input alanı -->
                        <div class="form-group">
                            <label for="txtAdSoyad">Ad Soyad:</label>
                            <input type="text" class="form-control" id="txtAdSoyad"  name="txtAdSoyad">
                        </div>
                          <!--   input alanı -->
                        <div class="form-group">
                            <label for="txtPozisyon">Pozisyon:</label>
                            <input type="text" class="form-control" id="txtPozisyon"  name="txtPozisyon">
                        </div>
                      
                         <div class="form-group">
                            <label for="txtKimlikNo">Tc Kimlik No:</label>
                            <input type="text" class="form-control" id="txtKimlikNo"  name="txtKimlikNo">
                        </div>
                       <div class="form-group">
                            <label for="txtTelefon">Telefon:</label>
                            <input type="text" class="form-control" id="txtTelefon"  name="txtTelefon">
                        </div>
                        <div class="form-group">
                            <label for="txtEposta">Eposta:</label>
                            <input type="text" class="form-control" id="txtEposta"  name="txtEposta">
                        </div>
                        <div class="form-group">
                            <label for="txtMaas">Maaş:</label>
                            <input type="number" class="form-control" id="txtMaas"  name="txtMaas">
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
    var userTable = $('#userTable').DataTable();
    $(document).ready(function () {
        $("#addUser").validate({
            rules: {
                txtAdSoyad: "required",
                txtPozisyon: "required",
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
                          
                            res.data.ad_soyad,
                            res.data.pozisyon,
                            res.data.kimlik_no,
                            res.data.telefon,
                            res.data.eposta,
                            res.data.maas,
                            '<div class="btn-group">' +
                            '<button type="button" class="btn btn-primary btnEdit" data-id="' + res.data.personel_id + '">Düzenle</button>' +
                            '<button type="button" class="btn btn-danger btnDelete" data-id="' + res.data.personel_id + '">Sil</button>' +
                            '</div>'
                        ];

                        userTable.row.add(newRow).draw(false);

                        $('#addUser')[0].reset();
                        $('#addModal').modal('hide');
                    },
                    error: function (data) { }
                });
            }
        });

        $('body').on('click', '.btnEdit', function () {
            var personel_id = $(this).data('id');
            $.ajax({
                url: 'personel/edit/' + personel_id,
                type: "GET",
                dataType: 'json',
                success: function (res) {
                    $('#updateModal').modal('show');
                    $('#updateUser #hdnUserId').val(res.data.personel_id);
                   $('#updateUser #txtAdSoyad').val(res.data.ad_soyad);
                    $('#updateUser #txtPozisyon').val(res.data.pozisyon);
                     $('#updateUser #txtKimlikNo').val(res.data.kimlik_no);
                      $('#updateUser #txtTelefon').val(res.data.telefon);
                         $('#updateUser #txtEposta').val(res.data.eposta);
                            $('#updateUser #txtMaas').val(res.data.maas);

                
                },
                error: function (data) { }
            });
        });

        $("#updateUser").validate({
            rules: {
               txtAdSoyad: "required",
                txtPozisyon: "required",
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
                        var updatedRow = userTable.row('#' + res.data.personel_id);
                        updatedRow.data([
                           
                            res.data.ad_soyad,
                            res.data.pozisyon,
                            res.data.kimlik_no,
                            res.data.telefon,
                            res.data.eposta,
                            res.data.maas,
                            '<div class="btn-group">' +
                            '<button type="button" class="btn btn-primary btnEdit" data-id="' + res.data.personel_id + '">Düzenle</button>' +
                            '<button type="button" class="btn btn-danger btnDelete" data-id="' + res.data.personel_id + '">Sil</button>' +
                            '</div>'
                        ]).draw();

                        $('#updateUser')[0].reset();
                        $('#updateModal').modal('hide');
                    },
                    error: function (data) { }
                });
            }
        });

        $('body').on('click', '.btnDelete', function () {
            var personel_id = $(this).attr('data-id');
            $.get('personel/delete/' + personel_id, function (data) {
                userTable.row('#' + personel_id).remove().draw();
            })
        });

           });
</script>


<?= $this->endSection('pageSpecificScript') ?>
 