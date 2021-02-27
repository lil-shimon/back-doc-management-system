<?php

namespace App\Http\Repositories;

use App\Attachment;
use App\Condition;
use App\Http\Models\ContractedCompany;
use App\Http\Models\User;
use App\Order;
use App\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderRepository
{
    /** @var Order */
    protected $order;

    /** @var OrderItem */
    protected $order_item;

    /** @var ContractedCompany */
    protected $contractedcompany;

    /** @var Attachment */
    protected $attachment;

    /** @var User */
    protected $user;

    /** @var Condition */
    protected $condition;

    /**
     *
     * @param Order $order
     * @param OrderItem $order_item
     * @param ContractedCompany $contractedcompany
     * @param Attachment $attachment
     * @param User $user
     * @param Condition $condition
     */
    public function __construct(Order $order, OrderItem $order_item, ContractedCompany $contractedcompany, Attachment $attachment, User $user, Condition $condition)
    {
        $this->order = $order;
        $this->order_item = $order_item;
        $this->contractedcompany = $contractedcompany;
        $this->attachment = $attachment;
        $this->user = $user;
        $this->condition = $condition;
    }

    /**
     *
     * take data for order index page with users and conditions
     * @return void
     */
    public function orderfindAll()
    {
        $orders = $this->order->with('Conditions', 'AdditionalInvoices')->get();
        return $orders;
    }

    /**
     * 見積もりIDだけの配列を作成
     *
     * @return void
     */
    public function getDocumentIdArray()
    {
        $orders = Order::select(['document_id'])->get();
        return $orders;
    }

    /**
     *
     * @param integer $id
     * @return void
     */
    public function show(int $id)
    {
        $order = $this->order->with('Conditions', 'AdditionalInvoices', 'Users')->find($id);
        return $order;
    }

    /**
     *
     *  get order item by order id
     *
     * @param integer $id
     * @return void
     */
    public function getOrderItem(int $id)
    {
        $order_item = $this->order_item->where("order_id", $id)->get();
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
        $contractedcompany = $this->contractedcompany->where("order_id", $id)->get();
        return $contractedcompany;
    }

    /**
     * get attachment item by order id
     *
     * @param integer $id
     * @return void
     */
    public function getAttachment(int $id)
    {
        $attachment = $this->attachment->where("order_id", $id)->first();
        return $attachment;
    }

    /**
     * 一覧API
     *
     * @param array
     * @return void
     */
    public function index(array $data)
    {
        $query = $this->order->query();
        // 検索
        $this->searchCondition($query, $data);

        // 並び替え
        switch ($data['order_by'] ?? null) {
            case 'id_asc':
                $query
                    ->orderby('id', 'asc');
                break;
            case 'start_date_desc':
                $query->orderby('start_date', 'desc');
                break;
            case 'start_date_asc':
                $query->orderby('start_date', 'asc');
                break;
            case 'end_date_desc':
                $query->orderBy('end_date', 'desc');
                break;
            case 'end_date_asc':
                $query->orderBy('end_date', 'asc');
                break;
            case 'expected_start_date_desc':
                $query->orderBy('expected_start_date', 'desc');
                break;
            case 'expected_start_date_asc':
                $query->orderBy('expected_start_date', 'asc');
                break;
            case 'expected_end_date_desc':
                $query->orderBy('expected_end_date', 'desc');
                break;
            case 'expected_end_date_asc':
                $query->orderBy('expected_end_date', 'asc');
                break;
            case 'additional_invoice_desk':
                $query->orderBy('additional_invoice', 'desk');
                break;
            case 'additional_invoice_asc':
                $query->orderBy('additional_invoice', 'asc');
                break;
            case 'company_name_desk':
                $query->orderBy('company_name', 'desk');
                break;
            case 'company_name_asc':
                $query->orderBy('company_name', 'asc');
                break;
            case 'site_name_desk':
                $query->orderBy('site_name', 'desk');
                break;
            case 'site_name_asc':
                $query->orderBy('site_name', 'asc');
                break;
            default:
                $query->orderby('id', 'desc');
                break;
        }

        return $query->with('Conditions', 'AdditionalInvoices')
            //現況が終了になっているものを一覧から除く
            ->where('condition_name', '!=', '終了')
            ->orWhereNull('condition_name')
            ->paginate(20);
    }

    /**
     *
     * @param string $value
     * @return void
     */
    private function getSearchKeyWord(string $value)
    {
        // all blank replace to half
        $value = str_replace('　', '', $value);

        // remove whitespace
        $value = trim($value);

        // remove space
        $value = preg_replace('/\s+/', ' ', $value);
        return $value;
    }

    /**
     * searchCondition
     *
     * @param $query
     * @param array $data
     * @return void $keyword
     */
    private function searchCondition($query, array $data)
    {
        // initial value of keyword = ''
        $keyword = '';
        // when data has query, set the value into $keyword
        if (!empty($data['query'])) {
            $keyword = $this->getSearchKeyWord($data['query']);
        }
        //search keyword
        if (!empty($keyword)) {
            $query->where(function ($query) use ($keyword) {
                $columns = 'company_name, site_name, payment';
                if (empty($data['company_name'])) {
                    $query->orWhereRaw("match (${columns}) against (? IN BOOLEAN MODE)", $keyword);
                }
            });
        }
    }

    /**
     * @param array $order_info
     */
    public function store(array $order_info)
    {
        $order = new Order;
        $order->fill($order_info)->save();
    }

    /**
     * edit order
     *
     * @param array $order
     * @param string $orderId
     * @return void
     */
    public function update(array $order, string $orderId)
    {
        try {
            DB::beginTransaction();

            $order_info = $this->order->find($orderId);
            $order_info->fill($order)->save();

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack($th);
        }
    }

    /**
     * 見積もり一覧から案件を作成
     * @param Request $request
     * @return void
     */
    public function storeFromDocument(Request $request)
    {
        $order = Order::create($request->all());
        return $order;
    }

    // IDで案件を取得
    public function findById($orderId)
    {
        $order_info = $this->order->find($orderId);
        return $order_info;
    }

    /**
     *
     * @param integer $id
     * @return void
     */
    public function delete(int $id)
    {
        return $this->order->find($id)->delete();
    }
}
