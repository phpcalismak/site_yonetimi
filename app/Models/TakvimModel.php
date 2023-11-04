<?php 

namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class TakvimModel extends Model
{
	protected $table = 'etkinlikler';
	protected $primaryKey = 'id';
	protected $allowedFields = ['etkinlik_tarihi','etkinlik_adi','aciklama'];
}