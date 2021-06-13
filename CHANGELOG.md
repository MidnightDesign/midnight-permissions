# Changelog

All notable changes to this project will be documented in this file, in reverse chronological order by release.

## 2.0.0 - 2021-06-13

### BC Breaks

- PHP 8.0 deprecates required parameters after optional parameters and to avoid a deprecation notice in PHP 8, the
  signature of `PermissionServiceInterface` had to be changed to
  `public function isAllowed($user, string $permission, $resource = null): bool`
  Also, a return type was added.
- Return type added to `PermissionInterface`

### Added

- [#5](https://github.com/MidnightDesign/midnight-permissions/pull/5) adds support for PHP 8

### Changed

- [#5](https://github.com/MidnightDesign/midnight-permissions/pull/5) changes method signature
  of `PermissionServiceInterface`
- [#5](https://github.com/MidnightDesign/midnight-permissions/pull/5) adds a return type to `PermissionInterface`

### Deprecated

- Nothing.

### Removed

- Nothing.

### Fixed

- Nothing.

## 1.2.0 - 2020-12-05

### Added

- Nothing.

### Changed

- [#4](https://github.com/MidnightDesign/midnight-permissions/pull/4) changes minimum PHP version to 7.4
- [#4](https://github.com/MidnightDesign/midnight-permissions/pull/4) changes Container to
  `\Psr\Container\ContainerInterface` in `\Midnight\Permissions\PermissionService`

### Deprecated

- Nothing.

### Removed

- Nothing.

### Fixed

- Nothing.
