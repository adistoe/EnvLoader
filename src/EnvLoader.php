<?php

namespace adistoe;

/**
 * The EnvLoader loads environment variables from a .env file into variables / functions
 */
class EnvLoader
{
    /**
     * Load variables
     *
     * @param ?string $path Path to the .env file
     */
    public static function load(string $path = null): void
    {
        // Get .env variables
        $vars = self::getFile($path);

        // Save values into the wished variables / functions
        foreach ($vars as $name => $value) {
            putenv($name . '=' . $value);
        }
    }

    /**
     * Load the .env file
     *
     * @param ?string $path Path to the .env file
     * @return array
     */
    private static function getFile(string $path = null): array
    {
        // Set path to document root if no path is given
        $path = preg_replace(
            '/\/.env$/',
            '',
            rtrim($path ?? $_SERVER['DOCUMENT_ROOT'], '/')
        );
        $file = $path . '/.env';
        $data = [];

        // Search for the .env file if it is not in the current path and auto search is active
        if (!file_exists($file)) {
            $file = self::searchFile($path);
        }

        // Load .env file (as ini) if the file was found
        if (file_exists($file)) {
            $data = parse_ini_file($file);
        }

        return $data;
    }

    /**
     * Search for the .env file
     *
     * @param string $path Current path
     * @return string Returns the path to the .env file
     */
    private static function searchFile(string $path): string
    {
        $file = $path . '/.env';

        // Check if the file is in the current folder
        if (file_exists($file)) {
            return $file;
        }

        $folders = glob($path . '/*', GLOB_ONLYDIR);
        $file = false;

        // Search through the folders
        foreach ($folders as $folder) {
            $file = self::searchFile($folder);

            if (file_exists($file)) {
                break;
            }
        }

        return $file;
    }
}
