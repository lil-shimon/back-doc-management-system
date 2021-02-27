<?php

namespace App\Http\Repositories;

use Carbon\Carbon;
use App\Http\Models\PurchasedPostage;

class PurchasedPostageRepository
{
    /** @var  PurchasedPostage*/
    protected $purchasedpostage;

    public function __construct(PurchasedPostage $purchasedpostage)
    {
        $this->purchasedpostage = $purchasedpostage;
    }

    /**
     * 全取得
     *
     * @return 
     */
    public function purchasedproductfindAll()
    {
        $purchasedpostage = $this->purchasedpostage->all();
        return $purchasedpostage;
    }

    /**
     * 書類ごとに取得
     *
     * @return 
     */
    public function show($id)
    {
        $purchasedpostage = $this->purchasedpostage->where("document_id", $id)->get();
        return $purchasedpostage;
    }
}
