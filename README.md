# Flysystem Extras 

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/sfcod/filesystem/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/sfcod/filesystem/?branch=master)[![Code Climate](https://codeclimate.com/github/sfcod/filesystem/badges/gpa.svg)](https://codeclimate.com/github/sfcod/filesystem)

Provides extras functionality around Flysystem like Resolvable filesystem.

### Resolvable filesystem

`ResolvableFilesystem` is a decorator permitting to resolve objects paths into URLs.

In order to use it, you have to pass the decorated Filesystem and a Resolver:

    use SfCod\Filesystem\Resolvable\ResolvableFilesystem;
    use SfCod\Filesystem\Resolvable\Resolver\LocalUrlResolver;
    use League\Flysystem\Filesystem;
    use League\Flysystem\Adapter\Local;   
    
    $adapter = new Local(__DIR__.'/path/to/root');
    $filesystem = new ResolvableFilesystem(
        new Filesystem($adapter),
        new LocalUrlResolver()
    );

Then you can call `resolve($key)`:

    $filesystem->resolve('/foo.png'); // = 'https://...

Currently these resolvers are supported:

* LocalUrlResolver