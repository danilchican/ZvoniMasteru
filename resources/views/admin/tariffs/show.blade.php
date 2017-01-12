<tr>
    <td>{{ $tariff->id }}.</td>
    <td><a href="{{ route('admin.tariffs.edit', $tariff->id) }}" data-toggle="tooltip" data-original-title="View Tariff">{{ $tariff->title }}</a></td>
    <td>TOP {{ $tariff->top }}</td>
    <td>{{ $tariff->created_at->format('d.m.Y H:i') }}</td>
    <td>
        @if($tariff->published)
            <span class="label label-success">Published</span>
        @else
            <span class="label label-danger">Not published</span>
        @endif
    </td>
    <td>
        <div class="btn-group">
            <a href="{{ route('admin.tariffs.edit', $tariff->id) }}">
                <button type="button" class="btn btn-info btn-xs">Edit</button>
            </a>
            {!! Form::open(['route' => ['admin.tariffs.destroy', $tariff->id], 'method' => 'delete', null, 'style' => 'display: inline;']) !!}
            <button type="submit" class="btn btn-danger btn-xs">Delete</button>
            {!! Form::close() !!}
        </div>
    </td>
</tr>