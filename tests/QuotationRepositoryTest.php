<?php

use App\Models\Quotation;
use App\Repositories\QuotationRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class QuotationRepositoryTest extends TestCase
{
    use MakeQuotationTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var QuotationRepository
     */
    protected $quotationRepo;

    public function setUp()
    {
        parent::setUp();
        $this->quotationRepo = App::make(QuotationRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateQuotation()
    {
        $quotation = $this->fakeQuotationData();
        $createdQuotation = $this->quotationRepo->create($quotation);
        $createdQuotation = $createdQuotation->toArray();
        $this->assertArrayHasKey('id', $createdQuotation);
        $this->assertNotNull($createdQuotation['id'], 'Created Quotation must have id specified');
        $this->assertNotNull(Quotation::find($createdQuotation['id']), 'Quotation with given id must be in DB');
        $this->assertModelData($quotation, $createdQuotation);
    }

    /**
     * @test read
     */
    public function testReadQuotation()
    {
        $quotation = $this->makeQuotation();
        $dbQuotation = $this->quotationRepo->find($quotation->id);
        $dbQuotation = $dbQuotation->toArray();
        $this->assertModelData($quotation->toArray(), $dbQuotation);
    }

    /**
     * @test update
     */
    public function testUpdateQuotation()
    {
        $quotation = $this->makeQuotation();
        $fakeQuotation = $this->fakeQuotationData();
        $updatedQuotation = $this->quotationRepo->update($fakeQuotation, $quotation->id);
        $this->assertModelData($fakeQuotation, $updatedQuotation->toArray());
        $dbQuotation = $this->quotationRepo->find($quotation->id);
        $this->assertModelData($fakeQuotation, $dbQuotation->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteQuotation()
    {
        $quotation = $this->makeQuotation();
        $resp = $this->quotationRepo->delete($quotation->id);
        $this->assertTrue($resp);
        $this->assertNull(Quotation::find($quotation->id), 'Quotation should not exist in DB');
    }
}
