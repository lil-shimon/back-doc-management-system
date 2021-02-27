<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Document extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];


    // リレーションも定義してください
    // https://readouble.com/laravel/7.x/ja/eloquent-relationships.html

    public function purchasedProducts()
    {
        return $this->hasMany('App\Http\Models\PurchasedProduct');
    }

    public function users()
    {
        return $this->belongsTo('App\Http\Models\User', 'user_id', 'id')->withTrashed();
    }

    use SoftDeletes;

    const STATUS = [
        0 => ['label' => "未"],
        1 => ['label' => "済"]
    ];

    const SELLPART = [
        1 => ['label' => "S"],
        2 => ['label' => "R"]
    ];

    const SEEPART = [
        1 => ['label' => "F"],
        2 => ['label' => "A"],
        3 => ['label' => "K"],
        4 => ['label' => "J"],
        5 => ['label' => "C"]
    ];

    const CUSTOMERPART = [
        1 => ['label' => "G"],
        2 => ['label' => "A"],
        3 => ['label' => "R"]
    ];

    const DOCTYPE = [
        1 => ['label' => "見積書"],
        2 => ['label' => "納品書"],
        3 => ['label' => "請求書"],
        4 => ['label' => "領収書"],
    ];

    protected $appends = ['status_label', 'sell_part_label', 'see_part_label', 'customer_part_label', 'document_type_label'];

    public function getStatusLabelAttribute()
    {
        $status = $this->attributes["status"];
        return self::STATUS[$status]['label'];
    }

    public function getSellPartLabelAttribute()
    {
        $sell_part = $this->attributes["sell_part_id"];
        return self::SELLPART[$sell_part]['label'];
    }

    public function getSeePartLabelAttribute()
    {
        $see_part = $this->attributes["see_part_id"];
        return self::SEEPART[$see_part]['label'];
    }

    public function getCustomerPartLabelAttribute()
    {
        $customer_part = $this->attributes["customer_part_id"];
        return self::CUSTOMERPART[$customer_part]['label'];
    }

    public function getDocumentTypeLabelAttribute()
    {
        $document_type = $this->attributes["document_type_id"];
        return self::DOCTYPE[$document_type]['label'];
    }
}
