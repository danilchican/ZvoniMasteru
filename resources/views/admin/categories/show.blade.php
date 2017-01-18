<div class="category">
    @if($count = $category->getDescendantCount() > 0)
        <i class="fa fa-plus left-ico spoiler" data-spoiler-link="{{ $category->id }}" aria-hidden="true"></i>
    @endif
    <b>{{ $category->name }}</b>
    <div class="pull-right" style="margin-top: -2px;">
        <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-default btn-xs">
            <i class="fa fa-pencil" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Edit"></i>
        </a>
        {!! Form::open(['route' => ['admin.categories.destroy', $category->id], 'method' => 'delete', null, 'style' => 'display: inline;']) !!}
        <button type="submit" class="btn btn-danger btn-xs">
            <i class="fa fa-times" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Delete"></i>
        </button>
        {!! Form::close() !!}
    </div>
</div>
@if($count > 0)
    <div class="spoiler-content" data-spoiler-link="{{ $category->id }}">
        @foreach ($category->children as $child)
            @include('admin.categories.show', ['category' => $child, 'dep' => $dep.'-'])
        @endforeach
    </div>
@endif