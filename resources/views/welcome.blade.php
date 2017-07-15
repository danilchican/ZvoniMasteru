@extends('layouts.app')

@section('head')
    <title>{{ config('app.name') }}</title>
@endsection

@section('content')
<div class="container">
    <!-- Carousel -->
    <div id="main-carousel" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#main-carousel" data-slide-to="0" class="active"></li>
            <li data-target="#main-carousel" data-slide-to="1"></li>
            <li data-target="#main-carousel" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <div class="item active">
                <img src="/assets/images/slide1.jpg" alt="...">
                <div class="carousel-caption">
                    <h3>Title 1</h3>
                    <p>Description 1</p>
                </div>
            </div>
            <div class="item">
                <img src="/assets/images/slide1.jpg" alt="...">
                <div class="carousel-caption">
                    <h3>Title 2</h3>
                    <p>Description 2</p>
                </div>
            </div>
            <div class="item">
                <img src="/assets/images/slide1.jpg" alt="...">
                <div class="carousel-caption">
                    <h3>Title 3</h3>
                    <p>Description 3</p>
                </div>
            </div>
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#main-carousel" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
        </a>
        <a class="right carousel-control" href="#main-carousel" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
        </a>
    </div>

    <!-- Professional categories -->
    <div class="col-md-12" id="professional-categories">
        <div class="row">
            <h3 class="professional-categories-head">Категории специалистов</h3>
        </div>
        <div class="row">
            <div class="professional-categories-content">
                <div class="categories-content-row">
                    @foreach($categories as $category)
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 professional-category-item">
                            <a href="{{ route('category.show', ['category' => $category->getSlug()]) }}">
                                <img class="category-background" src="{{ $category->getThumbnailURL() }}" alt="{{ $category->name }}">
                                <div class="category-item-content">
                                    <div class="item-content-image">
                                        <img src="/assets/images/professionals/otdelka.png" alt="{{ $category->name }}">
                                    </div>
                                    <p>{{ $category->name }}</p>
                                </div>
                            </a>
                        </div><!-- /.col-lg-4 -->
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Search bar -->
<div id="search-bar" class="default-margin">
    <div class="container">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <form action="" method="GET">
                        <div class="input-group search-bar-group">
                            <input type="text" name="search" placeholder="Поиск...">
                            <span class="input-group-btn">
                      <button class="btn btn-default" type="submit">Search</button>
                    </span>
                        </div><!-- /input-group -->
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Categories with subcategories -->
<div class="container">
    <div class="col-md-12 default-margin" id="categories">
        <div class="row">
            <!-- Пофиксить иконки -->
            <ul class="category-item">
                <li>
              <span class="category-title">
                <img src="/assets/images/professionals/icons/otdelka.png" alt="Отделка">
                <a href="">Отделка</a>
              </span>
                    <ul class="subcategories">
                        <div>
                            <li><a href="">Пол</a></li>
                            <li><a href="">Потолок</a></li>
                            <li><a href="">Стены</a></li>
                            <li><a href="">Интерьера, экстерьера</a></li>
                            <li><a href="">Пол</a></li>
                            <li><a href="">Потолок</a></li>
                        </div>
                        <div>
                            <li><a href="">Ландшафтный дизайн</a></li>
                            <li><a href="">Плитка</a></li>
                            <li><a href="">Пол</a></li>
                            <li><a href="">Потолок</a></li>
                            <li><a href="">Стены</a></li>
                            <li><a href="">Плитка</a></li>
                        </div>
                    </ul>
                </li>
            </ul>
            <div class="clear"></div>
            <ul class="category-item">
                <li>
              <span class="category-title">
                <img src="/assets/images/professionals/icons/building.png" alt="Строительство">
                <a href="">Строительство</a>
              </span>
                    <ul class="subcategories">
                        <div>
                            <li><a href="">Стены</a></li>
                            <li><a href="">Плитка</a></li>
                            <li><a href="">Пол</a></li>
                            <li><a href="">Потолок</a></li>
                            <li><a href="">Стены</a></li>
                            <li><a href="">Плитка</a></li>
                        </div>
                        <div>
                            <li><a href="">Стены</a></li>
                            <li><a href="">Плитка</a></li>
                            <li><a href="">Пол</a></li>
                            <li><a href="">Потолок</a></li>
                            <li><a href="">Стены</a></li>
                            <li><a href="">Плитка</a></li>
                        </div>
                    </ul>
                </li>
            </ul>
            <div class="clear"></div>
            <ul class="category-item">
                <li>
              <span class="category-title">
                <img src="/assets/images/professionals/icons/vorota.png" alt="Ворота">
                <a href="">Ворота</a>
              </span>
                    <ul class="subcategories">
                        <div>
                            <li><a href="">Стены</a></li>
                            <li><a href="">Плитка</a></li>
                            <li><a href="">Пол</a></li>
                            <li><a href="">Потолок</a></li>
                            <li><a href="">Стены</a></li>
                            <li><a href="">Плитка</a></li>
                        </div>
                        <div>
                            <li><a href="">Стены</a></li>
                            <li><a href="">Плитка</a></li>
                            <li><a href="">Пол</a></li>
                            <li><a href="">Потолок</a></li>
                            <li><a href="">Стены</a></li>
                            <li><a href="">Плитка</a></li>
                        </div>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>

<!-- Info block -->
<div id="info-block" class="visible-md visible-lg">
    <div class="container">
        <div class="col-md-12">
            <div class="row">
                <h3 class="info-block-title">Текст для СЕО</h3>
                <p class="info-block-description">
                    Текст (от лат. textus — «ткань; сплетение, связь, сочетание») — зафиксированная на каком-либо материальном носителе человеческая мысль; в общем плане связная и полная последовательность символов.
                    Существуют две основные трактовки понятия «текст»: «имманентная» (расширенная, философски нагруженная) и «репрезентативная» (более частная). Имманентный подход подразумевает отношение к тексту как к автономной реальности, нацеленность на выявление его внутренней структуры. Репрезентативный — рассмотрение текста как особой формы представления знаний о внешней тексту действительности.
                    В лингвистике термин текст используется в широком значении, включая и образцы устной речи. Восприятие текста изучается в рамках лингвистики текста и психолингвистики. Так, например, И. Р. Гальперин определяет текст следующим образом: «это письменное сообщение, объективированное в виде письменного документа, состоящее из ряда высказываний, объединённых разными типами лексической, грамматической и логической связи, имеющее определённый моральный характер, прагматическую установку и соответственно литературно обработанное»[1].
                </p>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="/js/app.js"></script>
@endsection