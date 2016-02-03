<?php
/**
 * Created by PhpStorm.
 * User: monkey_C
 * Date: 02-Feb-16
 * Time: 11:33 PM
 */

// Organisation
Breadcrumbs::register('organization', function ($breadcrumbs) {
    $breadcrumbs->push(trans('breadcrumbs.overview'), action('OrganizationController@index'));
});

// Organisation > Create group
Breadcrumbs::register('create_group', function ($breadcrumbs) {
    $breadcrumbs->parent('organization');
    $breadcrumbs->push(trans('breadcrumbs.group-creation'), action('OsjsGroupsController@create'));
});

// Organisation > Create user
Breadcrumbs::register('create_user', function ($breadcrumbs) {
    $breadcrumbs->parent('organization');
    $breadcrumbs->push(trans('breadcrumbs.user-creation'), action('OsjsUsersController@create'));
});


// Organisation > Show group
Breadcrumbs::register('show_group', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('organization');
    $breadcrumbs->push(trans('breadcrumbs.show-group'), action('OsjsGroupsController@show', $id));
});

// Organisation > Show user
Breadcrumbs::register('show_user', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('organization');
    $breadcrumbs->push(trans('breadcrumbs.show-user'), action('OsjsUsersController@show', $id));
});


// Organisation > Edit group
Breadcrumbs::register('edit_group', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('show_group', $id);
    $breadcrumbs->push(trans('breadcrumbs.edit-group'), action('OsjsGroupsController@edit', $id));
});

// Organisation > Edit user
Breadcrumbs::register('edit_user', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('show_user', $id);
    $breadcrumbs->push(trans('breadcrumbs.edit-user'), action('OsjsUsersController@edit', $id));
});