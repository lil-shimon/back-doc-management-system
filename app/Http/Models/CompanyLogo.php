<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanyLogo extends Model
{
    use SoftDeletes;

    protected $table = 'companies_logoes';
}
