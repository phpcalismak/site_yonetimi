<?php 

namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class GiderlerModel extends Model
{
	protected $table = 'giderler';
	protected $primaryKey = 'gider_id';
	protected $allowedFields = ['kategori_id','odenen_tutar','son_odeme_tarihi','aciklama','fatura_foto'];

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