<?php

namespace App\Repository;

interface IOfferRepository {
    
    public function getAll();
    public function getOfferByName($offerName);
    public function save($currentOffer);
}