<?php

namespace SfCod\Filesystem\Resolvable;

/**
 * Interface ResolverInterface
 *
 * @package SfCod\Filesystem\Resolvable
 */
interface ResolverInterface
{
    /**
     * Resolves an object path to an URI.
     *
     * @param string $path Object path
     *
     * @return string
     */
    public function resolve(string $path): string;
}
