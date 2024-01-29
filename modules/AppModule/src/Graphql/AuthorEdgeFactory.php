<?php

namespace AppModule\Graphql;

use GPDCore\Library\AbstractEdgeTypeServiceFactory;

class AuthorEdgeFactory extends AbstractEdgeTypeServiceFactory {
    
    const NAME = 'AuthorEdge';
    const DESCRIPTION = '';
    protected static $instance = null;
}