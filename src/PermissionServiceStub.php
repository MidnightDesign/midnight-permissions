<?php

declare(strict_types=1);

namespace Midnight\Permissions;

/**
 * @implements PermissionServiceInterface<mixed, mixed>
 */
final class PermissionServiceStub implements PermissionServiceInterface
{
    private bool $isAllowed = true;

    /**
     * @phpstan-param mixed|null $user
     * @phpstan-param mixed|null $resource
     */
    public function isAllowed($user = null, string $permission, $resource = null): bool
    {
        return $this->isAllowed;
    }

    public function setIsAllowed(bool $isAllowed): void
    {
        $this->isAllowed = $isAllowed;
    }
}
