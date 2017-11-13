<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use \App\Voucher;

class ExampleTest extends TestCase
{


    public function testgenerateVoucher_Zero_Recipient()
    {

        $OfferRepository = Mockery::mock(\App\Repository\IOfferRepository::class);
        $RecipientRepository = Mockery::mock(\App\Repository\IRecipientRepository::class);
        $VoucherRepository = Mockery::mock(\App\Repository\IVoucherRepository::class);
        $VoucherService = new \App\VoucherService($VoucherRepository, $OfferRepository, $RecipientRepository);

        $input = new class{};

        $input->offer_id= 1475487;
        $input->offer_name= "Special Offer";
        $input->percentageDiscount= 8.45;
        $input->expiration_date= "2018-01-20 00:00:00";


        $OfferRepository->shouldReceive('getOfferByName')
        ->Once()
        ->With($input->offer_name)
        ->andReturnUsing(function() use($input)
        {
            $mockThreadResult = new \StdClass;
            $mockThreadResult->offer_id = $input->offer_id;
            $mockThreadResult->offer_name = $input->offer_name;
        
            return $mockThreadResult;
        });

        $RecipientRepository->shouldReceive('getRecipientsWithoutVoucher')
        ->Once()
        ->With($input->offer_id)
        ->andReturnUsing(function() 
        {
        
            return array();
        });

        $result = $VoucherService->generateVoucher($input);
        
        $this->assertEquals("Vouchers generated for 0 recipients", $result->message);
    }

    public function testgenerateVoucher_One_Recipient()
    {

        $OfferRepository = Mockery::mock(\App\Repository\IOfferRepository::class);
        $RecipientRepository = Mockery::mock(\App\Repository\IRecipientRepository::class);
        $VoucherRepository = Mockery::mock(\App\Repository\IVoucherRepository::class);
        $VoucherService = new \App\VoucherService($VoucherRepository, $OfferRepository, $RecipientRepository);

        $input = new class{};

        $input->offer_id= 1475487;
        $input->offer_name= "Special Offer";
        $input->percentageDiscount= 8.45;
        $input->expiration_date= "2018-01-20 00:00:00";


        $OfferRepository->shouldReceive('getOfferByName')
        ->Once()
        ->With($input->offer_name)
        ->andReturnUsing(function() use($input)
        {
            $mockThreadResult = new \StdClass;
            $mockThreadResult->offer_id = $input->offer_id;
            $mockThreadResult->offer_name = $input->offer_name;
        
            return $mockThreadResult;
        });

        $RecipientRepository->shouldReceive('getRecipientsWithoutVoucher')
        ->Once()
        ->With($input->offer_id)
        ->andReturnUsing(function() 
        {
            $mockThreadResult1 = new \StdClass;
            $mockThreadResult1->recipient_id = 2423;
            $mockThreadResult1->name = "Name1";
            $mockThreadResult1->email = $mockThreadResult1->name . "gmail.com";
        
            return array($mockThreadResult1);
        });

        $VoucherRepository->shouldReceive('getVoucherbycode')
        ->andReturnUsing(function() 
        {
            return null;
        });

        $VoucherRepository->shouldReceive('save')
        ->andReturnUsing(function() 
        {
            return null;
        });

        

        $result = $VoucherService->generateVoucher($input);
        
        $this->assertEquals("Vouchers generated for 1 recipients", $result->message);
    }
    
