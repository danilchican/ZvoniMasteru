<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 company-box">
    <div class="row">
        <div class="thumbnail">
            <div class="caption">
                <div class="col-xs-3 col-sm-3 col-md-4">
                    <div class="row">
                        <img class="featurette-image img-responsive company-logo" alt="220x220" width="220"
                             src="{{ $company->getLogo() }}">
                    </div>
                </div>
                <div class="col-xs-9 col-sm-9 col-md-8">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="row">
                                <h4 class="company-box-title"><a href="{{ route('company.cart', $company->getSlug()) }}"
                                                                 target="_blank">{{ $company->getName() }}</a></h4>
                            </div>
                            <div class="row">
                                <p class="company-box-short-desc">{{ $company->getDescription() }}</p>
                            </div>
                            <div class="row">
                                <div class="company-box-info">
                                    <div class="col-md-4 col-sm-4 site-unp-box">
                                        @if(!empty($website = $company->contacts->getWebsiteURL()))
                                            <p class="company-box-website">
                                                <a href="{{ $website }}">{{ $website }}</a>
                                            </p>
                                        @endif
                                        <p class="company-box-unp">УНП: {{ $company->getUNPNumber() }}</p>
                                    </div>
                                    <div class="col-md-4 col-sm-4 company-box-socials">
                                        <ul>
                                            <li class="vkontakte"><a
                                                        href="{{ $company->contacts->groups->getVkontakteURL() }}">Вконтакте</a>
                                            </li>
                                            <li class="facebook"><a
                                                        href="{{ $company->contacts->groups->getFacebookURL() }}">Facebook</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-md-4 col-sm-4 phones">
                                        <div class="row">
                                            <ul>
                                                @foreach($company->contacts->phones()->filled()->get() as $phone)
                                                    <li>{{ $phone->getNumber() }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row technical-info">
                                <div class="col-md-4 col-sm-4 experience">
                                    <p>Опыт работы более 3 лет</p>
                                </div>
                                <div class="col-md-4 col-sm-4 contract">
                                    <p>Работа по договору</p>
                                </div>
                                <!--
                                <div class="col-md-4 col-sm-4 rating">
                                    <div class="row">
                                        <img src="./assets/images/company/rating.jpg" style="margin-top: 7px" alt="Рейтинг">
                                    </div>
                                </div>
                                -->
                            </div>
                            <div class="row contacts-info-mobile">
                                <ul>
                                    @if(($phone = $company->contacts->phones()->filled()->first()))
                                        <li>{{ $phone->getNumber() }}</li>
                                    @endif
                                    @if(!empty($website))
                                        <li><a href="{{ $website }}">{{ $website }}</a></li>
                                    @endif
                                    <li>УНП: {{ $company->getUNPNumber() }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 technical-info-mobile">
                    <div class="row">
                        <div class="col-md-4 experience">
                            <p>Опыт работы более 3 лет</p>
                        </div>
                        <div class="col-md-4 contract">
                            <p>Работа по договору</p>
                        </div>
                        <!--
                        <div class="col-md-4 rating">
                            <div class="row">
                                 <img src="./assets/images/company/rating.jpg" style="margin-top: 5px" alt="Рейтинг">
                            </div>
                        </div>
                        -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>