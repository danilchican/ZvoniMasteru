@extends('admin.layouts.app')

@section('styles')
    <!-- DataTables -->
    <link rel="stylesheet" href="/css/admin/dataTables.bootstrap.css">
    <link rel="stylesheet" href="/css/admin/jquery.dataTables.css">
@endsection

@section('breadcrumbs')
    <section class="content-header">
        <h1>{{ $titlePage }}</h1>
        {!! Breadcrumbs::render('admin.companies.index') !!}
    </section>
@endsection

@section('content')
<!-- Main content -->
<section class="content">
    <!-- Info boxes -->
    <div class="callout callout-info">
        <h4>About this page!</h4>
        {!! $about or "<p>This page has been created for manipulation of all registered companies. You can create, delete and edit
        any company by clicking for buttons.</p>" !!}

    </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="box no-margin">
                <div class="box-header">
                    <h3 class="box-title">{{ $titlePage }}</h3>
                    <div class="box-tools">
                        <div class="input-group" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control input-sm pull-right" placeholder="Search">
                            <div class="input-group-btn">
                                <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding no-margin">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Registration Date</th>
                                <th>Published</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($companies as $company)
                            <tr>
                                <td>{{ $company->id }}.</td>
                                <td><a href="/adminpanel/companies/view/{{ $company->id }}" data-toggle="tooltip" data-original-title="View Company">{!! empty($company->name) ? 'No name' : $company->name !!}</a></td>
                                <td>{{ LocalizedCarbon::instance($company->user->created_at)->diffForHumans() }}</td> <!-- Registration date -->
                                <td>
                                    @if($company->status == 2)
                                        <span class="label label-success">Approved</span>
                                    @else
                                        <span class="label label-danger">Delivered</span>
                                    @endif
                                </td> <!-- Published status -->
                                <td style="text-overflow: ellipsis;">
                                    {!! empty($company->description) ? 'Company has no description yet...' : $company->description !!}
                                </td> <!-- Description -->
                                <td>
                                    <div class="btn-group">
                                        <a href="/adminpanel/companies/edit/{{ $company->id }}"><button type="button" class="btn btn-info btn-xs">Edit</button></a>
                                        <a href="/adminpanel/companies/delete/{{ $company->id }}"><button type="button" class="btn btn-danger btn-xs">Delete</button></a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->

    <div class="row">
        <div class="col-sm-6">
            {!! $companies->links() !!}
        </div><!-- /.col -->
    </div><!-- /.row -->

</section><!-- /.content -->
@endsection