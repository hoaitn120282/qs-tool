<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="QuotationFeatures",
 *      required={""},
 *      @SWG\Property(
 *          property="features_name",
 *          description="features_name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="descriptions",
 *          description="descriptions",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="order_id",
 *          description="order_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="estimation_time",
 *          description="estimation_time",
 *          type="number",
 *          format="float"
 *      ),
 *      @SWG\Property(
 *          property="text_note",
 *          description="text_note",
 *          type="string"
 *      )
 * )
 */
class QuotationFeatures extends Model
{
    use SoftDeletes;

    public $table = 'quotation_features';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'quotation_id',
        'features_name',
        'descriptions',
        'order_id',
        'estimation_time',
        'text_note'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'features_name' => 'string',
        'descriptions' => 'string',
        'order_id' => 'integer',
        'estimation_time' => 'float',
        'text_note' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'features_name'=>'required',
        'descriptions'=>'required',
        'estimation_time'=>'required',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function qsQuotation()
    {
        return $this->belongsTo(\App\Models\QsQuotation::class);
    }
}
