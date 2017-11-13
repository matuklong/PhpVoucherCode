<?php

namespace App;

interface IVoucherService
{
    public function listRecipients();
    public function generateVoucher($generateVoucherDto); 
    public function useVoucher($useVoucherDto); 
}