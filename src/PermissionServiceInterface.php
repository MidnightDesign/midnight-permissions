<?php declare(strict_types = 1);

namespace Midnight\Permissions;

interface PermissionServiceInterface
{
    /**
     * @param mixed|null $user
     * @param mixed|null $resource
     */
    public function isAllowed($user = null, string $permission, $resource = null);
}
