<?php

namespace App\Models;

use CodeIgniter\Model;

class Pesanan extends Model
{
    protected $table      = 'pesanan';
    protected $primaryKey = 'id_pesanan';
    protected function initialize()
    {
        $this->allowedFields[] = 'id_pesanan';
        $this->allowedFields[] = 'nama_pemesan';
        $this->allowedFields[] = 'alamat';
        $this->allowedFields[] = 'kontak';
        $this->allowedFields[] = 'id_bahan';
        $this->allowedFields[] = 'jumlah';
        $this->allowedFields[] = 'tgl_pesan';
    }

   public function joinProduk(){
    return $this->db->table('pesanan')
    ->join('bahan', 'bahan.id_bahan=pesanan.id_bahan')
    ->get()->getResultArray();
   }
}
