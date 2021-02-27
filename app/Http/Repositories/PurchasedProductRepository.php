<?php

namespace App\Http\Repositories;

use Carbon\Carbon;
use App\Http\Models\PurchasedProduct;

class PurchasedProductRepository
{
    /** @var  PurchasedProduct*/
    protected $purchasedproduct;

    public function __construct(PurchasedProduct $purchasedproduct)
    {
        $this->purchasedproduct = $purchasedproduct;
    }

    /**
     * 全取得
     *
     * @return 
     */
    public function purchasedproductfindAll()
    {
        $purchasedproduct = $this->purchasedproduct->all();
        return $purchasedproduct;
    }

    /**
     * 書類ごとに取得
     *
     * @return 
     */
    public function show($id)
    {
        $purchasedproduct = $this->purchasedproduct->where("document_id", $id)->get();
        return $purchasedproduct;
    }
}
