<?php

namespace App\Http\Controllers;

use App\Http\Models\ContractedCompany;
use Illuminate\Http\Request;
use App\Http\Repositories\ContractedCompanyRepository;
use App\Http\Resources\ContractedCompanyResource;

class ContractedCompanyController extends Controller
{
  /** @var ContractedCompanyRepository */
  protected $contractedcompanyrepository;

  public function __construct(ContractedCompanyRepository $contractedcompanyrepository)
  {
    $this->contractedcompanyrepository = $contractedcompanyrepository;
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $ccompany = $this->contractedcompanyrepository->findAll();
    return $ccompany;
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show(ContractedCompany $contractedCompany): ContractedCompanyResource
  {
    return new ContractedCompanyResource($contractedCompany);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, ContractedCompany $contractedcompany)
  {
    $contractedcompany->update($request->all());
    return new ContractedCompanyResource($contractedcompany);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(ContractedCompany $contractedcompany)
  {
    $contractedcompany->delete();

    return response()->json();
  }
}
