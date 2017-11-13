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
    
    public function useVoucher(Request $request)
    {

        $this->validate($request, [
            'voucher_code' => 'required',
            'email' => 'required'
                ]);

        $voucherRequest = $request->all();

        // convert to new class
        $voucherdto = new class{};
        $voucherdto->voucher_code = $voucherRequest['voucher_code'];
        $voucherdto->email = $voucherRequest['email'];

        $result = $this->voucherservice->useVoucher($voucherdto);

        return response()->json($result);
    }  
    
    public function getValidVoucher(Request $request)
    {

        $this->validate($request, [
            'email' => 'required'
                ]);

        $voucherRequest = $request->all();
        $result = $this->voucherservice->getValidVoucher($voucherRequest['email']);

        return response()->json($result);
    }
    
    public function getUsedVoucher(Request $request)
    {

        $this->validate($request, [
            'email' => 'required'
                ]);

        $voucherRequest = $request->all();
        $result = $this->voucherservice->getUsedVoucher($voucherRequest['email']);

        return response()->json($result);
    }
    
}
