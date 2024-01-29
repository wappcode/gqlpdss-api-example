<?php

namespace AppModule;

use AppModule\Entities\Author;
use AppModule\Graphql\AuthorConnectionFactory;
use AppModule\Graphql\AuthorEdgeFactory;
use GPDCore\Graphql\GPDFieldFactory;
use GPDCore\Library\AbstractModule;
use GraphQL\Type\Definition\Type;

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
                AuthorEdgeFactory::NAME => AuthorEdgeFactory::getFactory($this->context,Author::class),
                AuthorConnectionFactory::NAME => AuthorConnectionFactory::getFactory($this->context, AuthorEdgeFactory::NAME)
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
            'Author::fullName'=> function($root, $args, $context, $info){
                return $root["firstName"]." ".$root["lastName"] ??'';

            }
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
            'getAuthor'=> GPDFieldFactory::buildFieldItem($this->context, Author::class),
            'getAuthorsList'=> GPDFieldFactory::buildFieldList($this->context, Author::class),
            'getAuthorsPaginatedList'=> GPDFieldFactory::buildFieldConnection($this->context,$authorConnection,  Author::class),
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
            'createAuthor' => GPDFieldFactory::buildFieldCreate($this->context, Author::class)
        ];
    }
}
