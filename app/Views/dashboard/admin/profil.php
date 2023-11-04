    <?= $this->extend('layout/admin_template') ?>
    <?= $this->section('content') ?>

 <section>
    <div class="container py-5">
        <div class="row">
            <div class="col md-8">
                <nav aria-label="breadcrumb" class="bg-light rounded-3  mb-4">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item active" aria-current="page">Profil</li>
                    </ol>
                </nav>
            </div>
 
            <button style="height:50px" type="button" class="btn btn-success mr-2" data-bs-toggle="modal" data-bs-target="#addModal">
                Veri Ekle 
            </button>
       
        
            <button style="height:50px" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">
                Düzenle 
            </button>
        </div>


      
            <div class="row">
                <div class="col-lg-4">
                 <div class="card mb-4">
            <div class="card-body text-center">
                <h5 class="my-3"><?= $profilData->ad_soyad ?? 'Veri yok' ?></h5>
                <p class="text-muted mb-1"><?= $profilData->sakin_turu ?? 'Veri yok' ?></p>
                <p class="text-muted mb-4"></p>
                <div class="d-flex justify-content-center mb-2">
                </div>
            </div>
                    </div>
                    <div class="card mb-4 mb-lg-0">
                        <div class="card-body p-0">
                            <ul class="list-group list-group-flush rounded-3">
                                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                    <i class="fas fa-globe fa-lg text-warning"></i>
                                    <?php if (!empty($profilData->email)): ?>
                                        <p class="mb-0"><?= $profilData->email ?></p>
                                    <?php else: ?>
                                        <p class="mb-0">Veri yok</p>
                                    <?php endif; ?>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                    <i class="fab fa-github fa-lg" style="color: #333333;"></i>
                                    <?php if (!empty($profilData->sifre)): ?>
                                        <p class="mb-0"><?= $profilData->sifre ?></p>
                                    <?php else: ?>
                                        <p class="mb-0">Veri yok</p>
                                    <?php endif; ?>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Daire No</p>
                                </div>
                                <div class="col-sm-9">
                                        <p class="text-muted mb-0"><?= $profilData->daire_no ?></p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Blok Adı</p>
                                </div>
                                <div class="col-sm-9">
                                  
                                        <p class="text-muted mb-0"><?= $profilData->blok_adi ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4 mb-lg-0">
                        <div class="card-body p-0">
                            <ul class="list-group list-group-flush rounded-3">
                                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                    <p class="mb-0">Ad Soyad</p>
                                    <?php if (!empty($profilData->ad_soyad)): ?>
                                        <p class="mb-0"><?= $profilData->ad_soyad ?></p>
                                    <?php else: ?>
                                        <p class="mb-0">Veri yok</p>
                                    <?php endif; ?>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                    <p class="mb-0">Tc Kimlik No</p>
                                    <?php if (!empty($profilData->tc_no)): ?>
                                        <p class="mb-0"><?= $profilData->tc_no ?></p>
                                    <?php else: ?>
                                        <p class="mb-0">Veri yok</p>
                                    <?php endif; ?>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                    <p class="mb-0">Telefon No</p>
                                    <?php if (!empty($profilData->telefon)): ?>
                                        <p class="mb-0"><?= $profilData->telefon ?></p>
                                    <?php else: ?>
                                        <p class="mb-0">Veri yok</p>
                                    <?php endif; ?>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
       
    </div>
