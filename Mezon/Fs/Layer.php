<?php
namespace Mezon\Fs;

use Mezon\Conf\Conf;

class Layer
{

    // TODO collapse $filePaths, $fileData, $fileFlags in one array like $createdDirectories, this
    // will make class interface more short and simple - one public method instead of 3 public fields
    /**
     * Paths to the saved filed.
     * Filled only if the Conf::getConfigValue('fs/layer', 'real') !== 'real'
     *
     * @var string[]
     */
    public static $filePaths = [];

    /**
     * Saved data.
     * Filled only if the Conf::getConfigValue('fs/layer', 'real') !== 'real'
     *
     * @var string[]
     */
    public static $fileData = [];

    /**
     * Flags
     *
     * @var int[]
     */
    public static $fileFlags = [];

    /**
     * Saving data on the disc
     *
     * @param string $path
     *            path to the file
     * @param string $data
     *            saving data
     * @param int $flags
     *            flags
     * @return int result
     */
    public static function filePutContents(string $path, string $data, int $flags = 0): int
    {
        if (Conf::getConfigValue('fs/layer', 'real') === 'real') {
            // @codeCoverageIgnoreStart
            return file_put_contents($path, $data, $flags);
            // @codeCoverageIgnoreEnd
        } else {
            self::$filePaths[] = $path;
            self::$fileData[] = $data;
            self::$fileFlags[] = $flags;

            return 1;
        }
    }

    /**
     * List of the created directories.
     * Filled only if the Conf::getConfigValue('fs/layer', 'real') !== 'real'
     *
     * @var array[]
     */
    private static $createdDirectories = [];

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
     * @param string $path
     *            path to the file
     * @param int $mode
     *            access setting to the creating directory
     * @param bool $recursive
     *            use recursive directories
     * @return bool true on success, false on error
     */
    public static function createDirectory(string $path, int $mode = 0777, bool $recursive = false): bool
    {
        if (Conf::getConfigValue('fs/layer', 'real') === 'real') {
            // @codeCoverageIgnoreStart
            return mkdir($path, $mode, $recursive);
            // @codeCoverageIgnoreEnd
        } else {
            self::$createdDirectories[] = [
                'path' => $path,
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
        if (Conf::getConfigValue('fs/layer', 'real') === 'real') {
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
     * Method returns file content
     *
     * @var array<string, string|bool>
     */
    public static $fileGetContentsData = [];

    /**
     * Reading file from disc
     *
     * @param string $filePath
     *            path to the file to be read
     * @return string|boolean read data or false in case of error
     */
    public static function fileGetContents(string $filePath)
    {
        if (Conf::getConfigValue('fs/layer', 'real') === 'real') {
            // @codeCoverageIgnoreStart
            return @file_get_contents($filePath);
            // @codeCoverageIgnoreEnd
        } else {
            return self::$fileGetContentsData[$filePath];
        }
    }
}
