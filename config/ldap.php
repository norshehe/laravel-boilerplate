<?php

return [

    'logging' => env('LDAP_LOGGING', false),

    'connections' => [
        'default' => [
            'auto_connect' => env('LDAP_AUTO_CONNECT', false),

            'connection' => Adldap\Connections\Ldap::class,
            'settings' => [

                'schema' => env('LDAP_SCHEMA', '') == 'OpenLDAP' ?
                    Adldap\Schemas\OpenLDAP::class : (env('LDAP_SCHEMA', '') == 'FreeIPA' ?
                        Adldap\Schemas\FreeIPA::class :
                        Adldap\Schemas\ActiveDirectory::class),

                'account_prefix' => env('LDAP_ACCOUNT_PREFIX', ''),
                'account_suffix' => env('LDAP_ACCOUNT_SUFFIX', '@kmc.int'),
                'hosts' => explode(' ', env('LDAP_HOSTS', 'pic-dc-02.kmc.int pic-dc-03.kmc.int')),
                'port' => env('LDAP_PORT', 389),
                'timeout' => env('LDAP_TIMEOUT', 5),
                'base_dn' => env('LDAP_BASE_DN', 'DC=kmc,DC=int'),
                'username' => env('LDAP_ADMIN_USERNAME', 'vtiger'),
                'password' => env('LDAP_ADMIN_PASSWORD', 'NT{t;E{((3YRV=F'),
                'follow_referrals' => env('LDAP_FOLLOW_REFERRALS', false),
                'use_ssl' => env('LDAP_USE_SSL', false),
                'use_tls' => env('LDAP_USE_TLS', false),

            ],

        ],

    ],

];
