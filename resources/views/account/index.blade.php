@extends('layouts.app')

@section('head')
    <title>ZvoniMasteru.by - Личный кабинет</title>
@endsection

@section('styles')
    <link rel="stylesheet" href="/css/admin/toastr.css">
    <link rel="stylesheet" type="text/css" href="/css/lightbox/lightbox.css">
    <style>
        .btn-file { position: relative; overflow: hidden; margin-right: 4px; }
        .btn-file input { position: absolute; top: 0; right: 0; margin: 0; opacity: 0; filter: alpha(opacity=0);
            transform: translate(-300px, 0) scale(4); font-size: 23px; direction: ltr; cursor: pointer; }
        /* Fix for IE 7: */
        * + html .btn-file { padding: 2px 15px; margin: 1px 0 0 0; }
        .panel-heading { overflow: hidden; }
        #album-images {
            margin: 0;
            padding: 0;
        }
        #album-images li {
            margin: 0;
            padding: 0;
            list-style: none;
            float: left;
            padding-right: 10px;
        }
        #album-images img {
            width: 240px;
            height: 160px;
            border: 2px solid black;
            margin-bottom: 10px;
        }
    </style>
@endsection

@section('content')
    <div class="container" id="app">
        <div class="row">
            <div class="col-md-3">
                <ul class="list-group">
                    <router-link to="/account" class="list-group-item" exact>Основная информация</router-link>
                    <router-link to="/account/services" class="list-group-item" exact>Услуги</router-link>
                    <router-link to="/account/portfolio" class="list-group-item" exact><span class="badge pull-right">0</span> Фото работ</router-link>
                    <router-link to="/account/reviews" class="list-group-item" exact><span class="badge pull-right">0</span> Отзывы</router-link>
                    <router-link to="/account/tariffs" class="list-group-item" exact>Продвижение в ТОП</router-link>
                </ul>
            </div>
            <div class="col-md-9">
                <div class="row">
                    <router-view class="view"></router-view>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="/js/account.js"></script>
@endsection