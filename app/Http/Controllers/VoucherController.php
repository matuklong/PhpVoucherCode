<?php

namespace App\Http\Controllers;

use \App\IVoucherService;
use Illuminate\Http\Request;

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

    public function generateVouchers(Request $request)
    {

        $this->validate($request, [
            'offer_name' => 'required',
            'percentageDiscount' => 'required',
            'expirationDate' => 'required'            
             ]);

        $specialOffer = $request->all();

        // convert to new class
        $currentOffer = new class{};
        $currentOffer->offer_name = $specialOffer['offer_name'];
        $currentOffer->percentage_discount = $specialOffer['percentageDiscount'];
        $currentOffer->expiration_date = $specialOffer['expirationDate'];

        //var_dump($specialOffer);
        $result = $this->voucherservice->generateVoucher($currentOffer);

        return response()->json($result);
    }
    
}
