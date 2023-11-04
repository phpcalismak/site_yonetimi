<!-- views/layout/admin_template.php dosyasının içeriği -->

<?= $this->extend('layout/admin_template') ?>
<?= $this->section('content') ?>

<div class="content-wrapper container">
    <style>
        /* CSS ile active başlığı özelleştirin */
        .list-group-item.active {
            background-color: #007bff;
            color: #fff;
            border-color: #007bff;
        }

        /* talep Sil butonunun stilini özelleştirin */
        .delete-talep-btn {
            background-color: #dc3545;
            color: #fff;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }
    </style>
    <button id="openModalButton" class="btn btn-primary">Duyuru Ekle</button>
    <div class="container mt">
        <div class="row">
            <!-- BEGIN INBOX -->
            <div class="col-md-12">
                <div class="grid email">
                    <div class="grid-body">
                        <div class="row">
                            <!-- BEGIN INBOX MENU -->
                            <div class="col-md-3">
                                <h2 class="grid-title"><i class="fa fa-inbox"></i>Duyurular</h2>
                            </div>
                            <div class="col-md-6 search-form">
                                <form action="#" class="text-right">
                                    <div class="input-group">
                                        <input type="text" class="form-control input-sm" placeholder="Search">
                                        <span class="input-group-btn">
                                            <button type="submit" name="search" class="btn_ btn-primary btn-sm search">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </span>
                                    </div>
                                </form>
                            </div>
                            <hr>
                        </div>
                        <!-- END INBOX MENU -->
                        <!-- BEGIN INBOX CONTENT -->
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label style="margin-right: 8px;" class="">
                                        <div class="icheckbox_square-blue" style="position: relative;">
                                            <input type="checkbox" id="check-all" class="icheck" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);">
                                            <ins class="iCheck-helper" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins>
                                        </div>
                                    </label>
                                </div>
                            </div>
                            <div class="padding"></div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Duyuru Başlığı</th>
                                            <th>Tarih</th>
                                          
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Email content goes here -->
                                        <?php foreach ($duyurular as $duyuru): ?>
                                            <tr>
                                                <td class="name">
                                                    <a href="#" class="talep-link" data-talep-metni="<?= $duyuru['duyuru_metni']; ?>"><?= $duyuru['duyuru_basligi']; ?></a>
                                                </td>
                                                <td class="time"><?= $duyuru['duyuru_tarihi'] ?></td>
                                              
                                                <td>
                                                    <button class="delete-talep-btn float-right" data-talep-id="<?= $duyuru['duyuru_id']; ?>">Sil</button>
                                                </td>

                                            </tr>
                                        <?php endforeach; ?>
                                        <!-- End of email content -->
                                    </tbody>
                                </table>
                            </div>
                            <ul class="pagination">
                                <li class="disabled"><a href="#">«</a></li>
                                <li class="active"><a href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">4</a></li>
                                <li><a href="#">5</a></li>
                                <li><a href="#">»</a></li>
                            </ul>
                        </div>
                        <!-- END INBOX CONTENT -->
                        <!-- BEGIN COMPOSE MESSAGE -->
                     <div class="modal fade" id="talepModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Duyuru Detayları</h5>
               
                
                </button>
            </div>
            <div class="modal-body">
                <h4 id="talepBasligi"></h4>
                <p id="talepTarihi"></p>
                <p id="talepMetni"></p>
            </div>
        </div>
    </div>
</div>
  <div id="duyuruModal" class="modal">
        <div class="modal-content">
            <span class="close" id="closeModal">&times;</span>
            <h2>Duyuru Ekle</h2>
            <form method="post" action="<?= base_url('duyuru_post'); ?>">
                <label for="baslik">Duyuru Başlığı:</label>
                <input type="text" id="baslik" name="baslik">
                <br>
                <label for="mesaj">Duyuru Metni:</label>
                <textarea id="mesaj" name="mesaj" rows="4" cols="50"></textarea>
                <br>
                <button class="btn btn-primary" type="submit">Duyuru Gönder</button>
            </form>
        </div>
    </div>
                        <!-- END COMPOSE MESSAGE -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $(".talep-link").click(function () {
            var talepMetni = $(this).data("talep-metni");
            var talepBasligi = $(this).text();
            var talepTarihi = $(this).closest("tr").find(".time").text();

            $("#talepBasligi").text("Konu: " + talepBasligi);
            $("#talepTarihi").text("Tarih: " + talepTarihi);
            $("#talepMetni").text(talepMetni);

            $("#talepModal").modal("show");
        });
        
          $("#openModalButton").click(function () {
        $("#duyuruModal").show();
    });

        $(".delete-talep-btn").click(function () {
            var talepId = $(this).data("talep-id");
            if (confirm("Talebi silmek istediğinizden emin misiniz?")) {
                $.ajax({
                    type: "POST",
                    url: "<?= base_url('/destek_talepleri/delete/') ?>" + talepId,
                    success: function (response) {
                        if (response.success) {
                            location.reload();
                        } else {
                            location.reload();
                        }
                    },
                });
            }
        });
    });
</script>

<?= $this->endSection('content') ?>