    public function testgenerateVoucher_Two_Recipient()
    {

        $OfferRepository = Mockery::mock(\App\Repository\IOfferRepository::class);
        $RecipientRepository = Mockery::mock(\App\Repository\IRecipientRepository::class);
        $VoucherRepository = Mockery::mock(\App\Repository\IVoucherRepository::class);
        $VoucherService = new \App\VoucherService($VoucherRepository, $OfferRepository, $RecipientRepository);

        $input = new class{};

        $input->offer_id= 1475487;
        $input->offer_name= "Special Offer";
        $input->percentageDiscount= 8.45;
        $input->expiration_date= "2018-01-20 00:00:00";


        $OfferRepository->shouldReceive('getOfferByName')
        ->Once()
        ->With($input->offer_name)
        ->andReturnUsing(function() use($input)
        {
            $mockThreadResult = new \StdClass;
            $mockThreadResult->offer_id = $input->offer_id;
            $mockThreadResult->offer_name = $input->offer_name;
        
            return $mockThreadResult;
        });

        $RecipientRepository->shouldReceive('getRecipientsWithoutVoucher')
        ->Once()
        ->With($input->offer_id)
        ->andReturnUsing(function() 
        {
            $mockThreadResult1 = new \StdClass;
            $mockThreadResult1->recipient_id = 2423;
            $mockThreadResult1->name = "Name1";
            $mockThreadResult1->email = $mockThreadResult1->name . "gmail.com";


            $mockThreadResult2 = new \StdClass;
            $mockThreadResult2->recipient_id = 567567567;
            $mockThreadResult2->name = "Name2";
            $mockThreadResult2->email = $mockThreadResult2->name . "gmail.com";
        
            return array($mockThreadResult1, $mockThreadResult2);
        });

        $VoucherRepository->shouldReceive('getVoucherbycode')
        ->andReturnUsing(function() 
        {
            return null;
        });

        $VoucherRepository->shouldReceive('save')
        ->andReturnUsing(function() 
        {
            return null;
        });

        

        $result = $VoucherService->generateVoucher($input);
        
        $this->assertEquals("Vouchers generated for 2 recipients", $result->message);
    }

    public function testgenerateVoucher_Offer_Not_Exists()
    {

        $OfferRepository = Mockery::mock(\App\Repository\IOfferRepository::class);
        $RecipientRepository = Mockery::mock(\App\Repository\IRecipientRepository::class);
        $VoucherRepository = Mockery::mock(\App\Repository\IVoucherRepository::class);
        $VoucherService = new \App\VoucherService($VoucherRepository, $OfferRepository, $RecipientRepository);

        $input = new class{};

        $input->offer_id= 1475487;
        $input->offer_name= "Special Offer";
        $input->percentage_discount = 8.45;
        $input->expiration_date= "2018-01-20 00:00:00";


        $OfferRepository->shouldReceive('getOfferByName')
        ->Once()
        ->With($input->offer_name)
        ->andReturnUsing(function()
        {
            return null;
        });


        $OfferRepository->shouldReceive('save')
        ->Once()
        ->andReturnUsing(function() use($input)
        {
            $mockThreadResult = new \StdClass;
            $mockThreadResult->offer_id = $input->offer_id;
            $mockThreadResult->offer_name = $input->offer_name;
        
            return $mockThreadResult;
        });

        $RecipientRepository->shouldReceive('getRecipientsWithoutVoucher')
        ->Once()
        ->With($input->offer_id)
        ->andReturnUsing(function() 
        {
            $mockThreadResult1 = new \StdClass;
            $mockThreadResult1->recipient_id = 2423;
            $mockThreadResult1->name = "Name1";
            $mockThreadResult1->email = $mockThreadResult1->name . "gmail.com";


            $mockThreadResult2 = new \StdClass;
            $mockThreadResult2->recipient_id = 567567567;
            $mockThreadResult2->name = "Name2";
            $mockThreadResult2->email = $mockThreadResult2->name . "gmail.com";
        
            return array($mockThreadResult1, $mockThreadResult2);
        });

        $VoucherRepository->shouldReceive('getVoucherbycode')
        ->andReturnUsing(function() 
        {
            return null;
        });

        $VoucherRepository->shouldReceive('save')
        ->andReturnUsing(function() 
        {
            return null;
        });

        

        $result = $VoucherService->generateVoucher($input);
        
        $this->assertEquals("Vouchers generated for 2 recipients", $result->message);
    }

