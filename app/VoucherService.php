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

}