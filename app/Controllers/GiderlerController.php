<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use PhpOffice\PhpSpreadsheet\IOFactory; 
use App\Models\GiderlerModel;
use App\Models\GiderKategorileriModel;
use App\Models\PersonelModel;

class GiderlerController extends BaseController
{
  public function index()
    {
        $personelModel = new PersonelModel();
        $giderlerModel = new GiderlerModel();

        // Check if the record already exists
        $existingRecord = $giderlerModel
            ->where('aciklama', 'Toplam Personel Maaşı')
            ->where('son_odeme_tarihi', date('Y-m-d'))
            ->first();

        if (!$existingRecord) {
            // Calculate the total salary
            $salaries = $personelModel->selectSum('maas')->findAll(); 
            $totalSalary = 0;
            foreach ($salaries as $salary) {
                $totalSalary += $salary['maas'];
            }

            // Prepare data for the new expense record
            $giderVerisi = [
                'aciklama' => 'Toplam Personel Maaşı',
                'odenen_tutar' => $totalSalary,
                'son_odeme_tarihi' => date('Y-m-d'),
            ];

            // Insert the new expense record
            $giderlerModel->insert($giderVerisi);
        }

        $kategoriModel = new GiderKategorileriModel();
        $data['giderKategorileri'] = $kategoriModel->findAll();

        $giderler = $giderlerModel
            ->select('giderler.*, gider_kategorileri.kategori_adi')
            ->join('gider_kategorileri', 'gider_kategorileri.kategori_id = giderler.kategori_id', 'left')
            ->orderBy('gider_id', 'DESC')
            ->findAll();

        $data['giderler'] = $giderler;
        $data['website_ayarlari'] = $this->data['website_ayarlari'];

        return view('dashboard/admin/giderler', $data);
    }

   public function store()
{
    $kategori_id = $this->request->getPost('txtKategori');
    $odenen_tutar = $this->request->getPost('txtOdenenTutar');
    $son_odeme_tarihi = $this->request->getPost('txtSonOdemeTarihi');
    $aciklama = $this->request->getPost('txtAciklama');
    
    // Dosya yükleme işlemi
    $fatura_foto = $this->request->getFile('txtFoto');


 
       
        $fatura_foto->move(ROOTPATH . 'public/uploads', $fatura_foto);
   

    $giderModel = new GiderlerModel();
    $data = [
        'kategori_id' => $kategori_id,
        'odenen_tutar' => $odenen_tutar,
        'son_odeme_tarihi' => $son_odeme_tarihi,
        'aciklama' => $aciklama,
        'fatura_foto' => $fatura_foto // Yüklenen dosyanın adını veritabanına kaydet
    ];

    // Veritabanına ekleme işlemi
    $inserted = $giderModel->insert($data);

    if ($inserted) {
        return $this->response->setJSON(['success' => true, 'data' => $data]);
    } else {
        // Veritabanına ekleme hatası
        return $this->response->setJSON(['success' => false, 'message' => 'Veritabanına ekleme hatası']);
    }
}


    public function edit($gider_id = null)
    {
        $model = new GiderlerModel();
        $data = $model->where('gider_id', $gider_id)->first();

        if ($data) {
            echo json_encode(["status" => true, 'data' => $data]);
        } else {
            echo json_encode(["status" => false]);
        }
    }

   public function update()
{
    helper(['form', 'url']);
    $model = new GiderlerModel();
    $gider_id = $this->request->getVar('hdnUserId'); // Updated variable name
    $data = [
        'aciklama' => $this->request->getVar('txtAciklama'),
        'odenen_tutar' => $this->request->getVar('txtOdenenTutar'),
        'son_odeme_tarihi' => $this->request->getVar('txtSonOdemeTarihi'),
        'kategori_id' => $this->request->getVar('txtKategori'),
    ];
    $update = $model->update($gider_id,$data);
    if ($update) {
        $data = $model->where('gider_id', $gider_id)->first();
        echo json_encode(["status" => true, 'data' => $data]);
    } else {
        echo json_encode(["status" => false, 'data' => $data]);
    }
}

    public function delete($gider_id = null)
    {
        $model = new GiderlerModel();
        $delete = $model->where('gider_id', $gider_id)->delete();
        if ($delete) {
            echo json_encode(["status" => true]);
        } else {
            echo json_encode(["status" => false]);
        }
    }

    public function kategoriEkle()
    {
        if ($this->request->getMethod() === 'post') {
            $kategoriModel = new GiderKategorileriModel();

            $kategoriData = [
                'kategori_adi' => $this->request->getVar('txtKategori'),
            ];

            $saved = $kategoriModel->insert($kategoriData);

            if ($saved) {
                return redirect()->to('/giderler')->with('success', 'Kategori başarıyla eklendi');
            } else {
                return redirect()->to('/giderler')->with('error', 'Kategori eklenirken bir hata oluştu');
            }
        }
    }

 public function giderKategoriDuzenle($kategori_id = null)
{
    $kategoriAdi = $this->request->getPost('kategori_adi'); // Assuming you have a form field named 'kategori_adi' to specify the new category name.
    
    $model = new GiderKategorileriModel();
    
    // Check if the category exists
    $existingCategory = $model->find($kategori_id);
    
    if (!$existingCategory) {
        echo json_encode(['status' => false, 'message' => 'Category not found']);
        return;
    }

    // Update the category name
    $data = [
        'kategori_adi' => $kategoriAdi,
    ];

    $update = $model->update($kategori_id, $data);

    if ($update) {
        echo json_encode(['status' => true, 'message' => 'Category updated successfully']);
    } else {
        echo json_encode(['status' => false, 'message' => 'Category update failed']);
    }
}


    public function giderKategoriSil($kategori_id = null)
    {
        $model = new GiderKategorileriModel();
        $delete = $model->where('kategori_id', $kategori_id)->delete();
        if ($delete) {
            echo json_encode(['status' => true]);
        } else {
            echo json_encode(['status' => false]);
        }
    }

    public function excelForm()
    {
        $data['website_ayarlari'] = $this->data['website_ayarlari'];
        return view('excel_form', $data);
    }
    public function download_template_excel()
    {
        $file = WRITEPATH. 'uploads/giderler_template_excel.xlsx';
        return $this->response->download($file,null)->setFileName('giderler_template_excel.xlsx');
        return redirect->to('excel_form');
    }
    public function excelUpload()
    {
        $file = $this->request->getFile('excel_file');

        if ($file->isValid() && $file->getExtension() == 'xlsx') {
            $spreadsheet = IOFactory::load($file->getTempName());
            $sheet = $spreadsheet->getActiveSheet();

            $data = $sheet->toArray();

            $data = array_slice($data, 3);

            $giderlerModel = new GiderlerModel();
            $insertedRows = 0;

            foreach ($data as $row) {
                if (empty(array_filter($row))) {
                    continue;
                }

                $existingData = $giderlerModel
                    ->where('aciklama', $row[0])
                    ->where('son_odeme_tarihi', $row[2])
                    ->where('kategori_id', $row[3])
                    ->first();

                if (!$existingData) {
                    $insertData = [
                        'aciklama' => $row[0],
                        'son_odeme_tarihi' => $row[2],
                        'kategori_id' => $row[3],
                    ];

                    $giderlerModel->insert($insertData);

                    $insertedRows++;
                }
            }

            return redirect()->to('/excelForm')->with('success', $insertedRows . ' satır Excel verileri başarıyla veritabanına eklendi.');
        } else {
            return redirect()->to('/excelForm')->with('error', 'Geçersiz Excel dosyası.');
        }
    }
}
