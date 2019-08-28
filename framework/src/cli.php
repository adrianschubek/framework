<?php
/**
 * Copyright (c) 2019. Adrian Schubek.
 * https://framework.adriansoftware.de
 */


use App\Controllers\ListenerController;
use Symfony\Component\Console\Output\OutputInterface;

$app = new Silly\Application();

$app->command('listenx', function (OutputInterface $output) use ($container) {
    $output->writeln("[INFO] Listening...");
    $container->call([ListenerController::class, 'show']);
});

$app->run();