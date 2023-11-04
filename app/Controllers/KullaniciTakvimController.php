<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EventModel;

class KullaniciTakvimController extends BaseController
{
	public function __construct()
	{
		helper(["html"]);
	}
	public function index()
	{
		$data['website_ayarlari'] = $this->data['website_ayarlari'];
		return view('dashboard/k_takvim',$data);
	}

}