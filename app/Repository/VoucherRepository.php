<?php

use \App\Voucher;
namespace App\Repository;

class VoucherRepository implements IVoucherRepository {
    
    public function getAll()
    {
        return \App\Voucher::all();
    }

    public function getVoucherbycode($vouchercode)
    {
        return \App\Voucher::where('voucher_code', '=', $vouchercode)->first();
    }
    
    public function save($currentVoucher)
    {
        $voucher = new \App\Voucher;
        
        $voucher->voucher_code = $currentVoucher->voucher_code;
        $voucher->expiration_date = $currentVoucher->expiration_date;
        $voucher->voucher_used = $currentVoucher->voucher_used;
        $voucher->usage_date = $currentVoucher->usage_date;
        $voucher->recipient_id = $currentVoucher->recipient_id;
        $voucher->offer_id = $currentVoucher->offer_id;

        $voucher->save();
        // assign the new Id
        $voucher->voucher_id = $voucher->id;
        return $voucher;
    }
    
    public function update($currentVoucher)
    {
        $currentVoucher->save();
    }

}
