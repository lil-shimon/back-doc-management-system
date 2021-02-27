<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Repositories\DocumentFormRepository;
use App\Http\Requests\DocumentRequest;

class DocumentFormController extends Controller
{
    /** @var DocumentFormRepository */
    protected $documentformRepository;

    public function __construct(DocumentFormRepository $documentformRepository)
    {
        $this->documentformRepository = $documentformRepository;
    }

    public function add_document(DocumentRequest $request)
    {
        $doc_info = $request->input("doc_info");
        $doc_item = $request->input("doc_item");
        $doc_type = $request->input("doc_type");
        $remarks = $request->input("remarks");
        $this->documentformRepository->add_document($doc_info, $doc_item, $doc_type, $remarks);
    }

    public function company_logo_index()
    {
        $company_logo = $this->documentformRepository->companylogofindAll();
        return $company_logo;
    }
}
