<?php

namespace AppModule\Graphql;

use GPDCore\Library\AbstractConnectionTypeServiceFactory;

class AuthorConnectionFactory extends AbstractConnectionTypeServiceFactory {
    const NAME = 'AuthorConnection';
    const DESCRIPTION = '';
    protected static $instance = null;

}