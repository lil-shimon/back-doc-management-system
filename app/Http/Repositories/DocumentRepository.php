<?php

namespace App\Http\Repositories;

use App\Http\Models\Document;
use App\Http\Models\CompanyLogo;
use App\Http\Models\PurchasedProduct;
use App\Http\Models\PurchasedPostage;
use App\Http\Models\User;
use App\Http\Models\ContractedCompany;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\DocumentRequest;

class DocumentRepository
{
    /** @var Document */
    protected $document;

    /** @var CompanyLogo */
    protected $companylogo;

    /** @var  PurchasedProduct*/
    protected $purchasedproduct;

    /** @var  PurchasedPostage*/
    protected $purchasedpostage;

    /** @var  User*/
    protected $user;

    /** @var ContractedCompany */
    protected $contractedcompany;


    public function __construct(Document $document, CompanyLogo $companylogo, PurchasedProduct $purchasedproduct, PurchasedPostage $purchasedpostage, User $user, ContractedCompany $contractedcompany)
    {
        $this->document = $document;
        $this->companylogo = $companylogo;
        $this->purchasedproduct = $purchasedproduct;
        $this->purchasedpostage = $purchasedpostage;
        $this->user = $user;
        $this->contractedcompany = $contractedcompany;
    }

    /**
     * idで見積もりを取得
     *
     * @param integer $id
     * @return void
     */
    public function show(int $id)
    {
        // $document = $this->document->with('Users')->find($id);
        $document = $this->document->find($id);
        return $document;
    }

    /**
     * 全ドキュメント取得
     *
     * @return 
     */
    public function documentfindAll()
    {
        $documents = $this->document->with('Users')
            ->orderBy('id', 'desc')
            ->get();
        return $documents;
    }

    /**
     * 絞り込み後ドキュメント取得
     *
     * @return 
     */
    public function narrow_down_doc(string $show_doc_type_id, array $select_items, string $is_show_trash)
    {
        $column_name = ["sell_part_id", "see_part_id", "customer_part_id", "status"];
        // 0: 全て表示なのでdocument_typeを指定しない
        if ($show_doc_type_id != 0) {
            $documents_sortquery = $this->document->where("document_type_id", $show_doc_type_id);
        } else {
            $documents_sortquery = $this->document;
        }

        if ($is_show_trash == 1) {
            $documents_sortquery = $documents_sortquery->onlyTrashed();
        }

        // sell,see,customerが指定されてるか確認
        foreach ($select_items as $index => $row) {
            // logger($row);
            // $row_dict = json_decode($row, true);
            // valueが-1だったら絞り込みを指定していない
            // logger(gettype($row_dict));
            if ($row != -1) {
                $documents_sortquery = $documents_sortquery->where($column_name[$index], (int) $row);
            }
        }
        $documents = $documents_sortquery->with('Users')->get();
        logger($documents);
        return $documents;
    }

    /**
     * 書類の種類ごとに取得
     *
     * @return 
     */
    public function select_doc_type(string $show_doc_type_id)
    {
        $documents = $this->document
            ->where("document_type_id", $show_doc_type_id)
            ->get();
        return $documents;
    }

    /**
     * 削除した書類の種類ごとに取得
     *
     * @return 
     */
    public function deleted_doc_list(string $show_doc_type_id)
    {
        if ($show_doc_type_id == 0) {
            $documents = $this->document->onlyTrashed()->get();
        } else {
            $documents = $this->document->onlyTrashed()->where("document_type_id", $show_doc_type_id)->get();
        }
        return $documents;
    }

    /**
     * 書類の削除
     *
     * @return 
     */
    public function delete(string $doc_id)
    {
        if ($this->document->onlyTrashed()->where("id", $doc_id)->count() == 1) {
            $this->purchasedproduct->where("document_id", $doc_id)->forceDelete();
            $this->purchasedpostage->where("document_id", $doc_id)->forceDelete();
            $this->document->onlyTrashed()->where("id", $doc_id)->forceDelete();
        } else {
            $this->purchasedproduct->where("document_id", $doc_id)->delete();
            $this->purchasedpostage->where("document_id", $doc_id)->delete();
            $this->document->where("id", $doc_id)->delete();
        }
    }

