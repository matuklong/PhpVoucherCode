<?php

namespace App\Http\Controllers;

use \App\IVoucherService;

class VoucherController extends Controller
{
    private $voucherservice;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(IVoucherService $voucherservice) {
        $this->voucherservice = $voucherservice;
    }

    //
    public function listRecipients()
    {
        return $this->voucherservice->listRecipients();
    }
    
}
