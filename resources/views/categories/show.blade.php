@extends('layouts.app')

@section('head')
    <title>ZvoniMasteru.by</title>
@endsection

@section('content')
    <div id="category-header" style="background: url(/assets/images/categories/otdelka-bg.jpg) center top no-repeat">
        <div class="container">
            <h1 class="category-header-title">{{ $currentCategory->getName() }}</h1>
            <ul class="category-header-steps">
                <li class="first">Найдите лучшего для Вас специалиста</li>
                <li class="second">Созвонитесь с ним</li>
                <li class="third">Договоритесь</li>
            </ul>
        </div>
    </div>


    <div class="container">
        <p class="category-description">
            В процессе создания уютного дома или обустройства квартиры неизменно приходится сталкиваться с ремонтом,
            особенно если этого касается строительства нового дома или капитального ремонта.<br/>
            Все виды отделочных работ. Большой выбор специалистов в этой области.
        </p>
        <div id="companies">
            <div class="companies-nav-mobile">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target=".sidebar-offcanvas">
                    <span class="sr-only">Toggle navigation</span>
                    <div class="icon-bar-block">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </div>
                    <div class="icon-bar-block-name">Показать категории</div>
                </button>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 collapse sidebar-offcanvas" id="sidebar"
                 role="navigation">
                @foreach ($categories as $category)
                    <a href="{{ route('category.show', ['category' => $category->getSlug()]) }}"
                       class="list-group-item">{{ $category->getName() }}</a>
                @endforeach
            </div>
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8" id="companies-content">
                @if(count($companies) > 0)
                    @foreach($companies as $company)
                        @include('categories.companies.show', ['company' => $company])
                    @endforeach
                @else
                    <h4>Компаний в данной категории еще нет.</h4>
                @endif
                <div class="clear"></div>
                <div class="col-md-12" id="companies-pagination">
                    {!! $companies->links('pagination.default') !!}
                </div>
            </div>
        </div>
    </div>
@endsection