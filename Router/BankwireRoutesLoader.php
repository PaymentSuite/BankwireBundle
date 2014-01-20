<?php

/**
 * BankwireBundle for Symfony2
 *
 * This Bundle is part of Symfony2 Payment Suite
 *
 * @author Marc Morera <yuhu@mmoreram.com>
 * @package BankwireBundle
 *
 * Marc Morera 2013
 */

namespace PaymentSuite\BankwireBundle\Router;

use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\Config\Loader\LoaderResolverInterface;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

/**
 * Bankwire router
 */
class BankwireRoutesLoader implements LoaderInterface
{

    /**
     * @var string
     *
     * Execution route name
     */
    const ROUTE_EXECUTE_NAME = 'bankwire_execute';


    /**
     * @var string
     *
     * Execution controller route
     */
    private $controllerExecuteRoute;


    /**
     * @var boolean
     *
     * Route is loaded
     */
    private $loaded = false;


    /**
     * Construct method
     *
     * @param string $controllerExecuteRoute Execution controller route
     */
    public function __construct($controllerExecuteRoute)
    {
        $this->controllerExecuteRoute = $controllerExecuteRoute;
    }


    /**
     * Loads a resource.
     *
     * @param mixed  $resource The resource
     * @param string $type     The resource type
     *
     * @return RouteCollection
     *
     * @throws RuntimeException Loader is added twice
     */
    public function load($resource, $type = null)
    {
        if ($this->loaded) {

            throw new \RuntimeException('Do not add this loader twice');
        }

        $routes = new RouteCollection();

        $routes->add(self::ROUTE_EXECUTE_NAME, new Route($this->controllerExecuteRoute, array(
            '_controller'   =>  'BankwireBundle:Bankwire:execute',
        )));

        $this->loaded = true;

        return $routes;
    }


    /**
     * Returns true if this class supports the given resource.
     *
     * @param mixed  $resource A resource
     * @param string $type     The resource type
     *
     * @return boolean true if this class supports the given resource, false otherwise
     */
    public function supports($resource, $type = null)
    {
        return 'bankwire' === $type;
    }


    /**
     * Gets the loader resolver.
     *
     * @return LoaderResolverInterface A LoaderResolverInterface instance
     */
    public function getResolver()
    {
    }


    /**
     * Sets the loader resolver.
     *
     * @param LoaderResolverInterface $resolver A LoaderResolverInterface instance
     */
    public function setResolver(LoaderResolverInterface $resolver)
    {
    }
}