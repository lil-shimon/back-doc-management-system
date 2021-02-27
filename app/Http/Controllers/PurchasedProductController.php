<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Repositories\PurchasedProductRepository;

class PurchasedProductController extends Controller
{

    /** @var PurchasedProductRepository */
    protected $purchasedproductrepository;

    public function __construct(PurchasedProductRepository $purchasedproductrepository)
    {
        $this->purchasedproductrepository = $purchasedproductrepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $products = $this->purchasedproductrepository->productfindAll();
       return $products;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $products = $this->purchasedproductrepository->show($id);
        return $products;
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
        //
    }
}
