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

// Dashboard > Tariffs > Edit Tariff
Breadcrumbs::register('admin.tariffs.edit', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.tariffs');
    $breadcrumbs->push('Edit Tariff');
});

// Dashboard > Tariffs > Services
Breadcrumbs::register('admin.tariffs.services', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.tariffs');
    $breadcrumbs->push('Services', route('admin.services.index'));
});

// Dashboard > Specialities
Breadcrumbs::register('admin.specialities', function ($breadcrumbs) {
    $breadcrumbs->parent('admin');
    $breadcrumbs->push('Specialities', route('admin.specialities.index'));
});

// Dashboard > Categories
Breadcrumbs::register('admin.categories', function ($breadcrumbs) {
    $breadcrumbs->parent('admin');
    $breadcrumbs->push('Categories', route('admin.categories.index'));
});

// Dashboard > Categories > Create Category
Breadcrumbs::register('admin.categories.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.categories');
    $breadcrumbs->push('Create Category', route('admin.categories.create'));
});

// Dashboard > Categories > Edit Category
Breadcrumbs::register('admin.categories.edit', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.categories');
    $breadcrumbs->push('Edit Category');
});
