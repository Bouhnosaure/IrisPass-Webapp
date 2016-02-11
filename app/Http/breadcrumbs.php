<?php
/**
 * Created by PhpStorm.
 * User: monkey_C
 * Date: 02-Feb-16
 * Time: 11:33 PM
 */

// Organisation
Breadcrumbs::register('organization', function ($breadcrumbs) {
    $breadcrumbs->push(trans('breadcrumbs.organization'), action('OrganizationController@index'));
});

// Organisation > Edit
Breadcrumbs::register('organization_edit', function ($breadcrumbs) {
    $breadcrumbs->parent('organization');
    $breadcrumbs->push(trans('breadcrumbs.organization-edit'), action('OrganizationController@edit'));
});


// VirtualDesktop
Breadcrumbs::register('virtualdesktop', function ($breadcrumbs) {
    $breadcrumbs->push(trans('breadcrumbs.virtualdesktop'), action('VirtualDesktopController@index'));
});

// VirtualDesktop > Create group
Breadcrumbs::register('create_group', function ($breadcrumbs) {
    $breadcrumbs->parent('virtualdesktop');
    $breadcrumbs->push(trans('breadcrumbs.group-creation'), action('OsjsGroupsController@create'));
});

// VirtualDesktop > Create user
Breadcrumbs::register('create_user', function ($breadcrumbs) {
    $breadcrumbs->parent('virtualdesktop');
    $breadcrumbs->push(trans('breadcrumbs.user-creation'), action('OsjsUsersController@create'));
});


// VirtualDesktop > Show group
Breadcrumbs::register('show_group', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('virtualdesktop');
    $breadcrumbs->push(trans('breadcrumbs.show-group'), action('OsjsGroupsController@show', $id));
});

// VirtualDesktop > Show user
Breadcrumbs::register('show_user', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('virtualdesktop');
    $breadcrumbs->push(trans('breadcrumbs.show-user'), action('OsjsUsersController@show', $id));
});


// VirtualDesktop > Edit group
Breadcrumbs::register('edit_group', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('virtualdesktop', $id);
    $breadcrumbs->push(trans('breadcrumbs.edit-group'), action('OsjsGroupsController@edit', $id));
});

// VirtualDesktop > Edit user
Breadcrumbs::register('edit_user', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('virtualdesktop', $id);
    $breadcrumbs->push(trans('breadcrumbs.edit-user'), action('OsjsUsersController@edit', $id));
});