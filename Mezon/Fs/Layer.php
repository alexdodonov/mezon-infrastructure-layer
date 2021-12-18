<?php
namespace Mezon\Fs;

use Mezon\Conf\Conf;

/**
 * Configuration routines
 *
 * @package InfrastructureLayer
 * @subpackage Fs
 * @author Dodonov A.A.
 * @version v.1.0 (2021/11/13)
 * @copyright Copyright (c) 2021, aeon.org
 */

class Layer
{

    /**
     * Saving data on the disc
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
        if (Conf::getConfigValueAsString('fs/layer', 'real') === 'real') {
            // @codeCoverageIgnoreStart
            return file_put_contents($filePath, $data, $flags);
            // @codeCoverageIgnoreEnd
        } else {
            return InMemory::filePutContents($filePath, $data, $flags);
        }
    }

    /**
     * List of the created directories.
     * Filled only if the Conf::getConfigValueAsString('fs/layer', 'real') !== 'real'
     *
     * @var array[]
     */
    public static $createdDirectories = [];

    /**
     * Checking if the directory exists
     *
     * @param string $dirPath
     *            path to the checking directory
     * @return bool true if the directory exists, false otherwise
     */
    public static function directoryExists(string $dirPath): bool
    {
        if (Conf::getConfigValueAsString('fs/layer', 'real') === 'real') {
            // @codeCoverageIgnoreStart
            return file_exists($dirPath);
            // @codeCoverageIgnoreEnd
        } else {
            foreach (self::$createdDirectories as $item) {
                if ($item['path'] === $dirPath) {
                    return true;
                }
            }

            return false;
        }
    }

    /**
     * Method clears info about the created directories
     */
    public static function clearCreatedDirectoriesInfo(): void
    {
        self::$createdDirectories = [];
    }

    /**
     * Method returns data from the self::$createdDirectories array
     *
     * @param int $i
     *            key of the element
     * @return array created directoru info
     */
    public static function getCreatedDirectoryInfo(int $i): array
    {
        if (isset(self::$createdDirectories[$i])) {
            return self::$createdDirectories[$i];
        } else {
            throw (new \Exception('Element with key ' . $i . ' was not found', - 1));
        }
    }

    /**
     * Creating folders on the disc
     *
     * @param string $filePath
     *            path to the file
     * @param int $mode
     *            access setting to the creating directory
     * @param bool $recursive
     *            use recursive directories
     * @return bool true on success, false on error
     */
    public static function createDirectory(string $filePath, int $mode = 0777, bool $recursive = false): bool
    {
        if (Conf::getConfigValueAsString('fs/layer', 'real') === 'real') {
            // @codeCoverageIgnoreStart
            return mkdir($filePath, $mode, $recursive);
            // @codeCoverageIgnoreEnd
        } else {
            self::$createdDirectories[] = [
                'path' => $filePath,
                'mode' => $mode,
                'recursive' => $recursive
            ];

            return true;
        }
    }

    /**
     * Returns for fileExists method
     *
     * @var bool[]
     */
    public static $fileExisting = [];

    /**
     * Checking if the file exists
     *
     * @param string $filePath
     *            path to the checking file
     * @return bool true if the file exists, false otherwise
     */
    public static function fileExists(string $filePath): bool
    {
        if (Conf::getConfigValueAsString('fs/layer', 'real') === 'real') {
            // @codeCoverageIgnoreStart
            return file_exists($filePath);
            // @codeCoverageIgnoreEnd
        } else {
            self::$fileExisting = array_reverse(self::$fileExisting);

            $result = array_pop(self::$fileExisting);

            self::$fileExisting = array_reverse(self::$fileExisting);

            return $result;
        }
    }

    /**
     * Reading file from disc
     *
     * @param string $filePath
     *            path to the file to be read
     * @return string|boolean read data or false in case of error
     */
    public static function fileGetContents(string $filePath)
    {
        if (Conf::getConfigValueAsString('fs/layer', 'real') === 'real') {
            // @codeCoverageIgnoreStart
            return @file_get_contents($filePath);
            // @codeCoverageIgnoreEnd
        } else {
            return InMemory::fileGetContents($filePath);
        }
    }
}
