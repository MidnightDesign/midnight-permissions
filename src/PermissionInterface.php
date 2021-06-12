<?php

declare(strict_types=1);

namespace Midnight\Permissions;

/**
 * @template TUser
 * @template TResource
 */
interface PermissionInterface
{
    /**
     * @param TUser|null $user
     * @param TResource|null $resource
     * @return bool
     */
    public function isAllowed($user = null, $resource = null);
}
