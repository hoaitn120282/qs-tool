<table class="table table-responsive" id="quotations-table">
    <thead>
        <th>Name</th>
        <th>Descriptions</th>
        <th>Type</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($quotations as $quotation)
        <tr>
            <td>{!! $quotation->name !!}</td>
            <td>{!! $quotation->descriptions !!}</td>
            <td>{!! $quotation->type !!}</td>
            <td>
                {!! Form::open(['route' => ['quotations.destroy', $quotation->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('quotations.show', [$quotation->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('quotations.edit', [$quotation->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>