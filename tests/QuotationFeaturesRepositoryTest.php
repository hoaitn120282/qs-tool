<?php

use App\Models\QuotationFeatures;
use App\Repositories\QuotationFeaturesRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class QuotationFeaturesRepositoryTest extends TestCase
{
    use MakeQuotationFeaturesTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var QuotationFeaturesRepository
     */
    protected $quotationFeaturesRepo;

    public function setUp()
    {
        parent::setUp();
        $this->quotationFeaturesRepo = App::make(QuotationFeaturesRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateQuotationFeatures()
    {
        $quotationFeatures = $this->fakeQuotationFeaturesData();
        $createdQuotationFeatures = $this->quotationFeaturesRepo->create($quotationFeatures);
        $createdQuotationFeatures = $createdQuotationFeatures->toArray();
        $this->assertArrayHasKey('id', $createdQuotationFeatures);
        $this->assertNotNull($createdQuotationFeatures['id'], 'Created QuotationFeatures must have id specified');
        $this->assertNotNull(QuotationFeatures::find($createdQuotationFeatures['id']), 'QuotationFeatures with given id must be in DB');
        $this->assertModelData($quotationFeatures, $createdQuotationFeatures);
    }

    /**
     * @test read
     */
    public function testReadQuotationFeatures()
    {
        $quotationFeatures = $this->makeQuotationFeatures();
        $dbQuotationFeatures = $this->quotationFeaturesRepo->find($quotationFeatures->id);
        $dbQuotationFeatures = $dbQuotationFeatures->toArray();
        $this->assertModelData($quotationFeatures->toArray(), $dbQuotationFeatures);
    }

    /**
     * @test update
     */
    public function testUpdateQuotationFeatures()
    {
        $quotationFeatures = $this->makeQuotationFeatures();
        $fakeQuotationFeatures = $this->fakeQuotationFeaturesData();
        $updatedQuotationFeatures = $this->quotationFeaturesRepo->update($fakeQuotationFeatures, $quotationFeatures->id);
        $this->assertModelData($fakeQuotationFeatures, $updatedQuotationFeatures->toArray());
        $dbQuotationFeatures = $this->quotationFeaturesRepo->find($quotationFeatures->id);
        $this->assertModelData($fakeQuotationFeatures, $dbQuotationFeatures->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteQuotationFeatures()
    {
        $quotationFeatures = $this->makeQuotationFeatures();
        $resp = $this->quotationFeaturesRepo->delete($quotationFeatures->id);
        $this->assertTrue($resp);
        $this->assertNull(QuotationFeatures::find($quotationFeatures->id), 'QuotationFeatures should not exist in DB');
    }
}
