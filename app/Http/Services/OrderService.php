<?php

namespace App\Http\Services;

use App\Http\Repositories\AttachmentRepository;
use App\Http\Repositories\MaintenanceRepository;
use App\Http\Repositories\OrderItemRepository;
use App\Http\Repositories\OrderRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderService
{
    /**
     * @var OrderRepository
     */
    private $orderRepository;
    /**
     * @var OrderItemRepository
     */
    private $orderItemRepository;
    /**
     * @var AttachmentRepository
     */
    private $attachmentRepository;
    /**
     * @var MaintenanceRepository
     */
    private $maintenanceRepository;

    /**
     * OrderService constructor.
     * @param OrderRepository $orderRepository
     * @param OrderItemRepository $orderItemRepository
     * @param AttachmentRepository $attachmentRepository
     * @param MaintenanceRepository $maintenanceRepository
     */
    public function __construct(OrderRepository $orderRepository, OrderItemRepository $orderItemRepository, AttachmentRepository $attachmentRepository, MaintenanceRepository $maintenanceRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->orderItemRepository = $orderItemRepository;
        $this->attachmentRepository = $attachmentRepository;
        $this->maintenanceRepository = $maintenanceRepository;
    }

    /**
     * 一覧API
     * 検索、フィルター、スイッチに対応
     * @param array $data
     */
    public function findByData(array $data)
    {
        return $this->orderRepository->index($data);
    }

    /**
     * @param Request $request
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            //案件を見積もりのデータから作成
            $this->orderRepository->storeFromDocument($request);

            //見積もり部を見積もりのデータから作成
            $this->orderItemRepository->storeOrderItemFromDocument($request);

            //添付ファイルを見積もりから作成
            $this->attachmentRepository->storeFromDocument();

            //メンテナンスを受注時に作成
            $this->maintenanceRepository->storeMaintenanceFromDocument($request);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack($th);
        }
    }

    /**
     * @param array $order
     */
    public function create(array $order)
    {
        try {
            DB::beginTransaction();

            //案件作成
            $this->orderRepository->store($order);
            //見積もり部作成
            if (isset($order['sub_total'])) {
                $this->orderItemRepository->store($order);
            }
            //添付ファイル作成
            if (isset($order["file_path"])) {
                $this->attachmentRepository->store($order);
            }

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack($th);
        }
    }

    /**
     * @param array $order
     * @param string $orderId
     */
    public function update(array $order, string $orderId)
    {
        try {
            DB::beginTransaction();

            //案件を編集
            $this->orderRepository->update($order, $orderId);
            //見積もり部を編集
            $this->orderItemRepository->update($order, $orderId);
            //その他添付ファイル
            if (isset($order["file_path"])) {
                $this->attachmentRepository->update($order, $orderId);
            }

            DB::commit();
        } catch (\Throwable $th) {

            DB::rollBack($th);
        }
    }
}
