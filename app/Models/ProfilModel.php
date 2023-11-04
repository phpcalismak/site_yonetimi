<?php 

namespace App\Models;

use CodeIgniter\Model;

class ProfilModel extends Model
{
    protected $table = 'daireler'; 
    protected $primaryKey = 'daire_id';
protected $allowedFields = ['daire_id','blok_adi', 'daire_no', 'sakin_turu', 'email', 'sifre', 'tc_no', 'telefon', 'ad_soyad'];

   public function getProfilData($daire_id)
{
    return $this->db->table($this->table)
        ->select('daireler.*, hesaplar.*, daire_sakinleri.*') 
        ->join('hesaplar', 'hesaplar.daire_id = daireler.daire_id', 'left')
        ->join('daire_sakinleri', 'daire_sakinleri.daire_id = daireler.daire_id', 'left')
        ->where('daireler.daire_id', $daire_id)
        ->get()
        ->getRow();
}

}
