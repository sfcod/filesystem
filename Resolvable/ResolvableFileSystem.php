<?php

namespace SfCod\Filesystem\Resolvable;

use League\Flysystem\FileExistsException;
use League\Flysystem\FileNotFoundException;
use League\Flysystem\FilesystemInterface;
use League\Flysystem\Handler;
use League\Flysystem\PluginInterface;
use League\Flysystem\RootViolationException;

/**
 * Class ResolvableFileSystem
 *
 * @author Virchenko Maksim <muslim1992@gmail.com>
 *
 * @package SfCod\Filesystem\Resolvable
 */
class ResolvableFileSystem implements FilesystemInterface, ResolverInterface
{
    /**
     * @var FilesystemInterface
     * */
    private $filesystem;

    /**
     * @var ResolverInterface
     */
    private $resolver;

    /**
     * ResolvableFileSystem constructor.
     *
     * @param FilesystemInterface $filesystem
     * @param ResolverInterface $resolver
     */
    public function __construct(FilesystemInterface $filesystem, ResolverInterface $resolver)
    {
        $this->filesystem = $filesystem;
        $this->resolver = $resolver;
    }

    /**
     * Resolves an object path to an URI.
     *
     * @param string $path Object path
     *
     * @return string
     */
    public function resolve(string $path): string
    {
        return $this->resolver->resolve($path);
    }

    /**
     * Check whether a file exists.
     *
     * @param string $path
     *
     * @return bool
     */
    public function has($path)
    {
        return $this->filesystem->has($path);
    }

    /**
     * Read a file.
     *
     * @param string $path the path to the file
     *
     * @throws FileNotFoundException
     *
     * @return string|false the file contents or false on failure
     */
    public function read($path)
    {
        return $this->filesystem->read($path);
    }

    /**
     * Retrieves a read-stream for a path.
     *
     * @param string $path the path to the file
     *
     * @throws FileNotFoundException
     *
     * @return resource|false the path resource or false on failure
     */
    public function readStream($path)
    {
        return $this->filesystem->readStream($path);
    }

    /**
     * List contents of a directory.
     *
     * @param string $directory the directory to list
     * @param bool $recursive whether to list recursively
     *
     * @return array a list of file metadata
     */
    public function listContents($directory = '', $recursive = false)
    {
        return $this->filesystem->listContents($directory, $recursive);
    }

    /**
     * Get a file's metadata.
     *
     * @param string $path the path to the file
     *
     * @throws FileNotFoundException
     *
     * @return array|false the file metadata or false on failure
     */
    public function getMetadata($path)
    {
        return $this->filesystem->getMetadata($path);
    }

    /**
     * Get a file's size.
     *
     * @param string $path the path to the file
     *
     * @return int|false the file size or false on failure
     */
    public function getSize($path)
    {
        return $this->filesystem->getSize($path);
    }

    /**
     * Get a file's mime-type.
     *
     * @param string $path the path to the file
     *
     * @throws FileNotFoundException
     *
     * @return string|false the file mime-type or false on failure
     */
    public function getMimetype($path)
    {
        return $this->filesystem->getMimetype($path);
    }

    /**
     * Get a file's timestamp.
     *
     * @param string $path the path to the file
     *
     * @throws FileNotFoundException
     *
     * @return string|false the timestamp or false on failure
     */
    public function getTimestamp($path)
    {
        return $this->filesystem->getTimestamp($path);
    }

    /**
     * Get a file's visibility.
     *
     * @param string $path the path to the file
     *
     * @throws FileNotFoundException
     *
     * @return string|false the visibility (public|private) or false on failure
     */
    public function getVisibility($path)
    {
        return $this->filesystem->getVisibility($path);
    }

    /**
     * Write a new file.
     *
     * @param string $path the path of the new file
     * @param string $contents the file contents
     * @param array $config an optional configuration array
     *
     * @throws FileExistsException
     *
     * @return bool true on success, false on failure
     */
    public function write($path, $contents, array $config = [])
    {
        return $this->filesystem->write($path, $contents, $config);
    }

    /**
     * Write a new file using a stream.
     *
     * @param string $path the path of the new file
     * @param resource $resource the file handle
     * @param array $config an optional configuration array
     *
     * @throws \InvalidArgumentException if $resource is not a file handle
     * @throws FileExistsException
     *
     * @return bool true on success, false on failure
     */
    public function writeStream($path, $resource, array $config = [])
    {
        return $this->filesystem->writeStream($path, $resource, $config);
    }

