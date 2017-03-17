<?php declare(strict_types = 1);

namespace Midnight\Permissions;

use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Interop\Container\Exception\NotFoundException;
use Midnight\Permissions\Exception\InvalidPermissionException;
use Midnight\Permissions\Exception\UnknownPermissionException;

final class PermissionService implements PermissionServiceInterface
{
    /** @var ContainerInterface */
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @param mixed|null $user
     * @param mixed|null $resource
     * @throws UnknownPermissionException
     * @throws InvalidPermissionException
     * @throws ContainerException
     * @throws NotFoundException
     */
    public function isAllowed($user = null, string $permission, $resource = null): bool
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
