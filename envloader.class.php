<?php
namespace adistoe;

/**
 * The EnvLoader loads environment variables from a .env file into variables / functions
 */
class EnvLoader
{
    /**
     * Load the .env file
     *
     * @param string $path Path to the .env file
     */
    private static function getFile($path = null)
    {
        // Set path to document root if no path is given
        $path = ($path ? $path : $_SERVER['DOCUMENT_ROOT']);

        // Load .env file (as ini)
        $file = parse_ini_file($path . '/.env');

        return $file;
    }

    /**
     * Load variables
     *
     * @param string $path Path to the .env file
     * @param boolean $loadGetenv Specify if the variables should be loaded into getenv()
     * @param boolean $loadEnv Specify if the variables should be loaded into $_ENV
     * @param boolean $loadServer Specify if the variables should be loaded into $_SERVER
     * @param boolean $loadConstant Specify if the variables should be loaded into constants
     */
    public static function load(
        $path = null,
        $loadGetenv = true,
        $loadEnv = true,
        $loadServer = true,
        $loadConstant = true
    ) {
        // Get .env variables
        $vars = self::getFile($path);

        // Save values into the wished variables / functions
        foreach ($vars as $key => $value) {
            ($loadGetenv ? self::loadGetenv($key, $value) : null);
            ($loadEnv ? self::loadEnv($key, $value) : null);
            ($loadServer ? self::loadServer($key, $value) : null);
            ($loadConstant ? self::loadConstant($key, $value) : null);
        }
    }

    /**
     * Load variable into a constant
     *
     * @param string $name Variable name
     * @param string $value Variable value
     */
    private static function loadConstant($name, $value)
    {
        define($name, $value);
    }

    /**
     * Load variable into $_ENV
     *
     * @param string $name Variable name
     * @param string $value Variable value
     */
    private static function loadEnv($name, $value)
    {
        $_ENV[$name] = $value;
    }

    /**
     * Load variable into getenv()
     *
     * @param string $name Variable name
     * @param string $value Variable value
     */
    private static function loadGetenv($name, $value)
    {
        putenv($name . '=' . $value);
    }

    /**
     * Load variable into $_SERVER
     *
     * @param string $name Variable name
     * @param string $value Variable value
     */
    private static function loadServer($name, $value)
    {
        $_SERVER[$name] = $value;
    }
}
