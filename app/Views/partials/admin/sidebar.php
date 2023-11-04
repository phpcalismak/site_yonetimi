
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
       <span class="brand-text font-weight-light"><?=  $website_ayarlari['site_basligi']; ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
        
       <p style="color:white">
         <?= session()->get('email') ?> 
        </p>
          <p></p>
        </div>
        <div class="info">
          <a href="" class="d-block">
          </a>
        </div>
      </div>


<!--      Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!--
         
          <li class="nav-item">
            <a href=" " class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Düz Datatable
              </p>
            </a>
          </li>

        
          <li class="nav-item">
            <a href="" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                El Yapımı Tablo
              </p>
            </a>
          </li>

-->

   
          <li class="nav-item">
            <a href="<?= site_url('aidatlar'); ?> " class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Aidatlar
              </p>
            </a>
          </li>

        
          <li class="nav-item">
            <a href="<?= site_url('/daireler'); ?> " class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Daireler
              </p>
            </a>
          </li>
        
        
          <li class="nav-item">
            <a href="<?= site_url('gelirler'); ?>" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Gelirler
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?= site_url('/giderler'); ?> " class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Giderler
              </p>
            </a>
          </li>
   
          <li class="nav-item">
            <a href="<?= site_url('hesaplar'); ?> " class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Hesaplar
              </p>
            </a>
          </li>

        
          <li class="nav-item">
            <a href="<?= site_url('kasa'); ?>" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Kasa
              </p>
            </a>
          </li>
   <!--
          <li class="nav-item">
            <a href="<?php // site_url('blok_duzeni'); ?>" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Site Düzeni
              </p>
            </a>
          </li>
-->   
           <li class="nav-item">
            <a href="<?= base_url('duyuru_gonder'); ?>" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Duyurular
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= site_url('personel'); ?>" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Personel
              </p>
            </a>
          </li>


           <li class="nav-item">
            <a href="<?= site_url('fullcalendar'); ?>" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Etkinlik Takvimi
              </p>
            </a>
          </li>
        
           <li class="nav-item">
            <a href="<?= base_url('hesap_excel_form'); ?>" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
               Toplu Veri Ekle 
              </p>
            </a>
          </li>

           <li class="nav-item">
            <a href="<?= base_url('toplu_daire'); ?>" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
               Toplu Daire Ekle 
              </p>
            </a>
          </li>
               
          <li class="nav-item">
            <a href="<?= site_url('destek_talepleri'); ?>" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Destek Talepleri
              </p>
            </a>
          </li>
          
         
          <li class="nav-item">
            <a href="<?= site_url('site_ayarlari'); ?>" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Site Ayarları
              </p>
            </a>
          </li>

         
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>