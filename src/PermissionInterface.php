<?php

namespace Midnight\Permissions;

/**
 * Interface PermissionInterface
 * @package Midnight\Permissions
 */
interface PermissionInterface
{
    /**
     * @param mixed|null $user
     * @param mixed|null $resource
     * @return boolean
     */
    public function isAllowed($user = null, $resource = null);
}
