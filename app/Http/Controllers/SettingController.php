<?php

namespace App\Http\Controllers;

use App\Http\Repositories\SettingRepository;
use App\Http\Requests\SettingRequest;

class SettingController extends Controller
{
    /** @var SettingRepository */
    protected $settingRepository;

    public function __construct(SettingRepository $settingRepository)
    {
        $this->settingRepository = $settingRepository;
    }

    /**
     * 全商品取得
     *
     * @return 
     */
    public function product_index()
    {
        $products = $this->settingRepository->productfindAll();
        return $products;
    }

    /**
     * 全送料取得
     *
     * @return 
     */
    public function postage_index()
    {
        $postages = $this->settingRepository->postagefindAll();
        return $postages;
    }

    /**
     * 全ユーザー取得
     *
     * @return 
     */
    public function user_index()
    {
        $user = $this->settingRepository->userfindAll();
        return $user;
    }

    /**
     * 全会社ロゴ取得
     *
     * @return 
     */
    public function company_logo_index()
    {
        $company_logo = $this->settingRepository->companylogofindAll();
        return $company_logo;
    }

    /**
     * 商品追加
     *
     * @return 
     */
    public function add_product(SettingRequest $request)
    {
        $edititem = $request->input("editItem");
        $this->settingRepository->add_product($edititem);
    }

    /**
     * 送料追加
     *
     * @return 
     */
    public function add_postage(SettingRequest $request)
    {
        $edititem = $request->input("editItem");
        $this->settingRepository->add_postage($edititem);
    }

    /**
     * ユーザー追加
     *
     * @return 
     */
    public function add_user(SettingRequest $request)
    {
        $edititem = $request->input("editItem");
        $this->settingRepository->add_user($edititem);
    }

    /**
     * 会社ロゴ追加
     *
     * @return 
     */
    public function add_company_logo(SettingRequest $request)
    {
        $edititem = $request->input("editItem");
        $img_path = $request->input("img_path");
        $this->settingRepository->add_company_logo($edititem, $img_path);
    }
}