    public function testuseVoucher_Ok()
    {

        $OfferRepository = Mockery::mock(\App\Repository\IOfferRepository::class);
        $RecipientRepository = Mockery::mock(\App\Repository\IRecipientRepository::class);
        $VoucherRepository = Mockery::mock(\App\Repository\IVoucherRepository::class);
        $VoucherService = new \App\VoucherService($VoucherRepository, $OfferRepository, $RecipientRepository);

        $input = new class{};

        $input->voucher_code = "abcdefgh";
        $input->email= "abcdefg@gmail.com";

        $auxiliaryData = new class{};
        $auxiliaryData->recipient_id = 3434322;
        $auxiliaryData->offer_id = 2334521587;
        $auxiliaryData->percentage_discount = 4.67;

        $VoucherRepository->shouldReceive('getVoucherbycode')
        ->Once()
        ->With($input->voucher_code)
        ->andReturnUsing(function() use($input, $auxiliaryData)
        {
            $mockThreadResult = new \StdClass;
            $mockThreadResult->voucher_code = $input->voucher_code;
            $mockThreadResult->expiration_date = "2018-01-18";
            $mockThreadResult->voucher_used = false;
            $mockThreadResult->usage_date = null;
            $mockThreadResult->recipient_id = $auxiliaryData->recipient_id;
            $mockThreadResult->offer_id = $auxiliaryData->offer_id;
        
            return $mockThreadResult;
        });

        $RecipientRepository->shouldReceive('getRecipientByEmail')
        ->Once()
        ->With($input->email)
        ->andReturnUsing(function() use($input, $auxiliaryData)
        {
            $mockThreadResult = new \StdClass;
            $mockThreadResult->recipient_id = $auxiliaryData->recipient_id;
            $mockThreadResult->name = "Name1";
            $mockThreadResult->email = $input->email;
        
            return $mockThreadResult;
        });
        
        $OfferRepository->shouldReceive('get')
        ->Once()
        ->With($auxiliaryData->offer_id)
        ->andReturnUsing(function() use($input, $auxiliaryData)
        {
            $mockThreadResult = new \StdClass;
            $mockThreadResult->offer_id = $auxiliaryData->offer_id;
            $mockThreadResult->offer_name = "test offer";
            $mockThreadResult->percentage_discount = $auxiliaryData->percentage_discount;
        
            return $mockThreadResult;
        });

        $VoucherRepository->shouldReceive('update')
        ->andReturnUsing(function() 
        {
            return null;
        });        

        $result = $VoucherService->useVoucher($input);
        
        $this->assertEquals(true, $result->isvalid);
        $this->assertEquals($auxiliaryData->percentage_discount, $result->percentage_discount);
        $this->assertEquals("", $result->errorMessage);
    }



    public function testuseVoucher_Wrong_Email()
    {

        $OfferRepository = Mockery::mock(\App\Repository\IOfferRepository::class);
        $RecipientRepository = Mockery::mock(\App\Repository\IRecipientRepository::class);
        $VoucherRepository = Mockery::mock(\App\Repository\IVoucherRepository::class);
        $VoucherService = new \App\VoucherService($VoucherRepository, $OfferRepository, $RecipientRepository);

        $input = new class{};

        $input->voucher_code = "abcdefgh";
        $input->email= "abcdefg@gmail.com";

        $auxiliaryData = new class{};
        $auxiliaryData->recipient_id = 3434322;
        $auxiliaryData->offer_id = 2334521587;
        $auxiliaryData->percentage_discount = 4.67;

        $VoucherRepository->shouldReceive('getVoucherbycode')
        ->Once()
        ->With($input->voucher_code)
        ->andReturnUsing(function() use($input, $auxiliaryData)
        {
            $mockThreadResult = new \StdClass;
            $mockThreadResult->voucher_code = $input->voucher_code;
            $mockThreadResult->expiration_date = "2018-01-18";
            $mockThreadResult->voucher_used = false;
            $mockThreadResult->usage_date = null;
            $mockThreadResult->recipient_id = $auxiliaryData->recipient_id;
            $mockThreadResult->offer_id = $auxiliaryData->offer_id;
        
            return $mockThreadResult;
        });

        $RecipientRepository->shouldReceive('getRecipientByEmail')
        ->Once()
        ->With($input->email)
        ->andReturnUsing(function() use($input, $auxiliaryData)
        {
            return null;
        });
             

        $result = $VoucherService->useVoucher($input);
        
        $this->assertEquals(false, $result->isvalid);
        $this->assertEquals(0, $result->percentage_discount);
        $this->assertEquals("Email not found", $result->errorMessage);
    }

