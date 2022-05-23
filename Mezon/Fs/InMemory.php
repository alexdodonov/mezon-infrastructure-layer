<?php
namespace Mezon\Fs;

/**
 * Configuration routines
 *
 * @package InfrastructureLayer
 * @subpackage InMemory
 * @author Dodonov A.A.
 * @version v.1.0 (2021/11/13)
 * @copyright Copyright (c) 2021, http://aeon.su
 */
class InMemory
{

    /**
     * In memory FS
     *
     * @var array<string, string>
     */
    private static $fs = [];

    /**
     * Reading file from disc
     *
     * @param string $filePath
     *            path to the file to be read
     * @return string|boolean read data or false in case of error
     */
    public static function fileGetContents(string $filePath)
    {
        if (static::fileExists($filePath)) {
            return static::$fs[$filePath];
        } else {
            return false;
        }
    }

    /**
     * Reading file from disc
     *
     * @param string $filePath
     *            path to the file to be read
     * @return string read data or false in case of error
     */
    public static function existingFileGetContents(string $filePath): string
    {
        if (static::fileExists($filePath)) {
            return static::$fs[$filePath];
        } else {
            throw (new \Exception('File ' . $filePath . ' does not exists', - 1));
        }
    }

    /**
     * Method clears file system
     */
    public static function clearFs(): void
    {
        static::$fs = [];
    }

    /**
     * Saving data file
     *
     * @param string $filePath
     *            path to the file
     * @param string $data
     *            saving data
     * @param int $flags
     *            flags
     * @return int result
     */
    public static function filePutContents(string $filePath, string $data, int $flags = 0): int
    {
        if ($flags < 0) {
            throw (new \Exception('Undefined flags : ' . $flags, - 1));
        } elseif ($flags & FILE_APPEND) {
            if (! static::fileExists($filePath)) {
                static::$fs[$filePath] = '';
            }

            static::$fs[$filePath] .= $data;
        } elseif ($flags === 0) {
            static::$fs[$filePath] = $data;
        } else {
            throw (new \Exception('Undefined flags : ' . $flags, - 1));
        }

        return strlen($data);
    }

    /**
     * Method preloads real file into in memory FS
     *
     * @param string $filePath
     *            path to the loading file
     */
    public static function preloadFile(string $filePath): void
    {
        if (file_exists($filePath)) {
            static::filePutContents($filePath, file_get_contents($filePath));
        } else {
            throw (new \Exception('File ' . $filePath . ' was not found', - 1));
        }
    }

    /**
     * Checking that the file exist
     *
     * @param string $filePath
     *            path to the checking file
     * @return bool true if the file esxists, false otherwise
     */
    public static function fileExists(string $filePath): bool
    {
        return isset(static::$fs[$filePath]);
    }
}
