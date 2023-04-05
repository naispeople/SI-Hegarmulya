<?php

namespace App\Helpers;

class utilityHelpers
{
    public static function UseridGenerator($jabatan)
    {

        // GET role Code
        $roleCode = '';
        switch ($jabatan) {
            case 'admin':
                $roleCode = 'A';
                break;
            case 'dyeing':
                $roleCode = 'D';
                break;
            case 'printing':
                $roleCode = 'P';
                break;
            case 'finishing':
                $roleCode = 'F';
                break;
            case 'manajer':
                $roleCode = 'M';
                break;
            case 'ppic':
                $roleCode = 'C';
                break;
            default:
                break;
        }

        $db      = \Config\Database::connect();
        $builder = $db->table('user');
        $query   = $builder->select('id_user')->like("id_user", $roleCode)->get()->getLastRow();

        // GET Order Count
        $getNumber = $query != null ? preg_replace('/[^0-9]/', '', $query->id_user) : '0';
        $pureNumber = (int) $getNumber + 1;
        $digit = strlen($pureNumber);
        $finalOrder = '';
        switch ($digit) {
            case 1:
                $finalOrder = '0' . $pureNumber;
                break;
            case 2:
                $finalOrder = $pureNumber;
                break;
            default:
                break;
        }
        $userID = $roleCode . $finalOrder;
        return $userID;
    }

    public static function Status($status){
        $printStatus ='';
        switch ($status) {
            case '0':
                $printStatus = '<span class="badge badge-secondary">Standby</span>';
                break;
            case '1':
                $printStatus = '<span class="badge badge-info">Dyeing</span>';
                break;
            case '2':
                $printStatus = '<span class="badge badge-warning">Selesai Dyeing</span>';
                break;
            case '3':
                $printStatus = '<span class="badge badge-info">Printing</span>';
                break;
            case '4':
                $printStatus = '<span class="badge badge-warning">Selesai Printing</span>';
                break;
            case '5':
                $printStatus = '<span class="badge badge-info">Finishing</span>';
                break;
            case '6':
                $printStatus = '<span class="badge badge-success">Produksi Selesai</span>';
                break;
            default:
                break;
        }
        return $printStatus;
    }
 
}
