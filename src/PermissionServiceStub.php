<?php declare(strict_types = 1);

namespace Midnight\Permissions;

final class PermissionServiceStub implements PermissionServiceInterface
{
    /** @var bool */
    private $isAllowed = true;

    public function isAllowed($user = null, string $permission, $resource = null)
    {
        return $this->isAllowed;
    }

    public function setIsAllowed(bool $isAllowed): void
    {
        $this->isAllowed = $isAllowed;
    }
}
