<?php
namespace Mezon\Fs;

use Mezon\Conf\Conf;
use phpDocumentor\Reflection\File;

class Layer
{

    /**
     * Paths to the saved filed
     *
     * @var array
     */
    public static $filePaths = [];

    /**
     * Saved data
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
}
