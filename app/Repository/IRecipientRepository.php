<?php

namespace App\Repository;

interface IRecipientRepository {
    
    public function getAll();
    public function getRecipientByEmail($email);
    public function getRecipientsWithoutVoucher($offerId);
}