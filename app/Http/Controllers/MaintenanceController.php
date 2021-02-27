<?php

namespace App\Http\Controllers;

use App\Http\Repositories\MaintenanceRepository;
use Illuminate\Http\Request;

class MaintenanceController extends Controller
{
    /**
     * @var MaintenanceRepository
     */
    private $maintenanceRepository;

    /**
     * MaintenanceController constructor.
     * @param MaintenanceRepository $maintenanceRepository
     */
    public function __construct(MaintenanceRepository $maintenanceRepository)
    {
        $this->maintenanceRepository = $maintenanceRepository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        return $this->maintenanceRepository->index($request);
    }

    /**
     *今月のデータを取得
     */
    public function getThisMonth()
    {
        return $this->maintenanceRepository->getThisMonth();
    }

    /**
     * @return mixed
     */
    public function getLastMonth()
    {
        return $this->maintenanceRepository->getLastMonth();
    }

    /**
     * @return mixed
     */
    public function getTwoMonthAgo()
    {
        return $this->maintenanceRepository->getTwoMonthAgo();
    }

    /**
     * @param Request $request
     */
    public function store(Request $request)
    {
        return $this->maintenanceRepository->store($request->toArray());
    }

    /**
     * @param Request $request
     * @param $maintenanceId
     */
    public function update(Request $request, $maintenanceId)
    {
        return $this->maintenanceRepository->update($request->toArray(), $maintenanceId);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function destroy(int $id)
    {
        return $this->maintenanceRepository->delete($id);
    }
}
