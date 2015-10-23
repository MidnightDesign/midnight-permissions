<?php

namespace Midnight\Permissions;

use Interop\Container\ContainerInterface;
use Midnight\Permissions\Exception\InvalidPermissionException;
use Midnight\Permissions\Exception\UnknownPermissionException;

/**
 * Class PermissionService
 * @package Midnight\Permissions
 */
class PermissionService implements PermissionServiceInterface
{
    /** @var ContainerInterface */
    private $container;

    /**
     * PermissionService constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @param mixed|null $user
     * @param string $permission
     * @param mixed|null $resource
     * @return bool
     */
    public function isAllowed($user = null, $permission, $resource = null)
    {
        if (!$this->container->has($permission)) {
            throw new UnknownPermissionException(sprintf('Unknown permission %s.', $permission));
        }
        $permissionObject = $this->container->get($permission);
        if (!$permissionObject instanceof PermissionInterface) {
            throw new InvalidPermissionException(sprintf(
                '"%s" is not a permission. Expected an instance of %s, but got %s.',
                $permission,
                PermissionInterface::class,
                is_object($permissionObject) ? get_class($permissionObject) : gettype($permissionObject)
            ));
        }
        return $permissionObject->isAllowed($user, $resource);
    }
}
