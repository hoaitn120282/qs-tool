<?php

use Faker\Factory as Faker;
use App\Models\Quotation;
use App\Repositories\QuotationRepository;

trait MakeQuotationTrait
{
    /**
     * Create fake instance of Quotation and save it in database
     *
     * @param array $quotationFields
     * @return Quotation
     */
    public function makeQuotation($quotationFields = [])
    {
        /** @var QuotationRepository $quotationRepo */
        $quotationRepo = App::make(QuotationRepository::class);
        $theme = $this->fakeQuotationData($quotationFields);
        return $quotationRepo->create($theme);
    }

    /**
     * Get fake instance of Quotation
     *
     * @param array $quotationFields
     * @return Quotation
     */
    public function fakeQuotation($quotationFields = [])
    {
        return new Quotation($this->fakeQuotationData($quotationFields));
    }

    /**
     * Get fake data of Quotation
     *
     * @param array $postFields
     * @return array
     */
    public function fakeQuotationData($quotationFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word,
            'descriptions' => $fake->text,
            'type' => $fake->word,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s'),
            'deleted_at' => $fake->date('Y-m-d H:i:s')
        ], $quotationFields);
    }
}
