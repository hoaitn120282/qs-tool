<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class QuotationFeaturesApiTest extends TestCase
{
    use MakeQuotationFeaturesTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateQuotationFeatures()
    {
        $quotationFeatures = $this->fakeQuotationFeaturesData();
        $this->json('POST', '/api/v1/quotationFeatures', $quotationFeatures);

        $this->assertApiResponse($quotationFeatures);
    }

    /**
     * @test
     */
    public function testReadQuotationFeatures()
    {
        $quotationFeatures = $this->makeQuotationFeatures();
        $this->json('GET', '/api/v1/quotationFeatures/'.$quotationFeatures->id);

        $this->assertApiResponse($quotationFeatures->toArray());
    }

    /**
     * @test
     */
    public function testUpdateQuotationFeatures()
    {
        $quotationFeatures = $this->makeQuotationFeatures();
        $editedQuotationFeatures = $this->fakeQuotationFeaturesData();

        $this->json('PUT', '/api/v1/quotationFeatures/'.$quotationFeatures->id, $editedQuotationFeatures);

        $this->assertApiResponse($editedQuotationFeatures);
    }

    /**
     * @test
     */
    public function testDeleteQuotationFeatures()
    {
        $quotationFeatures = $this->makeQuotationFeatures();
        $this->json('DELETE', '/api/v1/quotationFeatures/'.$quotationFeatures->iidd);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/quotationFeatures/'.$quotationFeatures->id);

        $this->assertResponseStatus(404);
    }
}
