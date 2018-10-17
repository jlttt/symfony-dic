<?php

use App\Authorization\AccessManager;
use App\Authorization\Voter\VoterInterface;
use Symfony\Component\DependencyInjection\Definition;

$privateDefinition = new Definition();
$privateDefinition
    ->setAutowired(true)
    ->setAutoconfigured(true)
    ->setPublic(false);

$publicDefinition = new Definition();
$publicDefinition
    ->setAutowired(true)
    ->setAutoconfigured(true)
    ->setPublic(true);

$container
    ->registerForAutoconfiguration(VoterInterface::class)
    ->addTag('app.voter');

$loader->registerClasses(
    $privateDefinition,
    'App\\', '../src/*',
    '../src/{Entity,DependencyInjection}'
);

$loader->registerClasses(
    $publicDefinition,
    'App\\Controller\\',
    '../src/Controller/*'
);

// $container->getDefinition(AccessManager::class)
//     ->setPublic(true)
//     ->addArgument($container->findTaggedServiceIds('app.voter'));
