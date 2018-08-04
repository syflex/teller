<?php
Breadcrumbs::for('admin.auth.generate-pdf', function ($trail) {
    $trail->parent('admin.auth.user.index');
    $trail->push(__('pdf'), url('admin/auth/generate-pdf'));
});

Breadcrumbs::for('admin.auth.transaction.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('labels.backend.access.users.management'), route('admin.auth.transaction.index'));
});

// Breadcrumbs::for('admin.auth.user.deactivated', function ($trail) {
//     $trail->parent('admin.auth.user.index');
//     $trail->push(__('menus.backend.access.users.deactivated'), route('admin.auth.user.deactivated'));
// });

// Breadcrumbs::for('admin.auth.user.deleted', function ($trail) {
//     $trail->parent('admin.auth.user.index');
//     $trail->push(__('menus.backend.access.users.deleted'), route('admin.auth.user.deleted'));
// });

Breadcrumbs::for('admin.auth.transaction.create', function ($trail) {
    $trail->parent('admin.auth.user.index');
    $trail->push(__('labels.backend.access.users.create'), route('admin.auth.transaction.create'));
});
Breadcrumbs::for('admin.auth.transaction.debit', function ($trail) {
    $trail->parent('admin.auth.user.index');
    $trail->push(__('labels.backend.access.users.create'), route('admin.auth.transaction.debit'));
});

// Breadcrumbs::for('admin.auth.officer.create.user', function ($trail) {
//     $trail->parent('admin.auth.user.index');
//     $trail->push(__('labels.backend.access.users.create'), route('admin.auth.officer.create.user'));
// });

// Breadcrumbs::for('admin.auth.user.show', function ($trail, $id) {
//     $trail->parent('admin.auth.user.index');
//     $trail->push(__('menus.backend.access.users.view'), route('admin.auth.user.show', $id));
// });

// Breadcrumbs::for('admin.auth.user.edit', function ($trail, $id) {
//     $trail->parent('admin.auth.user.index');
//     $trail->push(__('menus.backend.access.users.edit'), route('admin.auth.user.edit', $id));
// });

// Breadcrumbs::for('admin.auth.user.change-password', function ($trail, $id) {
//     $trail->parent('admin.auth.user.index');
//     $trail->push(__('menus.backend.access.users.change-password'), route('admin.auth.user.change-password', $id));
// });
