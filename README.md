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
Mezon\Conf\Conf::setConfigValueAsString('fs/layer', 'mock');

// here we setup that mock will return true if the we check that this directory exists
Mezon\Fs\Layer::$createdDirectories[] = [
	'path' => 'path-to-existing-directory'
];

// here we will get true
var_dump(Mezon\Fs\Layer::directoryExists('path-to-existing-directory'));

// and here we will get false
var_dump(Mezon\Fs\Layer::directoryExists('path-to-unexisting-directory'));
```

In both calls `Mezon\Fs\Layer::directoryExists` ne real call