<?php

namespace App\Repository;

interface IOfferRepository {
    
    public function getAll();
    public function get($id);
    public function getOfferByName($offerName);
    public function save($currentOffer);
}