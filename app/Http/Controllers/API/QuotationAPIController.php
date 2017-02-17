<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateQuotationAPIRequest;
use App\Http\Requests\API\UpdateQuotationAPIRequest;
use App\Models\Quotation;
use App\Repositories\QuotationRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class QuotationController
 * @package App\Http\Controllers\API
 */

class QuotationAPIController extends AppBaseController
{
    /** @var  QuotationRepository */
    private $quotationRepository;

    public function __construct(QuotationRepository $quotationRepo)
    {
        $this->quotationRepository = $quotationRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/quotations",
     *      summary="Get a listing of the Quotations.",
     *      tags={"Quotation"},
     *      description="Get all Quotations",
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
     *                  @SWG\Items(ref="#/definitions/Quotation")
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
        $this->quotationRepository->pushCriteria(new RequestCriteria($request));
        $this->quotationRepository->pushCriteria(new LimitOffsetCriteria($request));
        $quotations = $this->quotationRepository->all();

        return $this->sendResponse($quotations->toArray(), 'Quotations retrieved successfully');
    }

    /**
     * @param CreateQuotationAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/quotations",
     *      summary="Store a newly created Quotation in storage",
     *      tags={"Quotation"},
     *      description="Store Quotation",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Quotation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Quotation")
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
     *                  ref="#/definitions/Quotation"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateQuotationAPIRequest $request)
    {
        $input = $request->all();

        $quotations = $this->quotationRepository->create($input);

        return $this->sendResponse($quotations->toArray(), 'Quotation saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/quotations/{id}",
     *      summary="Display the specified Quotation",
     *      tags={"Quotation"},
     *      description="Get Quotation",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Quotation",
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
     *                  ref="#/definitions/Quotation"
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
        /** @var Quotation $quotation */
        $quotation = $this->quotationRepository->findWithoutFail($id);

        if (empty($quotation)) {
            return $this->sendError('Quotation not found');
        }

        return $this->sendResponse($quotation->toArray(), 'Quotation retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateQuotationAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/quotations/{id}",
     *      summary="Update the specified Quotation in storage",
     *      tags={"Quotation"},
     *      description="Update Quotation",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Quotation",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Quotation that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Quotation")
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
     *                  ref="#/definitions/Quotation"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateQuotationAPIRequest $request)
    {
        $input = $request->all();

        /** @var Quotation $quotation */
        $quotation = $this->quotationRepository->findWithoutFail($id);

        if (empty($quotation)) {
            return $this->sendError('Quotation not found');
        }

        $quotation = $this->quotationRepository->update($input, $id);

        return $this->sendResponse($quotation->toArray(), 'Quotation updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/quotations/{id}",
     *      summary="Remove the specified Quotation from storage",
     *      tags={"Quotation"},
     *      description="Delete Quotation",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Quotation",
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
        /** @var Quotation $quotation */
        $quotation = $this->quotationRepository->findWithoutFail($id);

        if (empty($quotation)) {
            return $this->sendError('Quotation not found');
        }

        $quotation->delete();

        return $this->sendResponse($id, 'Quotation deleted successfully');
    }
}
