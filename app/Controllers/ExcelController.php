<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Models\HesaplarModel;
use App\Models\DairelerModel;
use App\Models\DaireSakinleriModel;

class ExcelController extends BaseController
{
    public function index()
    {
        $data['website_ayarlari'] = $this->data['website_ayarlari'];
        return view('dashboard/hesap_excel_form', $data);
    }
      public function hesap_excel_template()
    {
        $file = 'C:\wamp64\www\testci\public\uploads\kullanici_template_excel.xlsx';

        return $this->response->download($file, null)->setFileName('kullanici_template_excel.xlsx', true);

        return redirect->to('hesap_excel_form');
    }

 public function hesap_excel_upload()
{
    if ($this->request->getMethod() == 'post') {
        $uploadedFile = $this->request->getFile('excel_file');

        if ($uploadedFile->isValid() && !$uploadedFile->hasMoved()) {
            $spreadsheet = IOFactory::load($uploadedFile->getTempName());
            $sheet = $spreadsheet->getActiveSheet();

            $data = $sheet->toArray();

            $data = array_slice($data, 4);

            $dairelerModel = new DairelerModel();
            $hesaplarModel = new HesaplarModel();
            $daireSakinleriModel = new DaireSakinleriModel();

            $insertedRows = 0; 

            foreach ($data as $row) {
                if (!empty(array_filter($row))) {
                    $existingData = $dairelerModel
                        ->where('blok_adi', $row[7])
                        ->where('daire_no', $row[8])
                        ->first();

                    if (!$existingData) {
                        $daireData = [
                            'blok_adi' => $row[7],
                            'daire_no' => $row[8],
                        ];
                        $dairelerModel->insert($daireData);

                        $daireId = $dairelerModel->insertID();

                        $hesaplarData = [
                            'hesap_turu' => $row[0],
                            'email' => $row[1],
                            'sifre' => $row[2],
                            'daire_id' => $daireId,
                        ];
                        $hesaplarModel->insert($hesaplarData);

                        $daireSakinleriData = [
                            'ad_soyad' => $row[3],
                            'tc_no' => $row[4],
                            'telefon' => $row[5],
                            'daire_id' => $daireId,
                            'sakin_turu' => $row[6],
                        ];
                        $daireSakinleriModel->insert($daireSakinleriData);

                        $insertedRows++;
                    }
                }
            }

            return redirect()->to('/success')->with('success', $insertedRows . ' satır Excel verileri başarıyla veritabanına eklendi.');
        }
    }

    return view('hesap_excel_form');
}


}

