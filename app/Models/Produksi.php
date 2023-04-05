<?php

namespace App\Models;

use CodeIgniter\Model;

class Produksi extends Model
{
    protected $table      = 'produksi';
    protected $primaryKey = 'id_produksi';
    protected function initialize()
    {
        $this->allowedFields[] = 'id_produksi';
        $this->allowedFields[] = 'id_pesanan';
        $this->allowedFields[] = 'id_bahan';
        $this->allowedFields[] = 'estimasi';
        $this->allowedFields[] = 'status';

    }

    public function getEnum(){
        $query = "SHOW COLUMNS FROM bahan LIKE 'jenis'";
        $row = $this->quey("SHOW COLUMNS FROM bahan LIKE 'jenis'")->row()->Type;
        $regex = " /'(.*?'/ ";
        preg_match_all($regex,$row,$enum_array);
        $enum_fields = $enum_array[1];
        foreach ($enum_fields as $enums => $value) {
            $enums[$value];
        }
        return $enums;
    }

    public function join(){
        return $this->db->table('produksi')
        ->join('pesanan', 'produksi.id_pesanan=pesanan.id_pesanan')
        ->join('bahan', 'pesanan.id_bahan=bahan.id_bahan')
        ->get()->getResultArray();
       }

       public function joinS(){
        return $this->db->table('produksi')
        ->select('jumlah')
        ->join('pesanan', 'produksi.id_pesanan=pesanan.id_pesanan')
        ->join('bahan', 'pesanan.id_bahan=bahan.id_bahan')
        ->where('status','0')
        ->get()->getResultArray();
       }

       public function joinStatus($s){
        return $this->db->table('produksi')
        ->select('*')
        ->join('pesanan', 'produksi.id_pesanan=pesanan.id_pesanan')
        ->join('bahan', 'pesanan.id_bahan=bahan.id_bahan')
        ->where('status',$s)
        ->get()->getResultArray();
       }

       public function joinChart($s1,$s2){
        $w =[$s1,$s2];
        return $this->db->table('produksi')
        ->select('*, DAY(estimasi) AS hari ')
        ->join('pesanan', 'produksi.id_pesanan=pesanan.id_pesanan')
        ->whereIN('status',$w)
        ->orderBy('hari','ASC')
        ->get()->getResultArray();
       }

}