    /**
     * Update an existing file.
     *
     * @param string $path the path of the existing file
     * @param string $contents the file contents
     * @param array $config an optional configuration array
     *
     * @throws FileNotFoundException
     *
     * @return bool true on success, false on failure
     */
    public function update($path, $contents, array $config = [])
    {
        return $this->filesystem->update($path, $contents, $config);
    }

    /**
     * Update an existing file using a stream.
     *
     * @param string $path the path of the existing file
     * @param resource $resource the file handle
     * @param array $config an optional configuration array
     *
     * @throws \InvalidArgumentException if $resource is not a file handle
     * @throws FileNotFoundException
     *
     * @return bool true on success, false on failure
     */
    public function updateStream($path, $resource, array $config = [])
    {
        return $this->filesystem->updateStream($path, $resource, $config);
    }

    /**
     * Rename a file.
     *
     * @param string $path path to the existing file
     * @param string $newpath the new path of the file
     *
     * @throws FileExistsException   thrown if $newpath exists
     * @throws FileNotFoundException thrown if $path does not exist
     *
     * @return bool true on success, false on failure
     */
    public function rename($path, $newpath)
    {
        return $this->filesystem->rename($path, $newpath);
    }

    /**
     * Copy a file.
     *
     * @param string $path path to the existing file
     * @param string $newpath the new path of the file
     *
     * @throws FileExistsException   thrown if $newpath exists
     * @throws FileNotFoundException thrown if $path does not exist
     *
     * @return bool true on success, false on failure
     */
    public function copy($path, $newpath)
    {
        return $this->filesystem->copy($path, $newpath);
    }

    /**
     * Delete a file.
     *
     * @param string $path
     *
     * @throws FileNotFoundException
     *
     * @return bool true on success, false on failure
     */
    public function delete($path)
    {
        return $this->filesystem->delete($path);
    }

    /**
     * Delete a directory.
     *
     * @param string $dirname
     *
     * @throws RootViolationException thrown if $dirname is empty
     *
     * @return bool true on success, false on failure
     */
    public function deleteDir($dirname)
    {
        return $this->filesystem->deleteDir($dirname);
    }

    /**
     * Create a directory.
     *
     * @param string $dirname the name of the new directory
     * @param array $config an optional configuration array
     *
     * @return bool true on success, false on failure
     */
    public function createDir($dirname, array $config = [])
    {
        return $this->filesystem->createDir($dirname, $config);
    }

    /**
     * Set the visibility for a file.
     *
     * @param string $path the path to the file
     * @param string $visibility one of 'public' or 'private'
     *
     * @return bool true on success, false on failure
     */
    public function setVisibility($path, $visibility)
    {
        return $this->filesystem->setVisibility($path, $visibility);
    }

    /**
     * Create a file or update if exists.
     *
     * @param string $path the path to the file
     * @param string $contents the file contents
     * @param array $config an optional configuration array
     *
     * @return bool true on success, false on failure
     */
    public function put($path, $contents, array $config = [])
    {
        return $this->filesystem->put($path, $contents, $config);
    }

    /**
     * Create a file or update if exists.
     *
     * @param string $path the path to the file
     * @param resource $resource the file handle
     * @param array $config an optional configuration array
     *
     * @throws \InvalidArgumentException thrown if $resource is not a resource
     *
     * @return bool true on success, false on failure
     */
    public function putStream($path, $resource, array $config = [])
    {
        return $this->filesystem->putStream($path, $resource, $config);
    }

    /**
     * Read and delete a file.
     *
     * @param string $path the path to the file
     *
     * @throws FileNotFoundException
     *
     * @return string|false the file contents, or false on failure
     */
    public function readAndDelete($path)
    {
        return $this->filesystem->readAndDelete($path);
    }

    /**
     * Get a file/directory handler.
     *
     * @param string $path the path to the file
     * @param Handler $handler an optional existing handler to populate
     *
     * @return Handler either a file or directory handler
     */
    public function get($path, Handler $handler = null)
    {
        return $this->filesystem->get($path, $handler);
    }

    /**
     * Register a plugin.
     *
     * @param PluginInterface $plugin the plugin to register
     *
     * @return $this
     */
    public function addPlugin(PluginInterface $plugin)
    {
        $this->filesystem->addPlugin($plugin);

        return $this;
    }
}
