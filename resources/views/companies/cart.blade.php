@extends('layouts.app')

@section('head')
    <title>ZvoniMasteru.by - {{ $company->getName() }}</title>
@endsection

@section('content')
    <div class="container companies">
        <div class="row">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <div class="row">
            <div class="col-md-12">
                <h3>{{ $company->getName() }}<a href="{{ URL::previous() }}" class="btn btn-default">Back</a></h3>
                <img class="featurette-image img-responsive" id="logo" alt="150x150" width="200" src="/{{ $company->getLogo() }}">

                <p>УНП: {{ $company->getUNPNumber() }}</p>
                <p>Адрес: {{ $company->contacts->getAddress() }}</p>
                <p>Сайт: @if(!empty($website = $company->contacts->getWebsiteURL())) <a href="{{ $website }}">{{ $website }}</a>
                    @else Не заполнено @endif </p>
                @if(count($phones) > 0)
                    <p>Телефоны:</p>
                    <ul>
                        @foreach($phones as $phone)
                            <li>{{ $phone->getNumber() }}</li>
                        @endforeach
                    </ul>
                @endif
                <p>Эл. почта компании: @if(!empty($email = $company->contacts->getCompanyEmail())) <a href="mailto:{{ $email }}">{{ $email }}</a>
                    @else Не заполнено @endif </p>

                <h4>Социальные сети:</h4>
                <ul>
                    <li><a href="{{ $groups->getVkontakteURL() }}">Группа Вконтакте</a></li>
                    <li><a href="{{ $groups->getFacebookURL() }}">Группа Facebook</a></li>
                    <li><a href="{{ $groups->getOdnoklassnikiURL() }}">Группа Одноклассники</a></li>
                </ul>
                <h4>Описание компании:</h4>
                <p>{{ $company->getDescription() }}</p>
                <!-- Тут будут отзывы -->
            </div>
        </div><!-- /.row -->
        <!-- Reviews -->
        <div class="row">
            @include('companies.reviews.index')
        </div>
    </div><!-- /.container -->
@endsection

@section('scripts')
    <script src="/js/app.js"></script>
@endsection