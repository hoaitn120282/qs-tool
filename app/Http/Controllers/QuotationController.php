<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateQuotationRequest;
use App\Http\Requests\UpdateQuotationRequest;
use App\Repositories\QuotationRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class QuotationController extends AppBaseController
{
    /** @var  QuotationRepository */
    private $quotationRepository;

    public function __construct(QuotationRepository $quotationRepo)
    {
        $this->quotationRepository = $quotationRepo;
    }

    /**
     * Display a listing of the Quotation.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->quotationRepository->pushCriteria(new RequestCriteria($request));
        $quotations = $this->quotationRepository->all();

        return view('quotations.index')
            ->with('quotations', $quotations);
    }

    /**
     * Show the form for creating a new Quotation.
     *
     * @return Response
     */
    public function create()
    {
        return view('quotations.create');
    }

    /**
     * Store a newly created Quotation in storage.
     *
     * @param CreateQuotationRequest $request
     *
     * @return Response
     */
    public function store(CreateQuotationRequest $request)
    {
        $input = $request->all();

        $quotation = $this->quotationRepository->create($input);

        Flash::success('Quotation saved successfully.');

        return redirect(route('quotations.index'));
    }

    /**
     * Display the specified Quotation.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $quotation = $this->quotationRepository->findWithoutFail($id);

        if (empty($quotation)) {
            Flash::error('Quotation not found');

            return redirect(route('quotations.index'));
        }

        return view('quotations.show')->with('quotation', $quotation);
    }

    /**
     * Show the form for editing the specified Quotation.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $quotation = $this->quotationRepository->findWithoutFail($id);

        if (empty($quotation)) {
            Flash::error('Quotation not found');

            return redirect(route('quotations.index'));
        }

        return view('quotations.edit')->with('quotation', $quotation);
    }

    /**
     * Update the specified Quotation in storage.
     *
     * @param  int              $id
     * @param UpdateQuotationRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateQuotationRequest $request)
    {
        $quotation = $this->quotationRepository->findWithoutFail($id);

        if (empty($quotation)) {
            Flash::error('Quotation not found');

            return redirect(route('quotations.index'));
        }

        $quotation = $this->quotationRepository->update($request->all(), $id);

        Flash::success('Quotation updated successfully.');

        return redirect(route('quotations.index'));
    }

    /**
     * Remove the specified Quotation from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $quotation = $this->quotationRepository->findWithoutFail($id);

        if (empty($quotation)) {
            Flash::error('Quotation not found');

            return redirect(route('quotations.index'));
        }

        $this->quotationRepository->delete($id);

        Flash::success('Quotation deleted successfully.');

        return redirect(route('quotations.index'));
    }
}