    public function testuseVoucher_Wrong_Code()
    {

        $OfferRepository = Mockery::mock(\App\Repository\IOfferRepository::class);
        $RecipientRepository = Mockery::mock(\App\Repository\IRecipientRepository::class);
        $VoucherRepository = Mockery::mock(\App\Repository\IVoucherRepository::class);
        $VoucherService = new \App\VoucherService($VoucherRepository, $OfferRepository, $RecipientRepository);

        $input = new class{};

        $input->voucher_code = "abcdefgh";
        $input->email= "abcdefg@gmail.com";

        $auxiliaryData = new class{};
        $auxiliaryData->recipient_id = 3434322;
        $auxiliaryData->offer_id = 2334521587;
        $auxiliaryData->percentage_discount = 4.67;

        $VoucherRepository->shouldReceive('getVoucherbycode')
        ->Once()
        ->With($input->voucher_code)
        ->andReturnUsing(function() use($input, $auxiliaryData)
        {
            return null;
        });

        $RecipientRepository->shouldReceive('getRecipientByEmail')
        ->Once()
        ->With($input->email)
        ->andReturnUsing(function() use($input, $auxiliaryData)
        {
            $mockThreadResult = new \StdClass;
            $mockThreadResult->recipient_id = $auxiliaryData->recipient_id;
            $mockThreadResult->name = "Name1";
            $mockThreadResult->email = $input->email;
        
            return $mockThreadResult;
        });
             

        $result = $VoucherService->useVoucher($input);
        
        $this->assertEquals(false, $result->isvalid);
        $this->assertEquals(0, $result->percentage_discount);
        $this->assertEquals("Voucher code not found", $result->errorMessage);
    }



    public function testuseVoucher_Wrong_Code_And_Email_Combination()
    {

        $OfferRepository = Mockery::mock(\App\Repository\IOfferRepository::class);
        $RecipientRepository = Mockery::mock(\App\Repository\IRecipientRepository::class);
        $VoucherRepository = Mockery::mock(\App\Repository\IVoucherRepository::class);
        $VoucherService = new \App\VoucherService($VoucherRepository, $OfferRepository, $RecipientRepository);

        $input = new class{};

        $input->voucher_code = "abcdefgh";
        $input->email= "abcdefg@gmail.com";

        $auxiliaryData = new class{};
        $auxiliaryData->recipient_id = 3434322;
        $auxiliaryData->offer_id = 2334521587;
        $auxiliaryData->percentage_discount = 4.67;

        $VoucherRepository->shouldReceive('getVoucherbycode')
        ->Once()
        ->With($input->voucher_code)
        ->andReturnUsing(function() use($input, $auxiliaryData)
        {
            $mockThreadResult = new \StdClass;
            $mockThreadResult->voucher_code = $input->voucher_code;
            $mockThreadResult->expiration_date = "2018-01-18";
            $mockThreadResult->voucher_used = false;
            $mockThreadResult->usage_date = null;
            $mockThreadResult->recipient_id = $auxiliaryData->recipient_id;
            $mockThreadResult->offer_id = $auxiliaryData->offer_id;
        
            return $mockThreadResult;
        });

        $RecipientRepository->shouldReceive('getRecipientByEmail')
        ->Once()
        ->With($input->email)
        ->andReturnUsing(function() use($input, $auxiliaryData)
        {
            $mockThreadResult = new \StdClass;
            $mockThreadResult->recipient_id = 0;
            $mockThreadResult->name = "Name1";
            $mockThreadResult->email = $input->email;
        
            return $mockThreadResult;
        });
             

        $result = $VoucherService->useVoucher($input);
        
        $this->assertEquals(false, $result->isvalid);
        $this->assertEquals(0, $result->percentage_discount);
        $this->assertEquals("Wrong voucher code or e-mail", $result->errorMessage);
    }



