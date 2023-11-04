<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\DestekModel;

class DestekController extends BaseController
{
    public function index()
    {
        $duyurularModel = new DestekModel();
        $data['talepler'] = $duyurularModel->findAll();
         $data['website_ayarlari'] = $this->data['website_ayarlari'];

        return view('dashboard/admin/destek_talepleri', $data);
    }

    public function delete($id)
    {
        $destekModel = new DestekModel();
        $destekModel->delete($id);

        return redirect()->to('dashboard/admin/destek_talepleri')->with('success', 'Destek talebi başarıyla silindi.');
    }
}