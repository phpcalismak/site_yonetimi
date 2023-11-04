<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\DestekModel;

class DestekGonderController extends BaseController
{
    public function index()
    {
        $data['website_ayarlari'] = $this->data['website_ayarlari'];
        return view('dashboard/destek_gonder', $data);
    }

    public function gonder()
    {
        $session = session();
        if ($this->request->getMethod() == 'post') {
            $baslik = $this->request->getPost('baslik');
            $mesaj = $this->request->getPost('mesaj');

            // Retrieve 'ad_soyad' from the session
            $gonderen = $session->get('email');

            // Duyuru verilerini hazırla
            $duyuruModel = new DestekModel();

            $duyuruData = [
                'talep_basligi' => $baslik,
                'talep_metni' => $mesaj,
                'talep_tarihi' => time(),
                'gonderen' => $gonderen  
            ];

            $duyuruModel->insert($duyuruData);

            return redirect()->to('/destek_gonder')->with('success', 'Duyuru başarıyla oluşturuldu.');
        }

        // Eğer form gönderilmediyse veya hatalıysa buraya düşer
        return redirect()->to('/destek_gonder')->with('error', 'Duyuru oluşturma sırasında bir hata oluştu.');
    }

    public function delete($id)
    {
        $duyuruModel = new DestekModel();
        $duyuruModel->delete($id);

        return redirect()->to('/destek_gonder')->with('success', 'Duyuru başarıyla silindi.');
    }
}
