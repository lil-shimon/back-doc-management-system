<?php

namespace App\Http\Controllers;

use App\Http\Repositories\DocumentRepository;
use App\Http\Requests\DocumentRequest;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    /** @var DocumentRepository */
    protected $documentRepository;

    public function __construct(DocumentRepository $documentRepository)
    {
        $this->documentRepository = $documentRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $documents = $this->documentRepository->documentfindAll();
        return $documents;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DocumentRequest $request)
    {
        $remarks = null;
        $doc_info = $request->input("doc_info");
        $product_item = $request->input("product_item");
        $postage_item = $request->input("postage_item");
        $remarks = $request->input("remarks");
        $this->documentRepository->add_document($doc_info, $product_item, $postage_item, $remarks);
    }

    /**
     *
     * @param integer $id
     * @return void
     */
    public function show(int $id)
    {
        $document = $this->documentRepository->show($id);
        return $document;
    }

    /**
     *
     * @param DocumentRequest $request
     * @param integer $id
     * @return void
     */
    public function update(DocumentRequest $request, int $id)
    {
        $doc_info = $this->documentRepository->update($request, $id);
        return $doc_info;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($doc_id)
    {
        $this->documentRepository->delete($doc_id);
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
        $is_show_trash = $request->input("is_show_trash");
        $documents = $this->documentRepository
            ->narrow_down_doc($show_doc_type_id, $select_items, $is_show_trash);
        return $documents;
    }

    /**
     * 削除した書類の種類ごとに取得
     *
     * @return 
     */
    public function deleted_doc_list(DocumentRequest $request)
    {
        $show_doc_type_id = $request->input("show_doc_type_id");
        $documents = $this->documentRepository->deleted_doc_list($show_doc_type_id);
        return $documents;
    }

    /**
     * 現在の書類数取得
     *
     * @return 
     */
    public function get_document_lenght()
    {
        $document_lenght = $this->documentRepository->get_document_lenght();
        return $document_lenght;
    }

    /**
     * 書類情報取得
     *
     * @return 
     */
    public function get_doc_info(DocumentRequest $request)
    {
        $doc_id = $request->input("id");
        $document_info = $this->documentRepository->get_doc_info($doc_id);
        return $document_info;
    }

    /**
     * 書類アイテム取得
     *
     * @return 
     */
    public function get_doc_item(DocumentRequest $request)
    {
        $doc_id = $request->input("id");
        $document_item = $this->documentRepository->get_doc_item($doc_id);
        return $document_item;
    }

    /**
     * ステータスの更新
     * 
     * @return
     */
    public function change_status(DocumentRequest $request)
    {
        $doc_id = $request->input("id");
        $status = $request->input('status');
        $this->documentRepository->change_status($doc_id, $status);
    }

    /**
     * 書類の復元
     * 
     * @return
     */
    public function restore(DocumentRequest $request)
    {
        $doc_id = $request->input("id");
        $this->documentRepository->restore($doc_id);
    }
}
