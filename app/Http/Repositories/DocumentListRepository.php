<?php

namespace App\Http\Repositories;

use App\Documents;
use App\ProductList;
use App\PostageList;
use App\Models\User;
use App\CompanyLogo;

class DocumentListRepository
{
    /** @var Documents */
    protected $documents;

    /** @var ProductList */
    protected $productlist;

    /** @var PostageList */
    protected $postagelist;

    /** @var User */
    protected $user;

    /** @var CompanyLogo */
    protected $companylogo;

    public function __construct(Documents $documents, ProductList $productlist, PostageList $postagelist, User $user, CompanyLogo $companylogo)
    {
        $this->documents = $documents;
        $this->productlist = $productlist;
        $this->postagelist = $postagelist;
        $this->user = $user;
        $this->companylogo = $companylogo;
    }

    /**
     * 全ドキュメント取得
     *
     * @return 
     */
    public function documentfindAll()
    {
        $documents = $this->documents->all();
        return $documents;
    }

    /**
     * 絞り込み後ドキュメント取得
     *
     * @return 
     */
    public function narrow_down_doc(string $show_doc_type_id, array $select_items)
    {
        $column_name = ["sell_part_id", "see_part_id", "customer_part_id", "status"];
        // 0: 全て表示なのでdocument_typeを指定しない
        if ($show_doc_type_id != 0) {
            $documents_sortquery = $this->documents->where("document_type_id", $show_doc_type_id);
        } else {
            $documents_sortquery = $this->documents;
        }
        // sell,see,customerが指定されてるか確認
        foreach ($select_items as $index => $row) {
            $row_dict = json_decode($row, true);
            // valueが-1だったら絞り込みを指定していない
            if ($row_dict["value"] != -1) {
                $documents_sortquery = $documents_sortquery->where($column_name[$index], $row_dict["value"]);
            }
        }
        $documents = $documents_sortquery->get();
        return $documents;
    }

    /**
     * 書類の種類ごとに取得
     *
     * @return 
     */
    public function select_doc_type(string $show_doc_type_id)
    {
        $documents = $this->documents
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
            $documents = $this->documents->onlyTrashed()->get();
        } else {
            $documents = $this->documents->onlyTrashed()->where("document_type_id", $show_doc_type_id)->get();
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
        $this->documents->where("id", $doc_id)->delete();
    }
}
