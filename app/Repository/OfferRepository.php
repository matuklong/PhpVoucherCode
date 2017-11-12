<?php

use \App\Offer;
namespace App\Repository;

class OfferRepository implements IOfferRepository {
    
    public function getAll()
    {
        return \App\Offer::all();
    }

}
