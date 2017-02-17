<!-- Quotation Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('quotation_id', 'Quotation Id:') !!}
    {!! Form::number('quotation_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Features Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('features_name', 'Features Name:') !!}
    {!! Form::text('features_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Descriptions Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('descriptions', 'Descriptions:') !!}
    {!! Form::textarea('descriptions', null, ['class' => 'form-control']) !!}
</div>

<!-- Order Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('order_id', 'Order Id:') !!}
    {!! Form::number('order_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Estimation Time Field -->
<div class="form-group col-sm-6">
    {!! Form::label('estimation_time', 'Estimation Time:') !!}
    {!! Form::number('estimation_time', null, ['class' => 'form-control']) !!}
</div>

<!-- Text Note Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('text_note', 'Text Note:') !!}
    {!! Form::textarea('text_note', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('quotationFeatures.index') !!}" class="btn btn-default">Cancel</a>
</div>
