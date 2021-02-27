<?php

namespace App\Http\Repositories;

use App\Maintenance;
use App\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MaintenanceRepository
{
    /**
     * @var Maintenance
     */
    private $maintenance;
    /**
     * @var Order
     */
    private $order;

    /**
     * MaintenanceRepository constructor.
     * @param Maintenance $maintenance
     * @param Order $order
     */
    public function __construct(Maintenance $maintenance, Order $order)
    {
        $this->maintenance = $maintenance;
        $this->order = $order;
    }

    /**
     * @return mixed
     */
    public function index()
    {
        return $this->maintenance->orderBy('count', 'desc')->get();
    }

    /**
     * create order
     * @param array $maintenance_info
     */
    public function store(array $maintenance_info)
    {
        try {
            DB::beginTransaction();

            $this->maintenance->insert($maintenance_info);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack($th);
        }
    }

    /**
     * @param array $maintenance
     * @param int $maintenanceId
     */
    public function update(array $maintenance, int $maintenanceId)
    {
        try {
            DB::beginTransaction();

            $maintenance_info = $this->maintenance->find($maintenanceId);
            if (!$maintenance_info) {
                $this->maintenance->fill($maintenance)->save();
            } else {
                $count = $maintenance['count'] += 1;
                $maintenance_info->fill($maintenance, $count)->save();
            }

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack($th);
        }
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function delete(int $id)
    {
        return $this->maintenance->find($id)->delete();
    }

    /**
     * @param Request $request
     */
    public function storeMaintenanceFromDocument(Request $request)
    {
        $title = $request->input('title');
        $count = $request->input('count');
        $this->maintenance->insert([
            [
                'title' => $title,
                'count' => $count
            ]
        ]);
    }


    public function getThisMonth()
    {
        $dt_from = new Carbon();
        $dt_from->startOfMonth();

        $dt_to = new Carbon();
        $dt_to->endOfMonth();

        return Maintenance::whereBetween('date', [$dt_from, $dt_to])->get(['working_hours']);
    }

    public function getLastMonth()
    {
        $dt_last_from = new Carbon('first day of last month');
        $dt_last_to = new Carbon('last day of last month');
        return Maintenance::whereBetween('date', [$dt_last_from, $dt_last_to])->get(['working_hours']);
    }

    public function getTwoMonthAgo()
    {
        $dt_two_from = Carbon::parse(' - 2 month')->firstOfMonth();
        $dt_two_to = Carbon::parse(' - 2 month')->endOfMonth();
        return Maintenance::whereBetween('date', [$dt_two_from, $dt_two_to])->get(['working_hours']);
    }
}
