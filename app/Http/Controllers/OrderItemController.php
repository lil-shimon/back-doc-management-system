<?php

namespace App\Http\Controllers;

use App\Http\Repositories\OrderItemRepository;
use App\Http\Resources\OrderItemResource;
use App\Http\Resources\OrderItemResourceCollection;
use App\OrderItem;
use Illuminate\Http\Request;

class OrderItemController extends Controller
{
    /**
     * @var OrderItemRepository
     */
    private $orderItemRepository;

    /**
     *
     * @param OrderItemRepository $orderItemRepository
     */
    public function __construct(OrderItemRepository $orderItemRepository)
    {
        $this->orderItemRepository = $orderItemRepository;
    }

    /**
     *
     * @param OrderItem $orderitem
     * @return OrderItemResource
     */
    public function show(OrderItem $orderitem): OrderItemResource
    {
        return new OrderItemResource($orderitem);
    }

    /**
     *
     * @return OrderItemResourceCollection
     */
    public function index(): OrderItemResourceCollection
    {
        return new OrderItemResourceCollection(OrderItem::paginate());
    }

    /**
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * 見積もり一覧から案件を作成
     *
     * @param Request $request
     * @return void
     */
    public function storeOrderItemFromDocument(Request $request)
    {
        $this->orderItemRepository->storeOrderItemFromDocument($request->sub_total);
    }

    /**
     *
     * @param Request $request
     * @param OrderItem $orderitem
     * @return OrderItemResource
     */
    public function update(Request $request, OrderItem $orderitem): OrderItemResource
    {
        $orderitem->update($request->all());
        return new OrderItemResource($orderitem);
    }

    /**
     *
     * @param OrderItem $orderitem
     * @return void
     * @throws \Exception
     */
    public function destroy(OrderItem $orderitem)
    {
        $orderitem->delete();

        return response()->json();
    }

    /**
     *
     * @param integer $id
     * @return void
     */
    public function orderItemFileFindAll(int $id)
    {
        $fileById = OrderItem::get(['quotation', 'invoice'])->where('order_id', $id)->get();
        return $fileById;
    }
}
