<?php

namespace App\Http\Controllers;

use App\Http\Repositories\AttachmentRepository;
use App\Http\Repositories\ContractedCompanyRepository;
use App\Http\Repositories\OrderItemRepository;
use App\Http\Repositories\OrderRepository;
use App\Http\Services\OrderService;
use App\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    /**
     *
     * @var OrderRepository
     */
    protected $orderRepository;
    /**
     * @var OrderService
     */
    private $orderService;
    /**
     * @var OrderItemRepository
     */
    private $orderItemRepository;
    /**
     * @var AttachmentRepository
     */
    private $attachmentRepository;
    /**
     * @var ContractedCompanyRepository
     */
    private $contractedCompanyRepository;

    /**
     *
     * @param OrderRepository $orderRepository
     * @param OrderItemRepository $orderItemRepository
     * @param AttachmentRepository $attachmentRepository
     * @param ContractedCompanyRepository $contractedCompanyRepository
     * @param OrderService $orderService
     */
    public function __construct(OrderRepository $orderRepository, OrderItemRepository $orderItemRepository, AttachmentRepository $attachmentRepository, ContractedCompanyRepository $contractedCompanyRepository, OrderService $orderService)
    {
        $this->orderRepository = $orderRepository;
        $this->orderItemRepository = $orderItemRepository;
        $this->attachmentRepository = $attachmentRepository;
        $this->contractedCompanyRepository = $contractedCompanyRepository;
        $this->orderService = $orderService;
    }

    /**
     *
     * @param integer $orderId
     * @return void
     */
    public function show(int $orderId)
    {
        $order = $this->orderRepository->show($orderId);
        return $order;
    }

    /**
     * get order item by order id
     *
     * @param integer $id
     * @return void
     */
    public function getOrderItem(int $id)
    {
        $order_item = $this->orderRepository->getOrderItem($id);
        return $order_item;
    }

    /**
     * get contracted company by order id
     *
     * @param integer $id
     * @return void
     */
    public function getContractedCompany(int $id)
    {
        $contractedcompany = $this->orderRepository->getContractedCompany($id);
        return $contractedcompany;
    }

    /**
     * get attachment by order id
     *
     * @param integer $id
     * @return void
     */
    public function getAttachment(int $id)
    {
        $attachment = $this->orderRepository->getAttachment($id);
        return $attachment;
    }

    /**
     * 編集する案件情報を取得
     *
     * @param integer $orderId
     * @return void
     */
    public function getEdit(int $orderId)
    {
        $order_info = $this->orderRepository->findById($orderId);
        return $order_info;
    }

    /**
     *
     * searchOrder
     * @param Request $request
     * @return void
     */
    public function searchOrder(Request $request)
    {
        $data = $request->all();
        return $this->orderRepository->findByData($data);
    }

    /**
     *
     * index
     * @param Request $request
     * @return void
     */
    public function index(Request $request)
    {
        $data = $request->all();
        return $this->orderService->findByData($data);
    }

    /**
     * 案件から見積もりIDだけの配列を取得
     *
     * @return void
     */
    public function getDocumentIdArray()
    {
        $data = $this->orderRepository->getDocumentIdArray();
        return $data;
    }

    /**
     * create that order
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        return $this->orderService->create($request->toArray());
    }

    /**
     * 見積もり一覧から案件を作成
     *
     * @param Request $request
     * @return void
     */
    public function storeFromDocument(Request $request)
    {
        return $this->orderService->store($request);
    }

    /**
     *
     * @param Request $request
     * @param $orderId
     * @return void
     */
    public function update(Request $request, $orderId)
    {
        return $this->orderService->update($request->toArray(), $orderId);
    }

    /**
     * Undocumented function
     *
     * @param Order $order
     * @return void
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return response()->json();
    }
}
