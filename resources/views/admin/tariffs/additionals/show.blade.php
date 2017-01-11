<tr>
    <td>{{ $service->id }}.</td>
    <td>{{ $service->title }}</td>
    <td>
        <div class="btn-group">
            <a href="">
                <button type="button" class="btn btn-info btn-xs">Edit</button>
            </a>
            {!! Form::open(['route' => 'admin.tariffs.additional.destroy', 'method' => 'post', null, 'style' => 'display: inline;']) !!}
            <input type="hidden" name="service_id" value="{{ $service->id }}">
            <button type="submit" class="btn btn-danger btn-xs">Delete</button>
            {!! Form::close() !!}
        </div>
    </td>
</tr>