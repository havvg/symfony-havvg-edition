<?php

namespace Application\Composer;

use Composer\Script\Event;
use Composer\Util\Filesystem;

final class BootstrapHandler
{
    /**
     * Ensures that all required directories exist when installing the application.
     *
     * @param Event $event
     */
    public static function ensureDirectoriesExist(Event $event)
    {
        $options = $event->getComposer()->getPackage()->getExtra();

        $directories = [
            $options['symfony-var-dir'],
        ];

        foreach ($directories as $eachDirectory) {
            $event->getIO()->write(sprintf('Ensuring the <comment>%s</comment> directory exists.', $eachDirectory));

            $fs = new Filesystem();
            $fs->ensureDirectoryExists($eachDirectory);
        }
    }
}
