<?php
namespace Mezon\Fs;

use Mezon\Conf\Conf;

class Layer
{

    /**
     * Paths to the saved filed.
     * Filled only if the Conf::getConfigValue('fs/layer', 'real') !== 'real'
     *
     * @var array
     */
    public static $filePaths = [];

    /**
     * Saved data.
     * Filled only if the Conf::getConfigValue('fs/layer', 'real') !== 'real'
     *
     * @var array
     */
    public static $fileData = [];

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
            throw (new \Exception('Element with key ' . $i . 'was not found', - 1));
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
}
