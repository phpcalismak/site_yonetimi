<?php namespace App\Controllers;

use App\Models\DairelerModel;
use App\Models\AidatlarModel;
use App\Models\DaireSakinleriModel;
use CodeIgniter\Controller;

class DairelerController extends BaseController
{
    public function index()
    {
        $modelDaireler = new DairelerModel();
        $data['daireler'] = $modelDaireler->orderBy('daire_id', 'DESC')->findAll();

        $modelAidatlar = new AidatlarModel();
        $data['aidat_borcu'] = [];

        $modelDaireSakinleri = new DaireSakinleriModel();
        $daireSahipleri = [];

        foreach ($data['daireler'] as $daire) {
            $aidatBorcu = $modelAidatlar->where('daire_id', $daire['daire_id'])->findAll();
            $data['aidat_borcu'][$daire['daire_id']] = $aidatBorcu;

            $sahip = $modelDaireSakinleri->where('daire_id', $daire['daire_id'])->first();
            $daireSahipleri[$daire['daire_id']] = $sahip['ad_soyad'] ?? 'Daire sakini bulunamadı.';
        }

        $data['daireSahipleri'] = $daireSahipleri;

        $data['website_ayarlari'] = $this->data['website_ayarlari'];
        return view('dashboard/admin/daireler', $data);
    }

    public function store()
    {
        helper(['form', 'url']);
        $model = new DairelerModel();

        $data = [
            'blok_adi' => $this->request->getVar('txtBlokAdi'),
            'daire_no' => $this->request->getVar('txtDaireNo'),
            // Add more fields as needed
        ];

        $save = $model->insertData($data);

        if ($save) {
            $data = $model->where('daire_id', $save)->first();
            echo json_encode(["status" => true, 'data' => $data]);
        } else {
            echo json_encode(["status" => false, 'data' => $data]);
        }
    }

    public function edit($daire_id = null)
    {
        $model = new DairelerModel();
        $data = $model->where('daire_id', $daire_id)->first();

        if ($data) {
            echo json_encode(["status" => true, 'data' => $data]);
        } else {
            echo json_encode(["status" => false]);
        }
    }

    public function update()
    {
        helper(['form', 'url']);
        $model = new DairelerModel();
        $daire_id = $this->request->getVar('hdnUserId');
        $data = [
            'blok_adi' => $this->request->getVar('txtBlokAdi'),
            'daire_no' => $this->request->getVar('txtDaireNo'),
            // Add more fields as needed
        ];

        $update = $model->update($daire_id, $data);

        if ($update) {
            $data = $model->where('daire_id', $daire_id)->first();
            echo json_encode(["status" => true, 'data' => $data]);
        } else {
            echo json_encode(["status" => false, 'data' => $data]);
        }
    }

    public function delete($daire_id = null)
    {
        $model = new DairelerModel();
        $delete = $model->where('daire_id', $daire_id)->delete();

        if ($delete) {
            echo json_encode(["status" => true]);
        } else {
            echo json_encode(["status" => false]);
        }
    }
  

}
