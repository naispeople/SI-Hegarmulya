<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;


class produksi extends Seeder
{
    public function run()
    {
        $query = $this->db->query('SELECT id_pesanan, id_bahan FROM pesanan');
        $result   = $query->getResult();

        foreach ($result as $n) {

        for ($i=0; $i < 2; $i++) {
            $qty = static::faker()->numberBetween(0, 5);
            $data = [
                'id_produksi'    => static::faker()->regexify('[A-Z]{4}[0-4]{4}'),
                'id_pesanan'        => $n->id_pesanan,
                'id_bahan'         => $n->id_bahan,
                'estimasi'          => $qty
            ];

            print_r($data);
            $this->db->table('produksi')->insert($data);
        }
    }
}
}
