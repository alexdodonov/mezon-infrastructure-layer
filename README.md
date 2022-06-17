## Infrastructure Layer

### Intro

This class provides abstractions from basic infrastructure things wich can make you unit-testing harder. For example:

- console output
- file system operations
- GD library
- HTTP headers
- redirections
- sessions
- system methods

## Basic concepts

Each abstraction can be setup to use either native function calls (such as file_get_contents) or mockups.

Mockuped calls can be used in your unit-tests. And native calls will be executed in production.

Let's see some real code examples:

```php
// here we setup mock calls
\Mezon\Conf\Conf::setConfigStringValue('fs/layer', 'mock');

// here we setup that mock will return true if the we check that this directory exists
\Mezon\Fs\Layer::$createdDirectories[] = [
	'path' => 'path-to-existing-directory'
];

// here we will get true
var_dump(\Mezon\Fs\Layer::directoryExists('path-to-existing-directory'));

// and here we will get false
var_dump(\Mezon\Fs\Layer::directoryExists('path-to-unexisting-directory'));
```

In both calls `Mezon\Fs\Layer::directoryExists` no real call of method `file_exists` was performed.

No let's see what abstractions we have

## Console layer

Class `Mezon\Console\Layer` provides abstractions for working winth console

```php
// here we setup mock calls
Conf::setConfigStringValue('console/layer', 'mock');

// setup values wich will be returned by the method Mezon\Console\Layer::readline()
\Mezon\Console\Layer::$readlines[] = 'line 1';
\Mezon\Console\Layer::$readlines[] = 'line 2';

// read lines
// note that native php method `readline` will noe be called
// just returning value of the Mezon\Console\Layer::$readlines array
echo \Mezon\Console\Layer::readline(); // ouputs 'line 1'
echo \Mezon\Console\Layer::readline(); // ouputs 'line 2'

// here we setup native php methods calls
Conf::setConfigStringValue('console/layer', 'real');
echo \Mezon\Console\Layer::readline(); // outputs string wich you will input in the console
// because in this line real method `readline` will be called
```

## File system layer

This package also have abstractions for file systems routine:

```php
// here we setup mock calls
Conf::setConfigStringValue('fs/layer', 'mock');

// writing file
\Mezon\Fs\Layer::filePutContents('file-path', 'data', FILE_APPEND);
// ^^^ but in this call all file content will be stored into memory, not on disk
// on production this call works like file_put_contents

// creating directory
\Mezon\Fs\Layer::createDirectory('new-dir');
// ^^^ real directory also is not created

// checking if the directory exists
echo \Mezon\Fs\Layer::directoryExists('new-dir'); // we shall see 'true', because we have called \Mezon\Fs\Layer::createDirectory('new-dir');
echo \Mezon\Fs\Layer::directoryExists('unexisting-dir'); // we shall see 'false'

// checking if the file exists
echo \Mezon\Fs\Layer::fileExists('file-path'); // we shall see 'true', because we have called \Mezon\Fs\Layer::filePutContents('file-path', 'data', FILE_APPEND)
echo \Mezon\Fs\Layer::fileExists('unexisting-file-path'); // we shall see 'false'

// getting file contents
echo \Mezon\Fs\Layer::fileGutContents('file-path'); // we shall see 'data', because we have already called \Mezon\Fs\Layer::filePutContents('file-path', 'data', FILE_APPEND)
echo \Mezon\Fs\Layer::fileGutContents('unexisting-file-path'); // we shall see 'false'
```

## In-memory file system

Almost all methods from `\Mezon\Fs\Layer` in mock mode use `\Mezon\Fs\InMemory`.

```php
// writing data in memory file system
\Mezon\Fs\InMemory::filePutContents('file-path', 'data');

// reading data from inmemory file system
echo \Mezon\Fs\InMemory::fileGetContents('file-path');

// checking that file esists
echo \Mezon\Fs\InMemory::fileExists('file-path'); // outputs 'true'
echo \Mezon\Fs\InMemory::fileExists('unexisting-file'); // outputs 'false'

// preload file in FS
// this method reads real file from your FS and uploads it into inmemory FS
\Mezon\Fs\InMemory::preloadFile('real-file-path');
```

## GD mocks

We also have mocks for some GD functions. Basically for those ones wich work with file system.

```php
Conf::setConfigStringValue('gd/layer', 'mock');
// here we are trying to get file with this path from \Mezon\FS\InMemory
var_dump(\Mezon\GD\Layer::getImageSize('path-to-image'));

// reading image from file
$resource = \Mezon\GD\Layer::imageCreateFromBmp('path-to-image-file');
$resource = \Mezon\GD\Layer::imageCreateFromGif('path-to-image-file');
$resource = \Mezon\GD\Layer::imageCreateFromJpeg('path-to-image-file');
$resource = \Mezon\GD\Layer::imageCreateFromPng('path-to-image-file');
$resource = \Mezon\GD\Layer::imageCreateFromWebp('path-to-image-file');

// store images into file. In mock mode all data is stored into in-memory FS - \Mezon\FS\InMemory
\Mezon\GD\Layer::imageBmp($resource, 'path-to-file');
\Mezon\GD\Layer::imageGif($resource, 'path-to-file');
\Mezon\GD\Layer::imageJpeg($resource, 'path-to-file');
\Mezon\GD\Layer::imagePng($resource, 'path-to-file');
\Mezon\GD\Layer::imageWebp($resource, 'path-to-file');
```

## HTTP headers mocks

You can work with headers. Two methods for these purposes are provided:

```php
Conf::setConfigStringValue('headers/layer', 'mock');

// setting headers wich will be returned by the mock
\Mezon\Headers\Layer::setAllHeaders([
	'Header Name' => 'Header Value'
]);

// in mock mode this method will return data wich was set by \Mezon\Headers\Layer::setAllHeaders
// in real mode - th resul of the method \getallheaders will be returned
var_dump(\Mezon\Headers\Layer::getAllHeaders());
```

## Redirection mocks

You can mock redirects:

```php
Conf::setConfigStringValue('redirect/layer', 'mock');

// in real mode this call method header('Location: ...') will be called
// in mock mode no redirection will be performed and redirect URL will be stored
// in the \Mezon\Redirect\Layer::$lastRedirectionUrl
// and \Mezon\Redirect\Layer::$redirectWasPerformed will be set to 'true'
\Mezon\Redirect\Layer::redirectTo('./url');
```

## Session mocks

You can also mock session methods:

```php
Conf::setConfigStringValue('session/layer', 'mock');

// method returns 'session-name' if it is used as mock mode
// and return result of session_name() if it is used in real model
\Mezon\Session\Layer::sessionName();

// setting cookie 
\Mezon\Session\Layer::setCookie(
        string $name,
        string $value = "",
        int $expires = 0,
        string $path = "",
        string $domain = "",
        bool $secure = false,
        bool $httponly = false);

// getting session id or setting it
\Mezon\Session\Layer::sessionId(string $id = ''): string;

// saving session data and closing session
\Mezon\Session\Layer::sessionWriteClose();
```

## System methods mocks

You can also mock some system methods calls. Like `die` for example:

```php
Conf::setConfigStringValue('system/layer', 'mock');

// in mock mode field $dieWasCalled will be set to 'true'
// in real mode built-in PHP method 'die' will be called
\Mezon\System\Layer::die();
```