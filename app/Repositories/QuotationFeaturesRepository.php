<?php

namespace App\Repositories;

use App\Models\QuotationFeatures;
use InfyOm\Generator\Common\BaseRepository;

class QuotationFeaturesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'quotation_id',
        'features_name',
        'descriptions',
        'order_id',
        'estimation_time',
        'text_note'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return QuotationFeatures::class;
    }
}
