<?php

namespace App\Controllers;

use App\Models\PersonelModel;

use CodeIgniter\Controller;

class PersonelController extends BaseController
{
   
public function index()
{
    $model = new PersonelModel();
    $hesaplar = $model->orderBy('personel_id', 'DESC')->findAll();
    $data['personeller'] = $model->findAll(); 
    $data['website_ayarlari'] = $this->data['website_ayarlari'];

    return view('dashboard/admin/personel', $data);
}


    public function store()
    {
        helper(['form', 'url']);
        $model = new PersonelModel();

        $data = [
            'ad_soyad' => $this->request->getVar('txtAdSoyad'),
            'pozisyon' => $this->request->getVar('txtPozisyon'),
            'kimlik_no' => $this->request->getVar('txtKimlikNo'),
            'telefon' => $this->request->getVar('txtTelefon'),
            'eposta' => $this->request->getVar('txtEposta'),
            'maas' => $this->request->getVar('txtMaas'),
            

        ];
        $save = $model->insertData($data);
        if ($save) {
            $data = $model->where('personel_id', $save)->first();
            echo json_encode(["status" => true, 'data' => $data]);
        } else {
            echo json_encode(["status" => false, 'data' => $data]);
        }
    }
     public function edit($personel_id = null)
    {
        $model = new PersonelModel();
        $data = $model->where('personel_id', $personel_id)->first();

        if ($data) {
            echo json_encode(["status" => true, 'data' => $data]);
        } else {
            echo json_encode(["status" => false]);
        }
    }
     public function update()
    {
        helper(['form', 'url']);
        $model = new PersonelModel();
        $personel_id = $this->request->getVar('hdnUserId');
        $data = [
            'ad_soyad' => $this->request->getVar('txtAdSoyad'),
            'pozisyon' => $this->request->getVar('txtPozisyon'),
            'kimlik_no' => $this->request->getVar('txtKimlikNo'),
            'telefon' => $this->request->getVar('txtTelefon'),
            'eposta' => $this->request->getVar('txtEposta'),
             'maas' => $this->request->getVar('txtMaas'),

        ];
        
        $update = $model->update($personel_id, $data);
        if ($update) {
            $data = $model->where('personel_id', $personel_id)->first();
            echo json_encode(["status" => true, 'data' => $data]);
        } else {
            echo json_encode(["status" => false, 'data' => $data]);
        }
    }
       
    public function delete($personel_id = null)
    {
        $model = new PersonelModel();
        $delete = $model->where('personel_id', $personel_id)->delete();
        if ($delete) {
            echo json_encode(["status" => true]);
        } else {
            echo json_encode(["status" => false]);
        }
    }

    public function profiller()
    {
       


    $model = new ProfillerModel();
    $data['profiller'] = $model->where('profil_id', $profil_id)->first(); 

    if (empty($data['profiller'])) {
      
        return redirect()->to('dashboard/admin/hesaplar'); 
    }
       
         $data['website_ayarlari'] = $this->data['website_ayarlari'];
         return view('dashboard/admin/profiller/', $data);
    }

   

}