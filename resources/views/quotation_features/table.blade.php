<table class="table table-responsive" id="quotationFeatures-table">
    <thead>
        <th>Quotation Id</th>
        <th>Features Name</th>
        <th>Descriptions</th>
        <th>Order Id</th>
        <th>Estimation Time</th>
        <th>Text Note</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($quotationFeatures as $quotationFeatures)
        <tr>
            <td>{!! $quotationFeatures->quotation_id !!}</td>
            <td>{!! $quotationFeatures->features_name !!}</td>
            <td>{!! $quotationFeatures->descriptions !!}</td>
            <td>{!! $quotationFeatures->order_id !!}</td>
            <td>{!! $quotationFeatures->estimation_time !!}</td>
            <td>{!! $quotationFeatures->text_note !!}</td>
            <td>
                {!! Form::open(['route' => ['quotationFeatures.destroy', $quotationFeatures->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('quotationFeatures.show', [$quotationFeatures->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('quotationFeatures.edit', [$quotationFeatures->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>