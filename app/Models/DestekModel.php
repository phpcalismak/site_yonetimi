<?php 

namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class DestekModel extends Model
{
	protected $table = 'destek_talepleri';
	protected $primaryKey = 'talep_id';
	protected $allowedFields = ['talep_basligi','talep_metni','talep_tarihi','gonderen'];
}