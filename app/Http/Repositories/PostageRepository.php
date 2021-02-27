<?php

namespace App\Http\Repositories;

use App\Http\Models\PostageList;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PostageRepository
{
    /** @var PostageList */
    protected $postagelist;

    public function __construct(PostageList $postagelist)
    {
        $this->postagelist = $postagelist;
    }

    /**
     * 全送料取得
     *
     * @return 
     */
    public function postagefindAll()
    {
        $postages = $this->postagelist->all();
        return $postages;
    }

    public function postageIndex(Request $request)
    {
        $query = PostageList::query();
        $search = $request->input('destination_place');

        if ($request->has('destination_place') && $search !== '') {
            $query->where('destination_place', 'like', '%' . $search . '%')->get();
        }

        $data = $query->orderBy('id', 'desc')
            ->paginate();
        return $data;
 
    }

    /**
     * 送料追加
     *
     * @return 
     */
    public function add_postage(array $edititem)
    {
        $this->postagelist->insert([
            [
                "sender_place" => $edititem["sender_place"],
                "destination_place" => $edititem["destination_place"],
                "postage_price" => $edititem["postage_price"],
                // "tax" => $edititem["tax"],
                "tax" => 0.1,
                "size" => $edititem["size"],
                "unit" => "個",
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ]
        ]);
    }

    /**
     * 削除
     *
     * @return 
     */
    public function delete(string $id)
    {
        $this->postagelist->where("id", $id)->delete();
    }
}
