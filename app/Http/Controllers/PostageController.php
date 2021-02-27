<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostageRequest;
use App\Http\Repositories\PostageRepository;
use Illuminate\Http\Request;

class PostageController extends Controller
{

    /** @var PostageRepository */
    protected $postagerepository;

    public function __construct(PostageRepository $postagerepository)
    {
        $this->postagerepository = $postagerepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $postages = $this->postagerepository->postagefindAll();
        return $postages;
    }

    /**
     * 送料（ページネーション）
     *
     * @param Request $request
     * @return void
     */
    public function postageIndex(Request $request)
    {
        $data = $this->postagerepository->postageIndex($request);
        return $data;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostageRequest $request)
    {
        $edititem = $request->input("editItem");
        $this->postagerepository->add_postage($edititem);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $this->postagerepository->delete($id);
    }
}
