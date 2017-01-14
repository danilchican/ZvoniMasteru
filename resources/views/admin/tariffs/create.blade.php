@extends('admin.layouts.app')

@section('styles')
    <!-- DataTables -->
    <link rel="stylesheet" href="/css/admin/dataTables.bootstrap.css">
    <link rel="stylesheet" href="/css/admin/jquery.dataTables.css">
    <link rel="stylesheet" href="/css/admin/pace.min.css">
    <link rel="stylesheet" href="/css/admin/select2.min.css">
    <style>
        .select2-container--default
        .select2-selection--multiple
        .select2-selection__choice {
            color: #000;
        }
    </style>
@endsection

@section('breadcrumbs')
    <section class="content-header">
        <h1>{{ $titlePage }}</h1>
        {!! Breadcrumbs::render('admin.tariffs.create') !!}
    </section>
@endsection

@section('content')
    <!-- Main content -->
    <section class="content">
        <!-- Info boxes -->
        <div class="callout callout-info">
            <h4>About this page!</h4>
            {!! $about or "<p>This page has been created for control of all tariffs. You can create, delete and edit
            any tariff by clicking on buttons.</p>" !!}
        </div>

        @include('admin.partials.errors')

        <div class="col-xs-12">
            <div class="row">
                {!! Form::open(['route' => 'admin.tariffs.store']) !!}
                <div class="box box-primary create-tariff">
                    <div class="box-header with-border">
                        <i class="fa fa-edit"></i>
                        <h3 class="box-title">{{ $titlePage }}</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="col-xs-12">
                            <div class="row">
                                <div class="col-xs-6" style="padding-left:0;">
                                    <div class="form-group">
                                        <label for="name">Название тарифа</label>
                                        <input type="text" value="{{ old('title') }}" class="form-control" name="title" placeholder="Введите название тарифа">
                                    </div>
                                </div>
                                <div class="col-xs-6" style="padding-right:0;">
                                    <div class="form-group">
                                        <label for="slug">Топ</label>
                                        <input type="number" value="{{ ($old = old('top')) ? $old : 0 }}" min="0" class="form-control" name="top">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="row">
                                <div class="col-xs-6" style="padding-left:0;">
                                    <div class="form-group">
                                        <label for="desc">Для кого</label>
                                        <input type="text" class="form-control" value="{{ old('whom') }}" name="whom" placeholder="Для малого бизнеса">
                                    </div>
                                </div>
                                <div class="col-xs-6" style="padding-right:0;">
                                    <div class="form-group">
                                        <label for="desc">Доп. услуга</label>
                                        <input type="text" class="form-control" value="{{ old('additional_service') }}" name="additional_service" placeholder="Наполнение карточки">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                </div>

                <div class="col-xs-6">
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title">Prices</h3>
                        </div>
                        <div class="box-body">
                            <div id="prices">
                                <div class="col-xs-12 price-item">
                                    <div class="row">
                                        <div class="col-xs-6" style="padding-left:0;">
                                            <label for="desc">Price <i class="fa fa-fw fa-remove remove-price-btn"></i></label>
                                            <div class="input-group">
                                                <input type="number" class="form-control" step="any" value="0" name="prices[]">
                                                <span class="input-group-addon">руб.</span>
                                            </div>
                                        </div>
                                        <div class="col-xs-6" style="padding-right:0;">
                                            <div class="form-group">
                                                <label for="desc">Time</label>
                                                <input type="text" class="form-control" name="ranges[]" placeholder="1 месяц">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <div class="row">
                                    <button type="button" id="add-new-price-btn" style="text-align: left;" class="btn btn-block btn-success">
                                        <i class="fa fa-fw fa-plus"></i> Add more
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title">Services</h3>
                        </div>
                        <div class="box-body">
                            @if(count($services) > 0)
                                <div class="form-group">
                                    <select name="services[]" multiple="multiple" class="form-control select2 select2-hidden-accessible services-select" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                        @foreach($services as $service)
                                            <option value="{{ $service->id }}" {{ ( old('services') ? in_array($service->id, old('services')) : false) ? 'selected' :'' }}>{{ $service->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @else
                                <span>Услуг пока нет.</span>
                            @endif
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="row">
                        <div class="form-group">
                            <label for="published">Published
                                <select name="published">
                                    <option value="1">Да</option>
                                    <option value="0">Нет</option>
                                </select>
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <button type="submit" class="btn btn-primary save-button">Save</button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </section><!-- /.content -->
@endsection

@section('javascripts')
    <script src="/js/admin/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            $(".services-select").select2({
                placeholder: "Выберите услуги...",
                allowClear: true
            });

            var add_price_btn = $('#add-new-price-btn');
            var prices_block = $('#prices');
            var new_price_block   = '';

            new_price_block = '<div class=\"col-xs-12 price-item\">'
                    + '<div class=\"row\">'
                    + '<div class=\"col-xs-6\" style=\"padding-left:0;\">'
                    + '<label for=\"desc\">Price <i class=\"fa fa-fw fa-remove remove-price-btn\"></i></label>'
                    + '<div class=\"input-group\">'
                    + '<input type=\"number\" class=\"form-control\" step=\"any\" value=\"0\" name=\"prices[]\">'
                    + '<span class=\"input-group-addon\">руб.</span>'
                    + '</div></div>'
                    + '<div class=\"col-xs-6\" style=\"padding-right:0;\">'
                    + '<div class=\"form-group\">'
                    + '<label for=\"desc\">Time</label>'
                    + '<input type=\"text\" class=\"form-control\" name=\"ranges[]\" placeholder=\"1 месяц\">'
                    + '</div></div></div></div>';

            add_price_btn.on('click', function () {
                prices_block.append(new_price_block);
            });

            $('.content').on("click", ".remove-price-btn",  function () {
                this.closest('.price-item').remove();
            });

        });
    </script>
@endsection