@extends('layouts.app')

@section('head')
    <title>ZvoniMasteru.by</title>
@endsection

@section('styles')
    <style>
        .thumbnail .caption {
            overflow: hidden;
        }
    </style>
@endsection

@section('content')
    <div class="container companies">
        <div class="row">
            <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
                @foreach ($categories as $category)
                    <div class="list-group" style="margin-bottom: 0;">
                        <a href="{{ route('category.show', ['category' => $category->getSlug()]) }}" class="list-group-item">{{ $category->getName() }}</a>
                    </div>
                @endforeach
            </div>
            @if(count($companies) > 0)
            <div class="col-sm-9">
                <div class="row">
                    @foreach($companies as $company)
                        @include('categories.companies.show', ['company' => $company])
                    @endforeach
                </div><!-- /.row -->

                <div class="row">
                    <div class="col-sm-6">
                        {!! $companies->links() !!}
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div>
            @else
                <div class="col-md-12">
                    <h4>Компаний в данной категории еще нет.</h4>
                </div>
            @endif
        </div>
    </div><!-- /.container -->
@endsection