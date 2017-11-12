<?php

use \App\Voucher;
namespace App\Repository;

class VoucherRepository implements IVoucherRepository {
    
    public function getAll()
    {
        return \App\Voucher::all();
    }

}
