<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Repositories\ProductRepository;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    /** @var ProductRepository */
    protected $productrepository;

    public function __construct(ProductRepository $productrepository)
    {
        $this->productrepository = $productrepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->productrepository->productfindAll();
        return $products;
    }

    /**
     * 商品カテゴリーで商品取得
     *
     * @param Request $request
     * @param [type] $product_types_id
     * @return void
     */
    public function productTypesIdIndex(Request $request, $product_types_id)
    {
        $data = $this->productrepository->productTypesIdIndex($request, $product_types_id);
        return $data;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $edititem = $request->input("editItem");
        $this->productrepository->add_product($edititem);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = $this->productrepository->show($id);
        return $product;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->productrepository->delete($id);
    }
}
