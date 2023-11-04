<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ProfilModel;
use App\Models\DaireSakinleriModel;
use App\Models\HesaplarModel;


class ProfilController extends BaseController
{
    public function index($daire_id= null)
    {
        $profilModel = new ProfilModel();
        $profilData = $profilModel->getProfilData($daire_id);

        $profilData->daire_id = $daire_id;
        $data['profilData'] = $profilData;
        $data['website_ayarlari'] = $this->data['website_ayarlari'];
        return view('dashboard/admin/profil', $data);

    }
   public function ekle()
{
     $daire_id = $this->request->getPost('hdnUserId');
    $ad_soyad = $this->request->getPost('ad_soyad');
    $sakin_turu = $this->request->getPost('sakin_turu');
    $email = $this->request->getPost('email');
    $sifre = $this->request->getPost('sifre');
    $tc_no = $this->request->getPost('tc_no');
    $telefon = $this->request->getPost('telefon');
    $blok_adi = $this->request->getPost('blok_adi');
    $daire_no = $this->request->getPost('daire_no');

    $profilModel = new ProfilModel();
    $hesaplarModel = new HesaplarModel();
    $daireSakinleriModel = new DaireSakinleriModel();
    $data = [
        'daire_sakinleri.ad_soyad' => $ad_soyad,
        'daire_sakinleri.sakin_turu' => $sakin_turu,
        'hesaplar.email' => $email,
        'hesaplar.sifre' => $sifre,
        'daire_sakinleri.tc_no' => $tc_no,
        'daire_sakinleri.telefon' => $telefon,
        'daireler.daire_no' => $daire_no,
        'daireler.blok_adi' => $blok_adi
    ];
 $sakinData = [
        'ad_soyad' => $ad_soyad,
        'sakin_turu' => $sakin_turu,
        'tc_no' => $tc_no,
        'telefon' => $telefon,
        'daire_id' => $daire_id, // Daireye ait daire_id
    ];

    $daireSakinleriModel->insert($sakinData);

    // 3. Adım: Hesap (hesaplar) ekle
    $hesapData = [
        'email' => $email,
        'sifre' => $sifre,
        'daire_id' => $daire_id, // Daireye ait daire_id
    ];

    $hesaplarModel->insert($hesapData);

    // İşlem başarılıysa sonucu döndür
    return $this->index($daire_id);
}






public function guncelle()
{
    $daire_id = $this->request->getPost('hdnUserId');
    $ad_soyad = $this->request->getPost('ad_soyad');
    $sakin_turu = $this->request->getPost('sakin_turu');
    $email = $this->request->getPost('email');
    $sifre = $this->request->getPost('sifre');
    $tc_no = $this->request->getPost('tc_no');
    $telefon = $this->request->getPost('telefon');
    $blok_adi = $this->request->getPost('blok_adi');
    $daire_no = $this->request->getPost('daire_no');

    $profilModel = new ProfilModel();
    $hesaplarModel = new HesaplarModel();
    $daireSakinleriModel = new DaireSakinleriModel();

    $whereClause = ['daire_id' => $daire_id]; // where koşulunu buraya taşıdık

    $data = [
        'ad_soyad' => $ad_soyad,
        'sakin_turu' => $sakin_turu,
        'tc_no' => $tc_no,
        'telefon' => $telefon,
        'daire_id' => $daire_id,
    ];

    $daireSakinleriModel->where($whereClause)->set($data)->update(); // daireSakinleri güncelleme

    $hesapData = [
        'email' => $email,
        'sifre' => $sifre,
        'daire_id' => $daire_id,
    ];

    $hesaplarModel->where($whereClause)->set($hesapData)->update(); // hesaplar güncelleme

    // Return a JSON response indicating the success status of the operation
  return $this->index($daire_id);
}


}
