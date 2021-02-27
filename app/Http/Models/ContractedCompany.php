<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class ContractedCompany extends Model
{
   protected $fillable = [
     'name',
     'person_in_change',
     'honorific_title',
     'tel',
     'site_name',
     'site_representative',
     'site_representative_phone',
     'mail',
     'address'
   ];
}
