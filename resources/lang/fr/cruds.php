<?php

return [
    'userManagement' => [
        'title'          => 'Utilisateurs',
        'title_singular' => 'Utilisateurs',
    ],
    'permission'     => [
        'title'          => 'Autorisations',
        'title_singular' => 'Droits',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'title'             => 'Title',
            'title_helper'      => '',
            'created_at'        => 'Created at',
            'created_at_helper' => '',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => '',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => '',
        ],
    ],
    'role'           => [
        'title'          => 'Rôles',
        'title_singular' => 'Rôle',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => '',
            'title'              => 'Title',
            'title_helper'       => '',
            'permissions'        => 'Permissions',
            'permissions_helper' => '',
            'created_at'         => 'Created at',
            'created_at_helper'  => '',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => '',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => '',
        ],
    ],
    'user'           => [
        'title'          => 'Utilisateurs',
        'title_singular' => 'Utilisateur',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => '',
            'name'                     => 'Name',
            'name_helper'              => '',
            'email'                    => 'Email',
            'email_helper'             => '',
            'email_verified_at'        => 'Email verified at',
            'email_verified_at_helper' => '',
            'password'                 => 'Password',
            'password_helper'          => '',
            'roles'                    => 'Roles',
            'roles_helper'             => '',
            'remember_token'           => 'Remember Token',
            'remember_token_helper'    => '',
            'created_at'               => 'Created at',
            'created_at_helper'        => '',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => '',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => '',
        ],
    ],
    'equipe'         => [
        'title'          => 'Equipe',
        'title_singular' => 'Equipe',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'name'              => 'Name',
            'name_helper'       => '',
            'logo'              => 'Logo',
            'logo_helper'       => '',
            'created_at'        => 'Created at',
            'created_at_helper' => '',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => '',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => '',
            'division'          => 'Division',
            'division_helper'   => '',
        ],
    ],
    'match'          => [
        'title'          => 'Match',
        'title_singular' => 'Match',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'home'              => 'Home',
            'home_helper'       => '',
            'away'              => 'Away',
            'away_helper'       => '',
            'start_time'        => 'Date et Heure',
            'start_time_helper' => '',
            'ticket'            => 'Ticket',
            'ticket_helper'     => '',
            'result_h'          => 'Resultat Home',
            'result_h_helper'   => '',
            'result_a'          => 'Resultat Away',
            'result_a_helper'   => '',
            'created_at'        => 'Created at',
            'created_at_helper' => '',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => '',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => '',
            'division'          => 'Division',
            'division_helper'   => '',
        ],
    ],
    'actus'          => [
        'title'          => 'Actus',
        'title_singular' => 'Actus',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'cover'             => 'Cover',
            'cover_helper'      => '',
            'title'             => 'Title',
            'title_helper'      => '',
            'content'           => 'Content',
            'content_helper'    => '',
            'division'          => 'Division',
            'division_helper'   => '',
            'created_at'        => 'Created at',
            'created_at_helper' => '',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => '',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => '',
        ],
    ],
];
