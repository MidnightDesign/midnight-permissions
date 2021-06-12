<?php

declare(strict_types=1);

namespace Midnight\Permissions;

use Midnight\Permissions\Exception\InvalidPermissionException;
use Midnight\Permissions\Exception\UnknownPermissionException;
use Psr\Container\ContainerInterface;

use function get_class;
use function gettype;
use function is_object;
use function sprintf;

/**
 * @template TUser
 * @template TResource
 * @implements PermissionServiceInterface<TUser, TResource>
 */
final class PermissionService implements PermissionServiceInterface
{
    private ContainerInterface $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @param TUser|null $user
     * @param TResource|null $resource
     * @throws UnknownPermissionException
     * @throws InvalidPermissionException
     */
    public function isAllowed($user = null, string $permission, $resource = null): bool
    {
        if (!$this->container->has($permission)) {
            throw new UnknownPermissionException(sprintf('Unknown permission %s.', $permission));
        }
        $permissionObject = $this->container->get($permission);
        if (!$permissionObject instanceof PermissionInterface) {
            throw new InvalidPermissionException(
                sprintf(
                    '"%s" is not a permission. Expected an instance of %s, but got %s.',
                    $permission,
                    PermissionInterface::class,
                    is_object($permissionObject) ? get_class($permissionObject) : gettype($permissionObject)
                )
            );
        }
        return $permissionObject->isAllowed($user, $resource);
    }
}
