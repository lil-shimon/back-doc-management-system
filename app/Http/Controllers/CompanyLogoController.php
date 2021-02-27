<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Repositories\CompanyLogoRepository;
use App\Http\Requests\CompanyLogoRequest;

class CompanyLogoController extends Controller
{

    /** @var CompanyLogoRepository */
    protected $companylogorepository;

    public function __construct(CompanyLogoRepository $companylogorepository)
    {
        $this->companylogorepository = $companylogorepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $company_logo = $this->companylogorepository->companylogofindAll();
        return $company_logo;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyLogoRequest $request)
    {
        $this->companylogorepository->add_company_logo($request->title, $request->file);
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
        $this->companylogorepository->delete($id);
    }

    public function getbase64Image(CompanyLogoRequest $request)
    {
        $img_path = $request->input("img_path");
        $img = $this->companylogorepository->getbase64Image($img_path);
        return $img;
    }
}
