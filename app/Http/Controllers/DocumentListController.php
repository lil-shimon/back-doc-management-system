<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Repositories\DocumentListRepository;
use App\Documents;
use App\Http\Requests\DocumentRequest;

class DocumentListController extends Controller
{
    /** @var DocumentListRepository */
    protected $documentlistRepository;

    public function __construct(DocumentListRepository $documentlistRepository)
    {
        $this->documentlistRepository = $documentlistRepository;
    }

    /**
     * 全ドキュメント取得
     *
     * @return 
     */
    public function document_index()
    {
        $documents = $this->documentlistRepository->documentfindAll();
        return $documents;
    }

    /**
     * 絞り込み後ドキュメント取得
     *
     * @return 
     */
    public function narrow_down_doc(DocumentRequest $request)
    {
        $show_doc_type_id = $request->input("show_doc_type_id");
        $select_items = $request->input("select_items");
        $documents = $this->documentlistRepository
            ->narrow_down_doc($show_doc_type_id, $select_items);
        return $documents;
    }

    /**
     * 書類の種類ごとに取得
     *
     * @return 
     */
    public function select_doc_type(DocumentRequest $request)
    {
        $show_doc_type_id = $request->input("show_doc_type_id");
        $documents = $this->documentlistRepository
            ->select_doc_type($show_doc_type_id);
        return $documents;
    }

    /**
     * 書類の削除
     *
     * @return 
     */
    public function delete(DocumentRequest $request)
    {
        $doc_id = $request->input("id");
        $this->documentlistRepository->delete($doc_id);
        return redirect()->to("/api/doc-list");
    }

    /**
     * 削除した書類の種類ごとに取得
     *
     * @return 
     */
    public function deleted_doc_list(DocumentRequest $request)
    {
        $show_doc_type_id = $request->input("show_doc_type_id");
        $documents = $this->documentlistRepository->deleted_doc_list($show_doc_type_id);
        return $documents;
    }
}
