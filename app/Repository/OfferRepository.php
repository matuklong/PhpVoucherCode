<?php

use \App\Offer;
namespace App\Repository;

class OfferRepository implements IOfferRepository {
    
    public function getAll()
    {
        return \App\Offer::all();
    }

    public function get($id)
    {
        return \App\Offer::where('offer_id', '=', $id)->first();
    }

    public function getOfferByName($offerName)
    {
        return \App\Offer::where('offer_name', '=', $offerName)->first();
    }

    public function save($currentOffer)
    {
        $offer = new \App\Offer;
        $offer->offer_name = $currentOffer->offer_name;
        $offer->percentage_discount = $currentOffer->percentage_discount;
        $offer->save();
        
        return $offer;
    }

}
