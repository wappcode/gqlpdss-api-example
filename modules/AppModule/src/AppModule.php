<?php

namespace AppModule;

use AppModule\Entities\Post;
use AppModule\Entities\Author;
use GraphQL\Type\Definition\Type;
use GPDCore\Library\AbstractModule;
use GPDCore\Graphql\GPDFieldFactory;
use AppModule\Graphql\PostEdgeFactory;
use AppModule\Graphql\AuthorEdgeFactory;
use AppModule\Graphql\PostResolversFactory;
use AppModule\Graphql\PostConnectionFactory;
use AppModule\Graphql\AuthorResolversFactory;
use AppModule\Graphql\AuthorConnectionFactory;

class AppModule extends AbstractModule
{

    /**
     * Array con la configuración del módulo
     *
     * @return array
     */
    function getConfig(): array
    {
        return require(__DIR__ . '/../config/module.config.php');
    }
    function getServicesAndGQLTypes(): array
    {
        return [
            'invokables' => [],
            'factories' => [
                AuthorEdgeFactory::NAME => AuthorEdgeFactory::getFactory($this->context, Author::class),
                AuthorConnectionFactory::NAME => AuthorConnectionFactory::getFactory($this->context, AuthorEdgeFactory::NAME),
                PostEdgeFactory::NAME => PostEdgeFactory::getFactory($this->context, Post::class),
                PostConnectionFactory::NAME => PostConnectionFactory::getFactory($this->context, PostEdgeFactory::NAME)
            ],

        ];
    }
    /**
     * Array con los resolvers del módulo
     *
     * @return array array(string $key => callable $resolver)
     */
    function getResolvers(): array
    {
        return [
            'Post::author' => PostResolversFactory::getAuthorResolver(),
            'Author::posts' => AuthorResolversFactory::getPostResolver(),
            'Author::fullName' => AuthorResolversFactory::getFullnameResolver(),
        ];
    }
    /**
     * Array con los graphql Queries del módulo
     *
     * @return array
     */
    function getQueryFields(): array
    {

        $authorConnection = $this->context->getServiceManager()->get(AuthorConnectionFactory::NAME);
        $postConnection = $this->context->getServiceManager()->get(PostConnectionFactory::NAME);
        return [
            'echo' =>  [
                'type' => Type::nonNull(Type::string()),
                'args' => [
                    'message' => Type::nonNull(Type::string())
                ],

                'resolve' => function ($root, $args) {
                    return $args["message"];
                }
            ],
            'getAuthor' => GPDFieldFactory::buildFieldItem($this->context, Author::class),
            'getAuthorsList' => GPDFieldFactory::buildFieldList($this->context, Author::class),
            'getAuthorsPaginatedList' => GPDFieldFactory::buildFieldConnection($this->context, $authorConnection,  Author::class),
            'getPost' => GPDFieldFactory::buildFieldItem($this->context, Post::class),
            'getPostsList' => GPDFieldFactory::buildFieldList($this->context, Post::class),
            'getPostsPaginatedList' => GPDFieldFactory::buildFieldConnection($this->context, $postConnection,  Post::class),
        ];
    }
    /**
     * Array con los graphql mutations del módulo
     *
     * @return array
     */
    function getMutationFields(): array
    {
        return [
            'createAuthor' => GPDFieldFactory::buildFieldCreate($this->context, Author::class),
            'updateAuthor' => GPDFieldFactory::buildFieldUpdate($this->context, Author::class),
            'deleteAuthor' => GPDFieldFactory::buildFieldDelete($this->context, Author::class),
            'createPost' => GPDFieldFactory::buildFieldCreate($this->context, Post::class),
            'updatePost' => GPDFieldFactory::buildFieldUpdate($this->context, Post::class),
            'deletePost' => GPDFieldFactory::buildFieldDelete($this->context, Post::class)
        ];
    }
}
