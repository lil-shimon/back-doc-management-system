<?php

namespace App\Http\Repositories;

use App\Attachment;
use App\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AttachmentRepository
{
    protected $attachment;
    private $order;

    /**
     *
     * @param Attachment $attachment
     * @param Order $order
     */
    public function __construct(Attachment $attachment, Order $order)
    {
        $this->attachment = $attachment;
        $this->order = $order;
    }

    /**
     * その他ファイル情報を案件番号で取得
     *
     * @param integer $orderId
     * @return void
     */
    public function findAttachmentByOrderId(int $orderId)
    {
        return $this->attachment->where('order_id', $orderId)->first();
    }

    /**
     * @param array $order_info
     * @return Attachment
     */
    public function store(array $order_info)
    {
        try {
            DB::beginTransaction();

            $id = $this->order->max('id');
            $attachment = new Attachment;
            if (!preg_match('/null/', $order_info["file_path"])) {
                Storage::putFileAs('/public', $order_info["file_path"], '添付ファイル1_' . $id);
            }
            if (!preg_match('/null/', $order_info["file_path_two"])) {
                Storage::putFileAs('/public', $order_info["file_path_two"], '添付ファイル2_' . $id);
            }
            if (!preg_match('/null/', $order_info["file_path_three"])) {
                Storage::putFileAs('/public', $order_info["file_path_three"], '添付ファイル3_' . $id);
            }
            $attachment->fill(array_merge($order_info, ["order_id" => $id]))->save();

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack($th);
        }
    }

    /**
     * @param array $orderItem
     * @param string $orderId
     */
    public function update(array $orderItem, string $orderId)
    {
        try {
            DB::beginTransaction();

            $order_item = $this->attachment->where('order_id', $orderId)->first();
            $id = $this->order->max('id');
            if (!preg_match('/null/', $orderItem["file_path"])) {
                Storage::putFileAs('/public', $orderItem["file_path"], '添付ファイル1_' . $id);
            }
            if (!preg_match('/null/', $orderItem["file_path_two"])) {
                Storage::putFileAs('/public', $orderItem["file_path_two"], '添付ファイル2_' . $id);
            }
            if (!preg_match('/null/', $orderItem["file_path_three"])) {
                Storage::putFileAs('/public', $orderItem["file_path_three"], '添付ファイル3_' . $id);
            }
            $order_item->fill($orderItem)->save();

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack($th);
        }
    }

    /**
     *
     */
    public function storeFromDocument()
    {
        $id = $this->order->max("id");
        $this->attachment->insert([
            [
                'order_id' => $id
            ]
        ]);

    }
}
