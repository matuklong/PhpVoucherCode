<?php

namespace App\Repository;

interface IRecipientRepository {
    
    public function getAll();
    public function getRecipientsWithoutVoucher($offerId);
}