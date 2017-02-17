<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateQuotationFeaturesRequest;
use App\Http\Requests\UpdateQuotationFeaturesRequest;
use App\Repositories\QuotationFeaturesRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class QuotationFeaturesController extends AppBaseController
{
    /** @var  QuotationFeaturesRepository */
    private $quotationFeaturesRepository;

    public function __construct(QuotationFeaturesRepository $quotationFeaturesRepo)
    {
        $this->quotationFeaturesRepository = $quotationFeaturesRepo;
    }

    /**
     * Display a listing of the QuotationFeatures.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->quotationFeaturesRepository->pushCriteria(new RequestCriteria($request));
        $quotationFeatures = $this->quotationFeaturesRepository->all();

        return view('quotation_features.index')
            ->with('quotationFeatures', $quotationFeatures);
    }

    /**
     * Show the form for creating a new QuotationFeatures.
     *
     * @return Response
     */
    public function create()
    {
        return view('quotation_features.create');
    }

    /**
     * Store a newly created QuotationFeatures in storage.
     *
     * @param CreateQuotationFeaturesRequest $request
     *
     * @return Response
     */
    public function store(CreateQuotationFeaturesRequest $request)
    {
        $input = $request->all();

        $quotationFeatures = $this->quotationFeaturesRepository->create($input);

        Flash::success('Quotation Features saved successfully.');

        return redirect(route('quotationFeatures.index'));
    }

    /**
     * Display the specified QuotationFeatures.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $quotationFeatures = $this->quotationFeaturesRepository->findWithoutFail($id);

        if (empty($quotationFeatures)) {
            Flash::error('Quotation Features not found');

            return redirect(route('quotationFeatures.index'));
        }

        return view('quotation_features.show')->with('quotationFeatures', $quotationFeatures);
    }

    /**
     * Show the form for editing the specified QuotationFeatures.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $quotationFeatures = $this->quotationFeaturesRepository->findWithoutFail($id);

        if (empty($quotationFeatures)) {
            Flash::error('Quotation Features not found');

            return redirect(route('quotationFeatures.index'));
        }

        return view('quotation_features.edit')->with('quotationFeatures', $quotationFeatures);
    }

    /**
     * Update the specified QuotationFeatures in storage.
     *
     * @param  int              $id
     * @param UpdateQuotationFeaturesRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateQuotationFeaturesRequest $request)
    {
        $quotationFeatures = $this->quotationFeaturesRepository->findWithoutFail($id);

        if (empty($quotationFeatures)) {
            Flash::error('Quotation Features not found');

            return redirect(route('quotationFeatures.index'));
        }

        $quotationFeatures = $this->quotationFeaturesRepository->update($request->all(), $id);

        Flash::success('Quotation Features updated successfully.');

        return redirect(route('quotationFeatures.index'));
    }

    /**
     * Remove the specified QuotationFeatures from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $quotationFeatures = $this->quotationFeaturesRepository->findWithoutFail($id);

        if (empty($quotationFeatures)) {
            Flash::error('Quotation Features not found');

            return redirect(route('quotationFeatures.index'));
        }

        $this->quotationFeaturesRepository->delete($id);

        Flash::success('Quotation Features deleted successfully.');

        return redirect(route('quotationFeatures.index'));
    }
}
