<?php

namespace App\Http\Repositories;

use App\Http\Models\CompanyLogo;
use Carbon\Carbon;
use App\Http\Models\Document;

class CompanyLogoRepository
{
    /** @var CompanyLogo */
    protected $companylogo;

    /** @var Document */
    protected $document;

    public function __construct(CompanyLogo $companylogo, Document $document)
    {
        $this->companylogo = $companylogo;
        $this->document = $document;
    }

    /**
     * 全会社ロゴ取得
     *
     * @return 
     */
    public function companylogofindAll()
    {
        $companylogo = $this->companylogo->all();
        return $companylogo;
    }

    /**
     * 会社ロゴ追加
     *
     * @return 
     */
    public function add_company_logo(string $title, $file)
    {
        $this->companylogo->insert([
            [
                "name" => $title,
                "img_path" => $file->getClientOriginalName(),
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ]
        ]);
    }

    /**
     * ロゴ取得
     * 
     * @return
     */
    public function getbase64Image(string $img_path)
    {
        // $doc_info = $this->document->where("id", $doc_id)->get()->toarray();
        return base64_encode(file_get_contents(storage_path("app/public/" . $img_path)));
    }

    /**
     * 削除
     *
     * @return 
     */
    public function delete(string $id)
    {
        $this->companylogo->where("id", $id)->delete();
    }
}
