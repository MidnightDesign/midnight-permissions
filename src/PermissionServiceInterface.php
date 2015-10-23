<?php

namespace Midnight\Permissions;

/**
 * Interface PermissionServiceInterface
 * @package Midnight\Permissions
 */
interface PermissionServiceInterface
{
    /**
     * @param mixed|null $user
     * @param string $permission
     * @param mixed|null $resource
     */
    public function isAllowed($user = null, $permission, $resource = null);
}
