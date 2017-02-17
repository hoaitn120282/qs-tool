<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class QuotationApiTest extends TestCase
{
    use MakeQuotationTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateQuotation()
    {
        $quotation = $this->fakeQuotationData();
        $this->json('POST', '/api/v1/quotations', $quotation);

        $this->assertApiResponse($quotation);
    }

    /**
     * @test
     */
    public function testReadQuotation()
    {
        $quotation = $this->makeQuotation();
        $this->json('GET', '/api/v1/quotations/'.$quotation->id);

        $this->assertApiResponse($quotation->toArray());
    }

    /**
     * @test
     */
    public function testUpdateQuotation()
    {
        $quotation = $this->makeQuotation();
        $editedQuotation = $this->fakeQuotationData();

        $this->json('PUT', '/api/v1/quotations/'.$quotation->id, $editedQuotation);

        $this->assertApiResponse($editedQuotation);
    }

    /**
     * @test
     */
    public function testDeleteQuotation()
    {
        $quotation = $this->makeQuotation();
        $this->json('DELETE', '/api/v1/quotations/'.$quotation->iidd);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/quotations/'.$quotation->id);

        $this->assertResponseStatus(404);
    }
}
