<?php

return
[
    /**
     * ---------------------------------------------------------
     * Route Prefix
     * ---------------------------------------------------------
     *
     * Base route prefix for entire package route
     */
    'prefix' => '/system-janitor',

    /**
     * ---------------------------------------------------------
     * Login settings
     * ---------------------------------------------------------
     *
     */
    'login' =>
    [
        /**
         * ---------------------------------------------------------
         * Security token
         * ---------------------------------------------------------
         *
         * Encrypted password used for login. For generate a new
         * password access the system dashboard and generate a
         * new encrypted password.
         *
         * Default password is: admin (3bDEc96XtH1MxWiLGOs/X09weEZPY2M9)
         */
        'security' => '3bDEc96XtH1MxWiLGOs/X09weEZPY2M9'
    ],
];