<?php

namespace AppModule\Graphql;

use AppModule\Entities\Author;
use GPDCore\Library\EntityBuffer;
use GPDCore\Library\ResolverFactory;

class PostResolversFactory
{

    public static function getAuthorResolver()
    {
        $entityBuffer = new EntityBuffer(Author::class);
        $resolver = ResolverFactory::createEntityResolver($entityBuffer, 'author');
        return $resolver;
    }
}
