<?php

namespace App\Models;

use CodeIgniter\Model;

class Bahan extends Model
{
    protected $table      = 'bahan';
    protected $primaryKey = 'id_bahan';
    protected function initialize()
    {
        $this->allowedFields[] = 'id_bahan';
        $this->allowedFields[] = 'warna';
        $this->allowedFields[] = 'jenis';
        $this->allowedFields[] = 'stok';
    }

    public function getEnum( )
    {
        $query = " SHOW COLUMNS FROM `bahan` LIKE 'jenis' ";
        $row = $this->db->query(" SHOW COLUMNS FROM `bahan` LIKE 'jenis' ")->getRow()->Type;
        $regex = "/'(.*?)'/";
        preg_match_all( $regex , $row, $enum_array );
        $enum_fields = $enum_array[1];
        return( $enum_fields );
    }
}
