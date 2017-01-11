<?php

// Admin > Dashboard
Breadcrumbs::register('admin', function ($breadcrumbs) {
    $breadcrumbs->push('Admin', route('admin.index'));
    $breadcrumbs->push('Dashboard');
});

// Admin > Companies
Breadcrumbs::register('admin.companies.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin');
    $breadcrumbs->push('Companies', route('admin.companies.index'));
});
