<?php

namespace App\Http\Repositories;

use App\Http\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    /** @var User */
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * 全ユーザー取得
     *
     * @return \Illuminate\Database\Eloquent\Collection|User[]
     */
    public function findAll()
    {
        $users = $this->user->all();
        return $users;
    }

    /**
     * ユーザー作成
     *
     * @param array $data
     * @return User
     */
    public function store(array $data)
    {
        if($this->user->where("id", $data["id"])->exists())
        {
            $this->user->where("id", $data["id"])->update([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password'])
            ]);
        }
        else{
            $user = new User($data);
            // logger($user);
            $user->password = Hash::make($data['password']);
            $user->company_id = 1;
            $user->save();
            return $user;
        }
    }

    /**
     * 削除
     *
     * @return 
     */
    public function delete(string $id)
    {
        $this->user->where("id", $id)->delete();
    }

    /**
     * 絞り込み
     *
     * @return 
     */
    public function show(string $id)
    {
        $user = $this->user->where("id", $id)->get();
        return $user;
    }
}
