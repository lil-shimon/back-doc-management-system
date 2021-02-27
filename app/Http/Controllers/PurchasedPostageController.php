<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Repositories\PurchasedPostageRepository;

class PurchasedPostageController extends Controller
{
    /** @var PurchasedpostageRepository */
    protected $purchasedPostagerepository;

    public function __construct(PurchasedPostageRepository $purchasedpostagerepository)
    {
        $this->purchasedpostagerepository = $purchasedpostagerepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $postages = $this->purchasedpostagerepository->postagefindAll();
        return $postages;
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
        $postages = $this->purchasedpostagerepository->show($id);
        return $postages;
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
