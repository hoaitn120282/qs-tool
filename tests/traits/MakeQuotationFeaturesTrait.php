<?php

use Faker\Factory as Faker;
use App\Models\QuotationFeatures;
use App\Repositories\QuotationFeaturesRepository;

trait MakeQuotationFeaturesTrait
{
    /**
     * Create fake instance of QuotationFeatures and save it in database
     *
     * @param array $quotationFeaturesFields
     * @return QuotationFeatures
     */
    public function makeQuotationFeatures($quotationFeaturesFields = [])
    {
        /** @var QuotationFeaturesRepository $quotationFeaturesRepo */
        $quotationFeaturesRepo = App::make(QuotationFeaturesRepository::class);
        $theme = $this->fakeQuotationFeaturesData($quotationFeaturesFields);
        return $quotationFeaturesRepo->create($theme);
    }

    /**
     * Get fake instance of QuotationFeatures
     *
     * @param array $quotationFeaturesFields
     * @return QuotationFeatures
     */
    public function fakeQuotationFeatures($quotationFeaturesFields = [])
    {
        return new QuotationFeatures($this->fakeQuotationFeaturesData($quotationFeaturesFields));
    }

    /**
     * Get fake data of QuotationFeatures
     *
     * @param array $postFields
     * @return array
     */
    public function fakeQuotationFeaturesData($quotationFeaturesFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'quotation_id' => $fake->word,
            'features_name' => $fake->word,
            'descriptions' => $fake->text,
            'order_id' => $fake->randomDigitNotNull,
            'estimation_time' => $fake->randomDigitNotNull,
            'text_note' => $fake->text,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s'),
            'deleted_at' => $fake->date('Y-m-d H:i:s')
        ], $quotationFeaturesFields);
    }
}
