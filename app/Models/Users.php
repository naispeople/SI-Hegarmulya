<?php

namespace App\Models;

use CodeIgniter\Model;

class Users extends Model
{
    protected $table      = 'user';
    protected $primaryKey = 'id_user';
    protected function initialize()
    {
        $this->allowedFields[] = 'id_user';
        $this->allowedFields[] = 'nama';
        $this->allowedFields[] = 'jabatan';
        $this->allowedFields[] = 'email';
        $this->allowedFields[] = 'username';
        $this->allowedFields[] = 'password';
    }
}
