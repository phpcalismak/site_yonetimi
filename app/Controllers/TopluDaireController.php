<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\DairelerModel;

class TopluDaireController extends BaseController
{
    public function index()
    {
        $data['website_ayarlari'] = $this->data['website_ayarlari'];
        return view('dashboard/admin/toplu_daire_ekle',$data);
    }

    public function store()
    {
        $blockCount = $this->request->getPost('block_count');
        $apartmentsPerBlock = $this->request->getPost('apartments_per_block');

        $dairelerModel = new DairelerModel();

        for ($blockIndex = 1; $blockIndex <= $blockCount; $blockIndex++) {
            $blockName = chr(64 + $blockIndex); // Blok adları A, B, C, ... şeklinde sıralansın

            for ($apartmentNumber = 1; $apartmentNumber <= $apartmentsPerBlock; $apartmentNumber++) {
                $daireData = [
                    'blok_adi' => $blockName,
                    'daire_no' => $apartmentNumber,
                ];

                $dairelerModel->insertData($daireData);
            }
        }

        return redirect()->to('/daireler')->with('success', 'Daireler başarıyla oluşturuldu.');
    }
}
