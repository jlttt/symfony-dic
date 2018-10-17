<?php
ini_set('display_errors', 1);

require __DIR__ . '/../vendor/autoload.php';

use App\DependencyInjection\Compiler\VoterPass;
use App\Controller\PostController;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;

// public/index.php
$containerBuilder = new ContainerBuilder();
$containerBuilder->addCompilerPass(new VoterPass());

$loader = new PhpFileLoader($containerBuilder, new FileLocator(__DIR__.'/../config'));
$loader->load('config.php');

$containerBuilder->compile();

$containerBuilder->get(PostController::class)->index();