</section>
 

    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">Düzenle</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="addUser" name="addUser" action="<?= base_url('profil/ekle'); ?>" method="POST">
                    <div class="modal-body">
                          <div class="form-group">
                            <input type="hidden" class ="form-control" name="hdnUserId" id="hdnUserId" value="<?= $profilData->daire_id ?>" />
                       </div>
                <div class="form-group">
                            <label for="ad_soyad">Ad Soyad:</label>
                           <input type="text" class="form-control" id="ad_soyad" name="ad_soyad" value="<?= $profilData->ad_soyad ?? '' ?>">

                        </div>
                        <div class="form-group">
                            <label for="sakin_turu">Sakin Türü:</label>
                            <input type="text" class="form-control" id="sakin_turu" name="sakin_turu" value="<?= $profilData->sakin_turu ?? '' ?>">
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="text" class="form-control" id="email" name="email" value="<?= $profilData->email ?? '' ?>">
                        </div>
                        <div class="form-group">
                            <label for="sifre">Şifre:</label>
                            <input type="password" class="form-control" id="sifre" name="sifre" value="<?= $profilData->sifre ?? '' ?>">
                        </div>
                        <div class="form-group">
                            <label for="tc_no">Tc Kimlik No:</label>
                            <input type="text" class="form-control" id="tc_no" name="tc_no" value="<?= $profilData->tc_no ?? '' ?>">
                        </div>
                        <div class="form-group">
                            <label for="telefon">Telefon No:</label>
                            <input type="text" class="form-control" id="telefon" name="telefon" value="<?= $profilData->telefon ?? '' ?>">
                        </div>
                        <div class="form-group">
                            <label for="blok_adi">Blok Adı:</label>
                            <input type="text" class="form-control" id="blok_adi" name="blok_adi" value="<?= $profilData->blok_adi ??'' ?>">
                        </div>
                        <div class="form-group">
                            <label for="daire_no">Daire No:</label>
                            <input type="text" class="form-control" id="daire_no" name="daire_no" value="<?= $profilData->daire_no ?? '' ?>">
                        </div>

                        <!-- input alanı bitiş -->

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button id = "saveAddButton" type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

 

    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">Düzenle</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="addUser" name="addUser" action="<?= base_url('profil/guncelle'); ?>" method="POST">
                    <div class="modal-body">
                          <div class="form-group">
                            <input type="hidden" class ="form-control" name="hdnUserId" id="hdnUserId" value="<?= $profilData->daire_id ?>" />
                       </div>
                <div class="form-group">
                            <label for="ad_soyad">Ad Soyad:</label>
                           <input type="text" class="form-control" id="ad_soyad" name="ad_soyad" value="<?= $profilData->ad_soyad ?? '' ?>">

                        </div>
                        <div class="form-group">
                            <label for="sakin_turu">Sakin Türü:</label>
                            <input type="text" class="form-control" id="sakin_turu" name="sakin_turu" value="<?= $profilData->sakin_turu ?? '' ?>">
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="text" class="form-control" id="email" name="email" value="<?= $profilData->email ?? '' ?>">
                        </div>
                        <div class="form-group">
                            <label for="sifre">Şifre:</label>
                            <input type="password" class="form-control" id="sifre" name="sifre" value="<?= $profilData->sifre ?? '' ?>">
                        </div>
                        <div class="form-group">
                            <label for="tc_no">Tc Kimlik No:</label>
                            <input type="text" class="form-control" id="tc_no" name="tc_no" value="<?= $profilData->tc_no ?? '' ?>">
                        </div>
                        <div class="form-group">
                            <label for="telefon">Telefon No:</label>
                            <input type="text" class="form-control" id="telefon" name="telefon" value="<?= $profilData->telefon ?? '' ?>">
                        </div>
                        <div class="form-group">
                            <label for="blok_adi">Blok Adı:</label>
                            <input type="text" class="form-control" id="blok_adi" name="blok_adi" value="<?= $profilData->blok_adi ??'' ?>">
                        </div>
                        <div class="form-group">
                            <label for="daire_no">Daire No:</label>
                            <input type="text" class="form-control" id="daire_no" name="daire_no" value="<?= $profilData->daire_no ?? '' ?>">
                        </div>

                        <!-- input alanı bitiş -->

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button id = "saveProfileButton" type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?= $this->endSection('content') ?>
  <?= $this->section('pageSpecificScript') ?>
<script>
    $(document).ready(function() {
        // Formun gönderilmesi işlemi
        $("#saveProfileButton").click(function() {
            // Form verilerini al
            var formData = $("#addUser").serialize();

            // AJAX isteği gönder
            $.ajax({
                type: "POST",
                url: "<?= base_url('profil/guncelle') ?>", // Profil güncelleme URL'si
                data: formData,
                success: function(response) {
                    // Başarılı işlem sonrası modalı kapatma işlemi
                    $("#editModal").modal("hide");
                    // Sayfayı yenileme (isteğe bağlı)
                 
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);

                }
            });
        });
         $("#saveAddButton").click(function() {
            var formData = $("#addUser").serialize();

            $.ajax({
                type: "POST",
                url: "<?= base_url('profil/ekle') ?>",
                data: formData,
                success: function(response) {
                    // Başarılı işlem sonrası modalı kapatma işlemi
                    $("#addModal").modal("hide");
                    // Sayfayı yenileme (isteğe bağlı)
                },
                error: function(xhr, status, error) {
                    // Hata mesajını kullanıcıya gösterme (örneğin bir alert ile)
                    alert("Hata oluştu: " + xhr.responseText);
                }
            });
        });
    });
    
</script>
<?= $this->endSection('pageSpecificScript') ?>
