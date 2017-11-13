<?php

namespace App\Repository;

use \App\Recipient;
use Illuminate\Support\Facades\DB;

class RecipientRepository implements IRecipientRepository {
    
    public function getAll()
    {
        return \App\Recipient::all();
    }

    public function getRecipientsWithoutVoucher($offerId)
    {        
        $recipients = DB::table('recipient')
        ->leftJoin('voucher', function ($join) use ($offerId) {
            $join->on('recipient.recipient_id', '=', 'voucher.recipient_id')
            ->where('voucher.offer_id', '=', $offerId);
                 //->where('voucher.offer_id', '=', $offerId);
        })
        ->whereNull('voucher.offer_id')
        ->select('recipient.*')
        ->get();
        
        // ->toSql();
        // dd($recipients);

        return $recipients;
    }

}
