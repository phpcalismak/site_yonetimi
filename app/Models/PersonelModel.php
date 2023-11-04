<?php 

namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class PersonelModel extends Model
{
	protected $table = 'personel';
	protected $primaryKey = 'personel_id';
	protected $allowedFields = ['ad_soyad','pozisyon','kimlik_no','telefon','eposta','maas'];

	public function insertData($data)
	{
		if($this->db->table($this->table)->insert($data))
		{
			return $this->db->insertID(); 
		}
		else
		{
			return false;
		}
	}
}