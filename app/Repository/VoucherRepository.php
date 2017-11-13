<?php

namespace App\Repository;
use \App\Voucher;
use Illuminate\Support\Facades\DB;

class VoucherRepository implements IVoucherRepository {
    
    public function getAll()
    {
        return \App\Voucher::all();
    }

    public function getVoucherbycode($vouchercode)
    {
        return \App\Voucher::where('voucher_code', '=', $vouchercode)->first();
    }
    public function getValidVoucher($email)
    {
        $vouchers = DB::table('recipient')
        ->join('voucher', 'recipient.recipient_id', '=', 'voucher.recipient_id')  
        ->join('offer', 'voucher.offer_id', '=', 'offer.offer_id')        
        ->select('recipient.email', 'recipient.recipient_id', 'voucher.voucher_code', 'offer.offer_name', 'offer.percentage_discount', 'voucher.expiration_date')
        ->where('email', $email)
        ->where('voucher_used', false)
        ->whereDate('expiration_date', '>=', date('Y-m-d'))
        ->get();

        return $vouchers;
    }

    public function getUsedVoucher($email)
    {
        $vouchers = DB::table('recipient')
        ->join('voucher', 'recipient.recipient_id', '=', 'voucher.recipient_id')  
        ->join('offer', 'voucher.offer_id', '=', 'offer.offer_id')        
        ->select('recipient.email', 'recipient.recipient_id', 'voucher.voucher_code', 'offer.offer_name', 'offer.percentage_discount', 'voucher.expiration_date', 'voucher.usage_date')
        ->where('email', $email)
        ->where('voucher_used', true)
        ->get();

        return $vouchers;
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
