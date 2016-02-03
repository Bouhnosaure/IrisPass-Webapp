<?php
/**
 * Created by PhpStorm.
 * User: monkey_C
 * Date: 02-Feb-16
 * Time: 11:33 PM
 */

// Organisation
Breadcrumbs::register('organization', function($breadcrumbs)
{
    $breadcrumbs->push('Vue d\'ensemble', action('OrganizationController@index'));
});

// Organisation > Create group
Breadcrumbs::register('create_group', function($breadcrumbs)
{
    $breadcrumbs->parent('organization');
    $breadcrumbs->push('Créer un groupe', action('OsjsGroupsController@create'));
});

// Organisation > Create user
Breadcrumbs::register('create_user', function($breadcrumbs)
{
    $breadcrumbs->parent('organization');
    $breadcrumbs->push('Créer un utilisateur', action('OsjsUsersController@create'));
});


// Organisation > Show group
Breadcrumbs::register('show_group', function($breadcrumbs, $id)
{
    $breadcrumbs->parent('organization');
    $breadcrumbs->push('Voir un groupe', action('OsjsGroupsController@show', $id));
});

// Organisation > Show user
Breadcrumbs::register('show_user', function($breadcrumbs, $id)
{
    $breadcrumbs->parent('organization');
    $breadcrumbs->push('Voir un utilisateur', action('OsjsUsersController@show', $id));
});


// Organisation > Edit group
Breadcrumbs::register('edit_group', function($breadcrumbs, $id)
{
    $breadcrumbs->parent('show_group', $id);
    $breadcrumbs->push('Éditer un groupe', action('OsjsGroupsController@edit', $id));
});

// Organisation > Edit user
Breadcrumbs::register('edit_user', function($breadcrumbs, $id)
{
    $breadcrumbs->parent('show_user', $id);
    $breadcrumbs->push('Éditer un utilisateur', action('OsjsUsersController@edit', $id));
});