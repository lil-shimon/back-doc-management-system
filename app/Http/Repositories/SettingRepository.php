<?php

namespace App\Http\Repositories;

use App\Http\Models\ProductList;
use App\Http\Models\PostageList;
use App\Http\Models\User;
use App\Http\Models\CompanyLogo;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class SettingRepository
{
    /** @var ProductList */
    protected $productlist;

    /** @var PostageList */
    protected $postagelist;

    /** @var User */
    protected $user;

    /** @var CompanyLogo */
    protected $companylogo;

    public function __construct(ProductList $productlist, PostageList $postagelist, User $user, CompanyLogo $companylogo)
    {
        $this->productlist = $productlist;
        $this->postagelist = $postagelist;
        $this->user = $user;
        $this->companylogo = $companylogo;
    }

    /**
     * 全商品取得
     *
     * @return 
     */
    public function productfindAll()
    {
        $products = $this->productlist->all();
        return $products;
    }

    /**
     * 全送料取得
     *
     * @return 
     */
    public function postagefindAll()
    {
        $products = $this->postagelist->all();
        return $products;
    }

    /**
     * 全ユーザー取得
     *
     * @return 
     */
    public function userfindAll()
    {
        $user = $this->user->all();
        return $user;
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
     * 商品追加
     *
     * @return 
     */
    public function add_product(array $edititem)
    {
        if (array_key_exists("id", $edititem)) {
            // 存在する:編集
            // 削除
            $this->productlist->where("id", $edititem["id"])->delete();
        }
        $this->productlist->insert([
            [
                "name" => $edititem["name"],
                "unit" => $edititem["unit"],
                "unit_price" => $edititem["unit_price"],
                "tax" => $edititem["tax"],
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ]
        ]);
    }

    /**
     * 送料追加
     *
     * @return 
     */
    public function add_postage(array $edititem)
    {
        if (array_key_exists("id", $edititem)) {
            // 存在する:編集
            // 削除
            $this->postagelist->where("id", $edititem["id"])->delete();
        }
        $this->postagelist->insert([
            [
                "sender_place" => $edititem["sender_place"],
                "destination_place" => $edititem["destination_place"],
                "postage_price" => $edititem["postage_price"],
                "tax" => $edititem["tax"],
                "size" => $edititem["size"],
                "unit" => "個",
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ]
        ]);
    }

    /**
     * ユーザー追加
     *
     * @return 
     */
    public function add_user(array $edititem)
    {
        if (array_key_exists("id", $edititem)) {
            // 存在する:編集
            // 削除
            $this->user->where("id", $edititem["id"])->delete();
        }
        $this->user->insert([
            [
                "name" => $edititem["name"],
                "email" => $edititem["email"],
                "password" => Hash::make($edititem["password"]),
                "company_id" => 1,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ]
        ]);
    }

    /**
     * 会社ロゴ追加
     *
     * @return 
     */
    public function add_company_logo(array $edititem, string $img_path)
    {
        if (array_key_exists("id", $edititem)) {
            // 存在する:編集
            // 削除
            $this->companylogo->where("id", $edititem["id"])->delete();
        }
        $this->companylogo->insert([
            [
                "name" => $edititem["name"],
                "img_path" => $img_path,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ]
        ]);
    }
}
