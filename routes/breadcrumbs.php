<?php

// Dashboard
Breadcrumbs::register('admin', function ($breadcrumbs) {
    $breadcrumbs->push('Dashboard', route('admin.index'));
});

// Dashboard > Companies
Breadcrumbs::register('admin.companies.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin');
    $breadcrumbs->push('Companies', route('admin.companies.index'));
});

// Dashboard > Tariffs
Breadcrumbs::register('admin.tariffs', function ($breadcrumbs) {
    $breadcrumbs->parent('admin');
    $breadcrumbs->push('Tariffs', route('admin.tariffs.index'));
});

// Dashboard > Tariffs > Create Tariff
Breadcrumbs::register('admin.tariffs.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.tariffs');
    $breadcrumbs->push('Create Tariff', route('admin.tariffs.create'));
});

// Dashboard > Tariffs > Services
Breadcrumbs::register('admin.tariffs.services', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.tariffs');
    $breadcrumbs->push('Services', route('admin.services.index'));
});
