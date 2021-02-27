<?php

namespace App\Http\Repositories;

use App\Http\Models\ProductList;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProductRepository
{
    /** @var ProductList */
    protected $productlist;

    public function __construct(ProductList $productlist)
    {
        $this->productlist = $productlist;
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
     *
     * @param Request $request
     * @param [type] $product_types_id
     * @return void
     */
    public function productTypesIdIndex(Request $request, $product_types_id)
    {
        $query = ProductList::query();
        $search = $request->input('name');

        if ($request->has('name') && $search !== '') {
            $query->where('name', 'like', '%' . $search . '%')->get();
        }

        $data = $query->orderBy('id', 'desc')
            ->where("product_types_id", $product_types_id)
            ->paginate();
        return $data;
    }

    /**
     * 商品追加
     *
     * @return 
     */
    public function add_product(array $edititem)
    {
        $this->productlist->insert([
            [
                "name" => $edititem["name"],
                "unit" => $edititem["unit"],
                "unit_price" => $edititem["unit_price"],
                "tax" => $edititem["tax"],
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
                "notes" => $edititem["notes"],
                "product_types_id" => $edititem["product_types_id"]
            ]
        ]);
    }

    /**
     *
     * @param integer $id
     * @return void
     */
    public function show(int $id)
    {
        $product = $this->productlist->find($id);
        return $product;
    }

    /**
     * 削除
     *
     * @return 
     */
    public function delete(string $id)
    {
        $this->productlist->where("id", $id)->delete();
    }
}
