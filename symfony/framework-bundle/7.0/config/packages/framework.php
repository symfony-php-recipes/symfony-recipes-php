<?php

declare(strict_types=1);

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $containerConfigurator->extension('framework', [
        'secret' => '%env(APP_SECRET)%',
        'handle_all_throwables' => true,
        'session' => [
            'handler_id' => null,
            'cookie_secure' => 'auto',
            'cookie_samesite' => 'lax',
        ],
        'php_errors' => [
            'log' => true,
        ],
    ]);
    if ($containerConfigurator->env() === 'test') {
        $containerConfigurator->extension('framework', [
            'test' => true,
            'session' => [
                'storage_factory_id' => 'session.storage.factory.mock_file',
            ],
        ]);
    }
};
