<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('head')
    <title>ZvoniMasteru.by</title>

    <!-- Bootstrap -->
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/fonts.css" rel="stylesheet">
    <link href="/assets/css/styles.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
<div class="container">
    <!-- Main navbar -->
    <div class="navbar navbar-default" id="zm-navbar-header" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" id="header-logo" href="/">
                    <img src="/assets/images/logo.png" alt="ZvoniMasteru.by"/>
                </a>
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="navbar-collapse collapse navbar-right {{ !Auth::guest() ? 'account-wrapper' : '' }} hidden-lg">
                @if (Auth::guest())
                    <ul class="nav navbar-nav">
                        <li><a href="">FAQ</a></li>
                        <li><a href="" data-toggle="modal" data-target="#modal-auth">Войти</a></li>
                        <li><a href="" data-toggle="modal" data-target="#modal-registration">Регистрация</a></li>
                    </ul>
                    <div id="nav-search">
                        <form action="" method="GET">
                            <input class="nav-search-input" type="text" name="search" placeholder="Что будете искать?">
                            <button class="nav-search-submit"></button>
                        </form>
                    </div>
                @else
                    <ul class="nav navbar-nav account-header">
                        <li class="dropdown">
                            <a href="" class="dropdown-toggle" data-toggle="dropdown">
                                <span class="username">{{ Auth::user()->getName() }}</span>
                                <img class="username-logo" src="/{{ Auth::user()->company->getLogo() }}" alt=""/>
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                @if(Auth::user()->hasRole('admin'))
                                    <li><a href="{{ route('admin.index') }}">Админ-панель</a></li>
                                @endif
                                <li class="account-ico">
                                    <a href="{{ route('account.index') }}">Личный кабинет</a>
                                </li>
                                <li class="logout-ico">
                                    <a href=""
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Выход</a>
                                </li>
                                <form id="logout-form" action="{{ url('/logout') }}" method="POST"
                                      style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </ul>
                        </li>
                    </ul>
                @endif
            </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
    </div>
</div>