<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateQuotationFeaturesAPIRequest;
use App\Http\Requests\API\UpdateQuotationFeaturesAPIRequest;
use App\Models\QuotationFeatures;
use App\Repositories\QuotationFeaturesRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class QuotationFeaturesController
 * @package App\Http\Controllers\API
 */

class QuotationFeaturesAPIController extends AppBaseController
{
    /** @var  QuotationFeaturesRepository */
    private $quotationFeaturesRepository;

    public function __construct(QuotationFeaturesRepository $quotationFeaturesRepo)
    {
        $this->quotationFeaturesRepository = $quotationFeaturesRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/quotationFeatures",
     *      summary="Get a listing of the QuotationFeatures.",
     *      tags={"QuotationFeatures"},
     *      description="Get all QuotationFeatures",
     *      produces={"application/json"},
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/QuotationFeatures")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request)
    {
        $this->quotationFeaturesRepository->pushCriteria(new RequestCriteria($request));
        $this->quotationFeaturesRepository->pushCriteria(new LimitOffsetCriteria($request));
        $quotationFeatures = $this->quotationFeaturesRepository->all();

        return $this->sendResponse($quotationFeatures->toArray(), 'Quotation Features retrieved successfully');
    }

    /**
     * @param CreateQuotationFeaturesAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/quotationFeatures",
     *      summary="Store a newly created QuotationFeatures in storage",
     *      tags={"QuotationFeatures"},
     *      description="Store QuotationFeatures",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="QuotationFeatures that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/QuotationFeatures")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/QuotationFeatures"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateQuotationFeaturesAPIRequest $request)
    {
        $input = $request->all();

        $quotationFeatures = $this->quotationFeaturesRepository->create($input);

        return $this->sendResponse($quotationFeatures->toArray(), 'Quotation Features saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/quotationFeatures/{id}",
     *      summary="Display the specified QuotationFeatures",
     *      tags={"QuotationFeatures"},
     *      description="Get QuotationFeatures",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of QuotationFeatures",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/QuotationFeatures"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($id)
    {
        /** @var QuotationFeatures $quotationFeatures */
        $quotationFeatures = $this->quotationFeaturesRepository->findWithoutFail($id);

        if (empty($quotationFeatures)) {
            return $this->sendError('Quotation Features not found');
        }

        return $this->sendResponse($quotationFeatures->toArray(), 'Quotation Features retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateQuotationFeaturesAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/quotationFeatures/{id}",
     *      summary="Update the specified QuotationFeatures in storage",
     *      tags={"QuotationFeatures"},
     *      description="Update QuotationFeatures",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of QuotationFeatures",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="QuotationFeatures that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/QuotationFeatures")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/QuotationFeatures"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateQuotationFeaturesAPIRequest $request)
    {
        $input = $request->all();

        /** @var QuotationFeatures $quotationFeatures */
        $quotationFeatures = $this->quotationFeaturesRepository->findWithoutFail($id);

        if (empty($quotationFeatures)) {
            return $this->sendError('Quotation Features not found');
        }

        $quotationFeatures = $this->quotationFeaturesRepository->update($input, $id);

        return $this->sendResponse($quotationFeatures->toArray(), 'QuotationFeatures updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/quotationFeatures/{id}",
     *      summary="Remove the specified QuotationFeatures from storage",
     *      tags={"QuotationFeatures"},
     *      description="Delete QuotationFeatures",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of QuotationFeatures",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function destroy($id)
    {
        /** @var QuotationFeatures $quotationFeatures */
        $quotationFeatures = $this->quotationFeaturesRepository->findWithoutFail($id);

        if (empty($quotationFeatures)) {
            return $this->sendError('Quotation Features not found');
        }

        $quotationFeatures->delete();

        return $this->sendResponse($id, 'Quotation Features deleted successfully');
    }
}
