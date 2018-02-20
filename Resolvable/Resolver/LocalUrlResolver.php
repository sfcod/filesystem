<?php

namespace SfCod\Filesystem\Resolvable\Resolver;

use SfCod\Filesystem\Resolvable\ResolverInterface;

/**
 * Class LocalUrlResolver
 *
 * @author Virchenko Maksim <muslim1992@gmail.com>
 *
 * @package SfCod\Filesystem\Resolvable\Resolver
 */
class LocalUrlResolver implements ResolverInterface
{
    /**
     * Path prefix
     *
     * @var string
     */
    private $prefix;

    /**
     * LocalUrlResolver constructor.
     *
     * @param string $prefix
     */
    public function __construct(string $prefix = '/storage')
    {
        $this->prefix = $prefix;
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
        return rtrim($this->prefix, '/') . '/' . ltrim($path, '/');
    }
}
