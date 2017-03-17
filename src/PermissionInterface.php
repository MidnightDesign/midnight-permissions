<?php declare(strict_types = 1);

namespace Midnight\Permissions;

interface PermissionInterface
{
    /**
     * @param mixed|null $user
     * @param mixed|null $resource
     */
    public function isAllowed($user = null, $resource = null): bool;
}
