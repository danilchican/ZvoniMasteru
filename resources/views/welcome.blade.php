@extends('layouts.app')

@section('head')
    <title>{{ config('app.name') }}</title>
@endsection

@section('content')
<div class="container" style="margin-bottom:20px;">
    <div class="col-lg-12">
        <div class="input-group">
            <input type="text" class="form-control">
            <span class="input-group-btn">
                  <button type="submit" class="btn btn-default">Найти</button>
              </span>
        </div><!-- /input-group -->
    </div><!-- /.col-lg-6 -->
</div><!-- /.container -->

<div class="container main-catalog">
    <div class="row">
        @foreach($categories as $category)
            <div class="col-md-3 col-sm-3 col-xs-6 main-catalog-box">
                <img class="img-circle" alt="{{ $category->name }}" src="{{ $category->getThumbnailURL() }}" style="width: 140px; height: 140px;">
                <h4><a href="">{{ $category->name }}</a></h4>
            </div><!-- /.col-lg-4 -->
        @endforeach
    </div><!-- /.row -->

</div><!-- /.main-catalog -->
@endsection

@section('scripts')
    <script src="/js/app.js"></script>
@endsection