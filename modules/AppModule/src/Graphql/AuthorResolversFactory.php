<?php

namespace AppModule\Graphql;

use AppModule\Entities\Author;
use AppModule\Entities\Post;
use GPDCore\Library\ResolverFactory;

class AuthorResolversFactory
{

    public static function getPostResolver()
    {
        $resolver = ResolverFactory::createCollectionResolver(Author::class, 'posts', null, Post::class);
        return $resolver;
    }

    public static function getFullnameResolver(): callable
    {
        return function ($root, $args, $context, $info) {
            return $root["firstName"] . " " . $root["lastName"] ?? '';
        };
    }
}
