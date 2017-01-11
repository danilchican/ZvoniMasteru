<tr>
    <td>{{ $company->id }}.</td>
    <td><a href="/adminpanel/companies/view/{{ $company->id }}" data-toggle="tooltip" data-original-title="View Company">{!! empty($company->name) ? 'No name' : $company->name !!}</a></td>
    <td>{{ LocalizedCarbon::instance($company->user->created_at)->diffForHumans() }}</td> <!-- Registration date -->
    <td>
        @if($company->status == 'approved')
            <span class="label label-success">Approved</span>
        @else
            <span class="label label-danger">Delivered</span>
        @endif
    </td> <!-- Published status -->
    <td style="text-overflow: ellipsis;">
        {!! empty($company->description) ? 'Company has no description yet...' : $company->description !!}
    </td> <!-- Description -->
    <td>
        <div class="btn-group">
            <a href="{{ route('admin.companies.edit', ['id' => $company->id]) }}"><button type="button" class="btn btn-info btn-xs">Edit</button></a>
            {!! Form::open(['route' => ['admin.companies.destroy', $company->id], 'method' => 'delete', null, 'style' => 'display: inline;']) !!}
            <button type="submit" class="btn btn-danger btn-xs">Delete</button>
            {!! Form::close() !!}
        </div>
    </td>
</tr>