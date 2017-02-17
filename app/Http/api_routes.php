<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where all API routes are defined.
|
*/





Route::resource('quotations', 'QuotationAPIController');

Route::resource('quotation_features', 'QuotationFeaturesAPIController');