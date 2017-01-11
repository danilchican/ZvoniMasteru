<?php

// Admin > Dashboard
Breadcrumbs::register('admin', function ($breadcrumbs) {
    $breadcrumbs->push('Dashboard', route('admin.index'));
});

// Admin > Dashboard > Companies
Breadcrumbs::register('admin.companies.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin');
    $breadcrumbs->push('Companies', route('admin.companies.index'));
});

// Admin > Dashboard > Tariffs
Breadcrumbs::register('admin.tariffs', function ($breadcrumbs) {
    $breadcrumbs->parent('admin');
    $breadcrumbs->push('Tariffs', route('admin.tariffs.index'));
});