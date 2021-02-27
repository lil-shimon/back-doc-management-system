<?php

namespace App\Http\Repositories;

use App\Documents;
use Illuminate\Http\Request;
use App\CompanyLogo;
use Carbon\Carbon;
use App\PurchasedProduct;

class DocumentFormRepository
{
    /** @var Document */
    protected $document;

    /** @var CompanyLogo */
    protected $company_logo;

    /** @var  PurchasedProduct*/
    protected $purchased_product;

    public function __construct(Documents $document, CompanyLogo $company_logo, PurchasedProduct $purchased_product)
    {
        $this->document = $document;
        $this->company_logo = $company_logo;
        $this->purchased_product = $purchased_product;
    }

    /**
     * 書類データ保存
     *
     * @return 
     */
    public function add_document(array $doc_info, array $doc_item, string $doc_type, string $remarks = null)
    {
        $this->document->insert([
            [
                "sell_part_id" => $doc_info["sell_part"],
                "see_part_id" => $doc_info["see_part"],
                "customer_part_id" => $doc_info["customer_part"],
                "document_type_id" => $doc_type,
                "user_id" => 1,
                "document_title" => $doc_info["title"],
                "remarks" => $remarks,
                "logo_img_path" => $doc_info["company_logo"],
                "status" => 0,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now()
            ]
        ]);

        foreach ($doc_item as $item) {
            if ($item["name"] == "") {
                continue;
            }
            $this->purchased_product->insert([
                [
                    "document_id" => $doc_type,
                    "name" => $item["name"],
                    "number" => $item["number"],
                    "unit" => $item["unit"],
                    "unit_price" => $item["unit_price"],
                    "tax" => $item["tax"],
                ]
            ]);
        }
    }

    /**
     * 全ロゴ取得
     *
     * @return 
     */
    public function companylogofindAll()
    {
        $company_logo = $this->company_logo->all();
        return $company_logo;
    }
}
