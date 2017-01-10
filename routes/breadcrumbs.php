<?php

// Admin home
Breadcrumbs::register('admin', function ($breadcrumbs) {
    $breadcrumbs->push('Admin', route('admin.index'));
    $breadcrumbs->push('Dashboard');
});

// Admin > Companies
Breadcrumbs::register('admin.companies', function ($breadcrumbs) {
    $breadcrumbs->parent('admin');
    $breadcrumbs->push('Companies', url('admin/companies'));
});
