<?php

namespace App\Repository;

interface IVoucherRepository {
    
    public function getAll();
    public function getVoucherbycode($vouchercode);
    public function save($currentOffer);
}