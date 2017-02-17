<?php

namespace App\Repositories;

use App\Models\Quotation;
use InfyOm\Generator\Common\BaseRepository;

class QuotationRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'descriptions',
        'type'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Quotation::class;
    }
}
