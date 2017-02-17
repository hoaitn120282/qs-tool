<li class="{{ Request::is('quotations*') ? 'active' : '' }}">
    <a href="{!! route('quotations.index') !!}"><i class="fa fa-edit"></i><span>Quotations</span></a>
</li>

<li class="{{ Request::is('quotationFeatures*') ? 'active' : '' }}">
    <a href="{!! route('quotationFeatures.index') !!}"><i class="fa fa-edit"></i><span>QuotationFeatures</span></a>
</li>

