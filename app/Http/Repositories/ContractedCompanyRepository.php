<?php

namespace App\Http\Repositories;

use App\Http\Models\ContractedCompany;

class ContractedCompanyRepository
{
    /** @var ContractedCompany */
    protected $contractedcompany;

    /**
     *
     * @param ContractedCompany $contractedcompany
     */
    public function __construct(ContractedCompany $contractedcompany)
    {
        $this->contractedcompany = $contractedcompany;
    }

    /**
     *
     * @return void
     */
    public function findAll()
    {
        return $this->contractedcompany->all();
    }
}
