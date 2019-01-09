<?php

namespace SfCod\Filesystem\Resolvable\Resolver;

use SfCod\Filesystem\Resolvable\ResolverInterface;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Class RequestUrlResolver
 *
 * @author Virchenko Maksim <muslim1992@gmail.com>
 *
 * @package SfCod\Filesystem\Resolvable\Resolver
 */
class RequestUrlResolver implements ResolverInterface
{
    /**
     * @var RequestStack
     */
    private $requestStack;

    /**
     * RequestUrlResolver constructor.
     *
     * @param string $prefix
     */
    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
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
        if ($this->requestStack->getCurrentRequest()) {
            $request = $this->requestStack->getCurrentRequest();

            $baseUrl = rtrim(str_replace($request->getRequestUri(), '', $request->getUri()), '/');
        } else {
            $baseUrl = '';
        }

        return $baseUrl . '/' . ltrim($path, '/');
    }
}
