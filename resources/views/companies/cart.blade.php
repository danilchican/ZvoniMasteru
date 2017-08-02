@extends('layouts.app')

@section('head')
    <title>ZvoniMasteru.by - {{ $company->getName() }}</title>
@endsection

@section('content')
    <div class="container">
        <div id="company-cart" class="col-md-12">
            <!-- Main company info -->
            <div class="row main-company-info">
                <div class="thumbnail">
                    <div class="caption">
                        <div class="row visible-xs">
                            <h4 class="company-box-title">{{ $company->getName() }}</h4>
                        </div>
                        <div class="col-xs-4 col-sm-3 col-md-3 company-leftbar">
                            <img class="featurette-image img-responsive company-logo" alt="220x220" width="220"
                                 src="/{{ $company->getLogo() }}">
                            <div class="company-rating">
                                <div class="rate-block">
                                    <div class="company-mark">
                                        5.00
                                    </div>
                                    <div class="reviews">
                                        <p><img src="/assets/images/company/rate.jpg" alt=""></p>
                                        <p>Отзывов {{ count($reviews) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-8 col-sm-9 col-md-9">
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="row hidden-xs">
                                        <h4 class="company-box-title">{{ $company->getName() }}</h4>
                                    </div>
                                    <div class="row hidden-xs">
                                        <p class="company-box-desc">{{ $company->getDescription() }}</p>
                                    </div>
                                    <div class="row technical-info">
                                        <div class="col-md-4 col-sm-4 experience">
                                            <p>Опыт работы более 3 лет</p>
                                        </div>
                                        <div class="col-md-4 col-sm-4 contract">
                                            <p>Работа по договору</p>
                                        </div>
                                        <div class="col-md-4 col-sm-4 unp-number">
                                            <p>УНП: {{ $company->getUNPNumber() }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Company description -->
            <div class="row visible-xs">
                <div class="thumbnail">
                    <div class="caption">
                        <p class="company-box-desc">{{ $company->getDescription() }}</p>
                    </div>
                </div>
            </div>
            <!-- Contacts -->
            <div class="row company-contacts">
                <div class="col-md-4 col-sm-4 col-xs-6 company-phones">
                    <div class="row">
                        <div class="thumbnail">
                            <h4 class="contacts-title">Телефоны</h4>
                            <div class="clear"></div>
                            @if(count($phones) > 0)
                                <ul>
                                    @foreach($phones as $phone)
                                        <li>{{ $phone->getNumber() }}</li>
                                    @endforeach
                                </ul>
                            @else
                                <p style="padding-top: 15px;">Телефонов компании нет</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-6 company-socials">
                    <div class="thumbnail">
                        <h4 class="contacts-title">Социальные сети</h4>
                        <div class="clear"></div>
                        <ul>
                            <li class="vkontakte"><a href="{{ $groups->getVkontakteURL() }}">Вконтакте</a></li>
                            <li class="facebook"><a href="{{ $groups->getFacebookURL() }}">Facebook</a></li>
                            <li class="odnoklassniki"><a href="{{ $groups->getOdnoklassnikiURL() }}">Одноклассники</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12 company-info">
                    <div class="row">
                        <div class="thumbnail">
                            <h4 class="contacts-title">Контакты</h4>
                            <div class="clear"></div>
                            <div class="contacts-content">
                                @if(!empty($website = $company->contacts->getWebsiteURL()))
                                    <p class="website"><a href="{{ $website }}">{{ $website }}</a></p>
                                @endif
                                <p class="email"><span>е-mail:</span> {{ $company->contacts->getCompanyEmail() }}</p>
                                <p class="address">{{ $company->contacts->getAddress() }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Services -->
            <div class="row company-services">
                <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
                    <div class="row">
                        <div class="thumbnail">
                            <h4 class="services-title">Услуги</h4>
                            <ul class="services-list">
                                <div>
                                    <li>Комплексный ремонт</li>
                                    <li>Отделка помещения</li>
                                    <li>Покраска стен</li>
                                </div>
                                <div>
                                    <li>Комплексный ремонт</li>
                                    <li>Отделка помещения</li>
                                    <li>Покраска стен</li>
                                </div>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Portfolio -->
            <div class="row company-portfolio">
                <div class="col-md-12">
                    <div class="row">
                        <div class="thumbnail">
                            <h4 class="portfolio-title">Примеры работ</h4>
                            <div class="clear"></div>
                            <div class="portfolio-content">
                                <ul>
                                    <li><img src="/assets/images/company/portfolio-example.jpg" alt=""></li>
                                    <li><img src="/assets/images/company/portfolio-example.jpg" alt=""></li>
                                    <li><img src="/assets/images/company/portfolio-example.jpg" alt=""></li>
                                    <li><img src="/assets/images/company/portfolio-example.jpg" alt=""></li>
                                    <li><img src="/assets/images/company/portfolio-example.jpg" alt=""></li>
                                </ul>
                            </div>
                            <div class="clear"></div>
                            <button class="more">Показать больше</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Reviews -->
            @include('companies.reviews.index')
        </div>

        <div class="col-md-12">
            <div class="row">

            </div>
        </div>
    </div>
@endsection