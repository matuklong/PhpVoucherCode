<?php

namespace App;

use \App\Repository\IVoucherRepository;
use \App\Repository\IOfferRepository;
use \App\Repository\IRecipientRepository;

class VoucherService implements IVoucherService
{
    
    private $voucher;
    private $offer;
    private $recipient;
    public function __construct(IVoucherRepository $voucher, IOfferRepository $offer, IRecipientRepository $recipient) {
        $this->voucher = $voucher;
        $this->offer = $offer;
        $this->recipient = $recipient;
    }

    public function listRecipients(){
        return $this->recipient->getAll();
    }

    public function generateVoucher($generateVoucherDto)
    {
        // this is a long running task
        // recomandation is to run as a background service

        // get Offer by Name
        $currentOffer = $this->offer->getOfferByName($generateVoucherDto->offer_name);

        // if don't exists, create a new one
        if ($currentOffer == null)
        {
            $currentOffer = new class{};
            $currentOffer->offer_name = $generateVoucherDto->offer_name;
            $currentOffer->percentage_discount = $generateVoucherDto->percentage_discount;
            $currentOffer = $this->offer->save($currentOffer);
        }

        // I'll assume that the voucher is generated with recipient foreign key
        // If that's not the case, the recipient would stay null at this point, and on "voucher verification method" the relationship would be stabilished

        // get all recepients
        // I'll get only the recipients without voucher. This is can be a long running task, and if the routine don't reach the end, we can run again, 
        // withou generating replication
        $recipientList = $this->recipient->getRecipientsWithoutVoucher($currentOffer->offer_id);
        $voucherCount = 0;
        foreach ($recipientList as $currentRecipient)
        {
            
            $currentVoucher = new class{};
            
            //$currentVoucher->voucher_code = str_random(10);
            $generateVoucherCode = str_random(10);
            
            // check if the code exists
            // check one by one is very slow. 
            // the best performance would be try to insert and check duplicate error. 
            // the Lumen framework is holding the exception and I'coudn't handle here
            // so the easiest way is one by one check, but this may causa problems in concurrent routines. The right way would be a database lock.
            while($this->voucher->getVoucherbycode($generateVoucherCode) != null)
            {
                $generateVoucherCode = str_random(10);
            }

            $currentVoucher->voucher_code = $generateVoucherCode;
            $currentVoucher->expiration_date = $generateVoucherDto->expiration_date;
            $currentVoucher->voucher_used = false;
            $currentVoucher->usage_date = null;
            $currentVoucher->recipient_id = $currentRecipient->recipient_id;
            $currentVoucher->offer_id = $currentOffer->offer_id;
            $currentVoucher = $this->voucher->save($currentVoucher);

            $voucherCount++;
        }

        $result = new class{};
        $result->voucherCount = $voucherCount;
        $result->message = "Vouchers generated for $voucherCount recipients";
        return $result;
    }

}