<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'start_date',
        'end_date',
        'expected_start_date',
        'expected_end_date',
        'invoice_note',
        'sale_note',
        'maintainance_note',
        'sim_number',
        'signnage_id',
        'condition_id',
        'user_id',
        'total_price',
        'company_name',
        'site_name',
        'additional_invoice_id',
        'phone_number',
        'site_representative',
        'site_representative_phone',
        'document_id',
        'site_mail',
        'site_address',
        'condition_name',
        'additional_invoice',
        'payment'
    ];

    /**
     * user
     *
     * @return belongsTo
     */
    public function users()
    {
        return $this->belongsTo('App\Http\Models\User', 'user_id', 'id')->withTrashed();
    }

    /**
     * condition
     *
     * @return belongsTo
     */
    public function conditions()
    {
        return $this->belongsTo('App\Condition', 'condition_id', 'id');
    }


    /**
     * additional_invoice
     *
     * @return belongsTo
     */
    public function additionalInvoices()
    {
        return $this->belongsTo('App\AdditionalInvoice', 'additional_invoice_id', 'id');
    }
}