    public function testuseVoucher_Expired_Date()
    {

        $OfferRepository = Mockery::mock(\App\Repository\IOfferRepository::class);
        $RecipientRepository = Mockery::mock(\App\Repository\IRecipientRepository::class);
        $VoucherRepository = Mockery::mock(\App\Repository\IVoucherRepository::class);
        $VoucherService = new \App\VoucherService($VoucherRepository, $OfferRepository, $RecipientRepository);

        $input = new class{};

        $input->voucher_code = "abcdefgh";
        $input->email= "abcdefg@gmail.com";

        $auxiliaryData = new class{};
        $auxiliaryData->recipient_id = 3434322;
        $auxiliaryData->offer_id = 2334521587;
        $auxiliaryData->percentage_discount = 4.67;
        $auxiliaryData->expiration_date = "2017-01-18";

        $VoucherRepository->shouldReceive('getVoucherbycode')
        ->Once()
        ->With($input->voucher_code)
        ->andReturnUsing(function() use($input, $auxiliaryData)
        {
            $mockThreadResult = new \StdClass;
            $mockThreadResult->voucher_code = $input->voucher_code;
            $mockThreadResult->expiration_date = $auxiliaryData->expiration_date;
            $mockThreadResult->voucher_used = false;
            $mockThreadResult->usage_date = null;
            $mockThreadResult->recipient_id = $auxiliaryData->recipient_id;
            $mockThreadResult->offer_id = $auxiliaryData->offer_id;
        
            return $mockThreadResult;
        });

        $RecipientRepository->shouldReceive('getRecipientByEmail')
        ->Once()
        ->With($input->email)
        ->andReturnUsing(function() use($input, $auxiliaryData)
        {
            $mockThreadResult = new \StdClass;
            $mockThreadResult->recipient_id = $auxiliaryData->recipient_id;
            $mockThreadResult->name = "Name1";
            $mockThreadResult->email = $input->email;
        
            return $mockThreadResult;
        });
             

        $result = $VoucherService->useVoucher($input);
        
        $this->assertEquals(false, $result->isvalid);
        $this->assertEquals(0, $result->percentage_discount);
        $this->assertEquals("Voucher expired: ".$auxiliaryData->expiration_date, $result->errorMessage);
    }



    public function testuseVoucher_Used_Voucher()
    {

        $OfferRepository = Mockery::mock(\App\Repository\IOfferRepository::class);
        $RecipientRepository = Mockery::mock(\App\Repository\IRecipientRepository::class);
        $VoucherRepository = Mockery::mock(\App\Repository\IVoucherRepository::class);
        $VoucherService = new \App\VoucherService($VoucherRepository, $OfferRepository, $RecipientRepository);

        $input = new class{};

        $input->voucher_code = "abcdefgh";
        $input->email= "abcdefg@gmail.com";

        $auxiliaryData = new class{};
        $auxiliaryData->recipient_id = 3434322;
        $auxiliaryData->offer_id = 2334521587;
        $auxiliaryData->percentage_discount = 4.67;
        $auxiliaryData->usage_Date = "2017-08-25";

        $VoucherRepository->shouldReceive('getVoucherbycode')
        ->Once()
        ->With($input->voucher_code)
        ->andReturnUsing(function() use($input, $auxiliaryData)
        {
            $mockThreadResult = new \StdClass;
            $mockThreadResult->voucher_code = $input->voucher_code;
            $mockThreadResult->expiration_date = "2018-01-18";
            $mockThreadResult->voucher_used = true;
            $mockThreadResult->usage_date = $auxiliaryData->usage_Date;
            $mockThreadResult->recipient_id = $auxiliaryData->recipient_id;
            $mockThreadResult->offer_id = $auxiliaryData->offer_id;
        
            return $mockThreadResult;
        });

        $RecipientRepository->shouldReceive('getRecipientByEmail')
        ->Once()
        ->With($input->email)
        ->andReturnUsing(function() use($input, $auxiliaryData)
        {
            $mockThreadResult = new \StdClass;
            $mockThreadResult->recipient_id = $auxiliaryData->recipient_id;
            $mockThreadResult->name = "Name1";
            $mockThreadResult->email = $input->email;
        
            return $mockThreadResult;
        });
             

        $result = $VoucherService->useVoucher($input);
        
        $this->assertEquals(false, $result->isvalid);
        $this->assertEquals(0, $result->percentage_discount);
        $this->assertEquals("Voucher alread used: " . $auxiliaryData->usage_Date, $result->errorMessage);
    }
    // public function getValidVoucher($email);
    // public function getUsedVoucher($email);
}
