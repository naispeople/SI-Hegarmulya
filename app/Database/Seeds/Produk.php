<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class bahan extends Seeder
{
    public function run()
    {
        $nama =['Coklat','Hitam','Hijau','Fanta','Maroon','Olive','Dasty Pink'];
        foreach ($nama as $n) {

        for ($i=0; $i < 3; $i++) {
            $qty = static::faker()->numberBetween(0, 150);
            $data = [
                'id_bahan'   => static::faker()->regexify('[A-Z]{4}[0-4]{4}'),
                'warna' => $n,
                'jenis'       => static::faker()->numberBetween($min = 1, $max = 6) ,
                'stok'       => $qty,
            ];

            print_r($data);
            $this->db->table('bahan')->insert($data);
        }
        }
    }
}
