<?php

namespace App\Repository;

interface IVoucherRepository {
    
    public function getAll();
    public function getVoucherbycode($vouchercode);
    public function getValidVoucher($email);
    public function getUsedVoucher($email);


    public function save($currentOffer);
    public function update($currentVoucher);
}