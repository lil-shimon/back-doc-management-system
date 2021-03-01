<?php

namespace App\Http\Repositories;

use App\Order;
use App\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class OrderItemRepository
{
    /** @var OrderItem */
    protected $order_item;

    /**
     * @var Order
     */
    protected $order;

    /**
     *
     * @param OrderItem $order_item
     * @param Order $order
     */
    public function __construct(OrderItem $order_item, Order $order)
    {
        $this->order_item = $order_item;
        $this->order = $order;
    }

    /**
     *見積部のデータを案件番号で取得
     *
     * @param integer $orderId
     * @return void
     */
    public function findOrderItemByOrderId(int $orderId)
    {
        return $this->order_item->where('order_id', $orderId)->get();
    }

    /**
     * 見積もり一覧から案件を作成
     *
     * @param Request $request
     * @return void
     */
    public function storeOrderItemFromDocument(Request $request)
    {
        $id = $this->order->max("id");
        $sub_total = $request->input('sub_total');
        $this->order_item->insert([
            [
                'sub_total' => $sub_total,
                'order_id' => $id
            ]
        ]);
    }

    /**
     * @param array $order_info
     */
    public function store(array $order_info)
    {
        $order_item = new OrderItem;
        $id = $this->order->max('id');
        if (!preg_match('/null/', $order_info["quotation"])) {
            Storage::putFileAs('/public', $order_info["quotation"], '見積書' . $id);
        }
        if (!preg_match('/null/', $order_info["invoice"])) {
            Storage::putFileAs('/public', $order_info["invoice"], '注文書' . $id);
        }
        $order_item->fill(array_merge($order_info, ["order_id" => $id]))->save();
    }

    /**
     * @param array $orderItem
     * @param string $orderId
     */
    public function update(array $orderItem, string $orderId)
    {
        try {
            DB::beginTransaction();

            $order_item = $this->order_item->where('order_id', $orderId)->first();

            //見積書がセットされていたら実行
            if (isset($orderItem['quotation'])) {
                if (!preg_match('/null/', $orderItem["quotation"])) {
                    Storage::putFileAs('/public', $orderItem["quotation"], '見積書' . $orderId);
                }
            }

            //注文書がセットされていたら実行
            if (isset($orderItem['invoice'])) {
                if (!preg_match('/null/', $orderItem["invoice"])) {
                    Storage::putFileAs('/public', $orderItem["invoice"], '注文書' . $orderId);
                }
            }

            // 見積もり部がなければ作成
            if (!$order_item) {
                $order_item = new OrderItem;
                if (isset($orderItem['quotation'])) {

                    if (!preg_match('/null/', $orderItem["quotation"])) {
                        Storage::putFileAs('/public', $orderItem["quotation"], '見積書' . $orderId);
                    }
                }

                if (isset($orderItem['invoice'])) {
                    if (!preg_match('/null/', $orderItem["invoice"])) {
                        Storage::putFileAs('/public', $orderItem["invoice"], '注文書' . $orderId);
                    }
                }

                $order_item->fill(array_merge($orderItem, ["order_id" => $orderId]))->save();
            }

            $order_item->fill($orderItem)->save();

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack($th);
        }
    }
}