    /**
     * 書類データ保存
     *
     * @return 
     */
    public function add_document(array $doc_info, array $product_item, array $postage_item, string $remarks = null)
    {
        $current_user = Auth::user();
        $this->document->insert([
            [
                "sell_part_id" => $doc_info["sell_part_id"],
                "see_part_id" => $doc_info["see_part_id"],
                "customer_part_id" => $doc_info["customer_part_id"],
                "document_type_id" => $doc_info["document_type_id"],
                "user_id" => $doc_info["user_id"],
                "document_title" => $doc_info["document_title"],
                "remarks" => $remarks,
                "logo_img_path" => $doc_info["logo_img_path"],
                "status" => 0,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
                "business_partner_company_name" => $doc_info["business_partner_company_name"],
                "honorific_title" => $doc_info["honorific_title"],
                "payment_terms" => $doc_info["payment_terms"],
                "usage_period" => $doc_info["usage_period"],
                'duration_of_service' => $doc_info['duration_of_service'],
                "term_and_conditions" => $doc_info["term_and_conditions"],
                "quotation_expiration_date" => $doc_info["quotation_expiration_date"],
                "sub_total" => $doc_info["sub_total"],
                "total_price" => $doc_info["total_price"]
            ]
        ]);
        $id = $this->document->max("id");
        foreach ($product_item as $item) {
            if ($item["name"] == "") {
                continue;
            }
            $this->purchasedproduct->insert([
                [
                    "document_id" => $id,
                    "name" => $item["name"],
                    "number" => $item["number"],
                    "unit" => $item["unit"],
                    "unit_price" => $item["unit_price"],
                    "tax" => $item["tax"],
                    "notes" => $item["notes"]
                ]
            ]);
        }
        foreach ($postage_item as $item) {
            if ($item["sender_place"] == "") {
                continue;
            }
            $this->purchasedpostage->insert([
                [
                    "document_id" => $id,
                    "sender_place" => $item["sender_place"],
                    "destination_place" => $item["destination_place"],
                    "postage_price" => $item["postage_price"],
                    "quantity" => $item["quantity"],
                    "tax" => $item["tax"],
                    "size" => $item["size"],
                    "unit" => "個"
                ]
            ]);
        }
    }

    /**
     * 書類数を取得
     *
     * @return 
     */
    public function get_document_lenght()
    {
        $document_no = $this->document->max("id");
        return $document_no;
    }

    /**
     * pdf用の書類情報取得
     *
     * @return 
     */
    public function get_doc_info(string $doc_id)
    {
        $document_info = $this->document->with('Users')->where("id", $doc_id)->get();
        return $document_info;
    }

    /**
     * pdf用の書類情報取得
     *
     * @return 
     */
    public function get_doc_item(string $doc_id)
    {
        $document_item = $this->purchasedproduct->where("document_id", $doc_id)->get();
        return $document_item;
    }

    /**
     * ステータスの変更
     * 
     * @return
     */
    public function change_status(string $doc_id, string $status)
    {
        if ($status == "0") {
            $this->document->where("id", $doc_id)->update(['status' => 1]);
        } else {
            $this->document->where("id", $doc_id)->update(['status' => 0]);
        }
    }

    /**
     * 書類の復元
     * 
     * @return
     */
    public function restore(string $doc_id)
    {
        $this->document->onlyTrashed()->where("id", $doc_id)->restore();
    }

    /**
     *
     * @param DocumentRequest $request
     * @param integer $id
     * @return void
     */
    public function update(DocumentRequest $request, int $id)
    {
        $doc_info = Document::find($id);
        $doc_info->document_title = $request->document_title;
        $doc_info->logo_img_path = $request->logo_img_path;
        $doc_info->user_id = $request->user_id;
        $doc_info->remarks = $request->remarks;
        $doc_info->business_partner_company_name = $request->business_partner_company_name;
        $doc_info->honorific_title = $request->honorific_title;
        $doc_info->payment_terms = $request->payment_terms;
        $doc_info->usage_period = $request->usage_period;
        $doc_info->term_and_conditions = $request->term_and_conditions;
        $doc_info->duration_of_service = $request->duration_of_service;
        $doc_info->total_price = $request->total_price;
        $doc_info->sub_total = $request->sub_total;
        $doc_info->save();
    }
}
