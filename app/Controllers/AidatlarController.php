<?php 

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\AidatlarModel;
use App\Models\DairelerModel;

class AidatlarController extends BaseController 
{
    public function index()
    {
        
        $model = new AidatlarModel();
        $data['aidatlar'] = $model->where('daire_id', 0)->orderBy('aidat_id', 'DESC')->findAll();
          $data['website_ayarlari'] = $this->data['website_ayarlari'];
        return view('dashboard/admin/aidatlar', $data);
    }
   public function store()
{
    helper(['form', 'url']);
    $aidatlarModel = new AidatlarModel();
    $dairelerModel = new DairelerModel();

    // Formdan gelen verileri alın
    $aciklama = $this->request->getVar('txtAciklama');
    $odemeTarihi = $this->request->getVar('txtOdemeTarihi');
    $tutar = $this->request->getVar('txttutar');

    // Veritabanına eklemek üzere aidat verilerini bir diziye yerleştirin
    $data = [
        'aciklama' => $aciklama,
        'odeme_tarihi' => $odemeTarihi,
        'tutar' => $tutar,
    ];

    // Aidatları veritabanına ekleyin
    $save = $aidatlarModel->insert($data,true);

    if ($save) {
        // Ekleme işlemi başarılıysa, bütün dairelere aidatları ekleyin
        $daireler = $dairelerModel->findAll();

        foreach ($daireler as $daire) {
            $daireId = $daire['daire_id'];
            
            // Her daireye aidat eklemek için yeni bir veri oluşturun
            $daireAidatData = [
                'daire_id' => $daireId,
                'aciklama' => $aciklama,
                'odeme_tarihi' => $odemeTarihi,
                'tutar' => $tutar,
            ];

            $aidatlarModel->insert($daireAidatData);
        }

        // Ekleme işlemi başarılı olduğunda JSON yanıtı döndürün
        $data = $aidatlarModel->where('aidat_id', $save)->first();
        echo json_encode(["status" => true, 'data' => $data]);
    } else {
        // Ekleme işlemi başarısız olduğunda JSON yanıtı döndürün
        echo json_encode(["status" => false, 'data' => $data]);
    }
}

    

     public function edit($aidat_id = null)
    {
        $model = new AidatlarModel();
        $data = $model->where('aidat_id', $aidat_id)->first();

        if ($data) {
            echo json_encode(["status" => true, 'data' => $data]);
        } else {
            echo json_encode(["status" => false]);
        }
    }
     public function update()
    {
        helper(['form', 'url']);
        $model = new AidatlarModel();
        $aidat_id = $this->request->getVar('hdnUserId');
        $data = [
          
            'aciklama' => $this->request->getVar('txtAciklama'),
            'odeme_tarihi' => $this->request->getVar('txtOdemeTarihi'),
            'tutar' => $this->request->getVar('txttutar'),
    
        ];
        $update = $model->update($aidat_id, $data);
        if ($update) {
            $data = $model->where('aidat_id', $aidat_id)->first();
            echo json_encode(["status" => true, 'data' => $data]);
        } else {
            echo json_encode(["status" => false, 'data' => $data]);
        }
    }
       
   

public function delete($aidat_id = null)
{
    $aidatlarModel = new AidatlarModel();

    // Retrieve the aidat information before deleting
    $aidatData = $aidatlarModel->find($aidat_id);

    if ($aidatData) {
        $aciklama = $aidatData['aciklama'];
        $odeme_tarihi = $aidatData['odeme_tarihi'];
        $tutar = $aidatData['tutar'];

        // Delete the aidat for all daireler using the retrieved information
        $dairelerModel = new DairelerModel();
        $daireler = $dairelerModel->findAll();

        foreach ($daireler as $daire) {
            $daire_id = $daire['daire_id'];

            // Delete the aidat for the current daire
            $aidatlarModel->where('daire_id', $daire_id)
                ->where('aciklama', $aciklama)
                ->where('odeme_tarihi', $odeme_tarihi)
                ->where('tutar', $tutar)
                ->delete();
        }

        echo json_encode(['status' => true]);
    } else {
        echo json_encode(['status' => false]);
    }
}
}