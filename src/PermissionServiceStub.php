<?php

declare(strict_types=1);

namespace Midnight\Permissions;

final class PermissionServiceStub implements PermissionServiceInterface
{
    private bool $isAllowed = true;

    /**
     * @param mixed|null $user
     * @param mixed|null $resource
     */
    public function isAllowed($user, string $permission, $resource = null): bool
    {
        return $this->isAllowed;
    }

    public function setIsAllowed(bool $isAllowed): void
    {
        $this->isAllowed = $isAllowed;
    }
}
