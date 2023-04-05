<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;


class Pesanan extends Seeder
{
    public function run()
    {
        $query = $this->db->query('SELECT id_bahan FROM bahan');
        $result   = $query->getResult();

        foreach ($result as $n) {

        for ($i=0; $i < 2; $i++) {
            $qty = static::faker()->numberBetween(0, 150);
            $data = [
                'id_pesanan'   => static::faker()->regexify('[A-Z]{4}[0-4]{4}'),
                'nama_pemesan' => static::faker()->name($gender = 'male'|'female'),
                'alamat'       => static::faker()->address() ,
                'kontak'       => static::faker()->e164PhoneNumber(),
                'id_bahan'    => $n->id_bahan,
                'jumlah'       => $qty,
                'tgl_pesan'  => static::faker()->date($format = 'Y-m-d', $max = 'now'),
            ];

            print_r($data);
            $this->db->table('pesanan')->insert($data);
        }
    }
}
}
