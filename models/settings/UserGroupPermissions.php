<?php

declare(strict_types=1);

namespace app\models\settings;

use app\models\db\Consultation;
use app\models\db\ConsultationUserGroup;

class UserGroupPermissions
{
    public const PERMISSION_PROPOSED_PROCEDURE = 'proposed-procedure';
    public const PERMISSION_ADMIN_ALL = 'admin-all';
    public const PERMISSION_ADMIN_SPEECH_LIST = 'admin-speech-list';

    private bool $isSiteWide;

    /** @var string[]|null */
    private ?array $defaultPermissions = null;

    /**
     * Hint: detailed privileges can only be granted on consultation level, not site-wide
     *
     * @var UserGroupPermissionEntry[]|null
     */
    private ?array $privileges = null;

    public function __construct(bool $isSiteWide)
    {
        $this->isSiteWide = $isSiteWide;
    }

    public static function fromDatabaseString(?string $str, bool $isSiteWide): self
    {
        if ($str === null) {
            return new self($isSiteWide);
        }

        if (strpos($str, '{') === 0) {
            return self::fromJsonDatabaseString($str, $isSiteWide);
        } else {
            return self::fromLegacyDatabaseString($str, $isSiteWide);
        }
    }

    public static function fromJsonDatabaseString(?string $str, bool $isSiteWide): self
    {
        $permissions = new self($isSiteWide);
        $data = json_decode($str, true, 512, JSON_THROW_ON_ERROR);

        if (isset($data['default_permissions'])) {
            $permissions->defaultPermissions = $data['default_permissions'];
        }

        if (isset($data['privileges'])) {
            $permissions->privileges = array_map(function (array $arr): UserGroupPermissionEntry {
                return UserGroupPermissionEntry::fromArray($arr);
            }, $data['privileges']);
        }

        return $permissions;
    }

    public static function fromLegacyDatabaseString(?string $str, bool $isSiteWide): self
    {
        $permissions = new self($isSiteWide);
        $permissions->defaultPermissions = $str ? explode(',', $str) : null;

        return $permissions;
    }

    public function toDatabaseString(): ?string
    {
        if ($this->defaultPermissions) {
            return json_encode([
                'default_permissions' => $this->defaultPermissions,
            ], JSON_THROW_ON_ERROR);
        }

        if ($this->privileges) {
            return json_encode([
                'privileges' => array_map(function (UserGroupPermissionEntry $entry): array {
                    return $entry->toArray();
                }, $this->privileges),
            ], JSON_THROW_ON_ERROR);
        }

        return null;
    }

    public function toApi(?Consultation $consultation): array
    {
        $apiPrivileges = null;
        if ($this->privileges && $consultation) {
            $apiPrivileges = array_map(function (UserGroupPermissionEntry $arr) use ($consultation): array {
                return $arr->toApi($consultation);
            }, $this->privileges);
        }

        return [
            'default_permissions' => $this->defaultPermissions,
            'privileges' => $apiPrivileges,
        ];
    }

    public function containsPrivilege(int $privilege): bool
    {
        if (!$this->defaultPermissions) {
            return false;
        }

        switch ($privilege) {
            // Special case "any": everyone having any kind of special privilege
            case ConsultationUserGroup::PRIVILEGE_ANY:
                return in_array(static::PERMISSION_PROPOSED_PROCEDURE, $this->defaultPermissions, true) ||
                    in_array(static::PERMISSION_ADMIN_ALL, $this->defaultPermissions, true) ||
                    in_array(static::PERMISSION_ADMIN_SPEECH_LIST, $this->defaultPermissions, true);

            // Special case "site admin": has all permissions - for all consultations
            case ConsultationUserGroup::PRIVILEGE_SITE_ADMIN:
                return in_array(static::PERMISSION_ADMIN_ALL, $this->defaultPermissions, true) && $this->isSiteWide;

            // Regular cases
            case ConsultationUserGroup::PRIVILEGE_CONSULTATION_SETTINGS:
            case ConsultationUserGroup::PRIVILEGE_CONTENT_EDIT:
            case ConsultationUserGroup::PRIVILEGE_SCREENING:
            case ConsultationUserGroup::PRIVILEGE_MOTION_STATUS_EDIT:
            case ConsultationUserGroup::PRIVILEGE_MOTION_TEXT_EDIT:
            case ConsultationUserGroup::PRIVILEGE_CREATE_MOTIONS_FOR_OTHERS:
            case ConsultationUserGroup::PRIVILEGE_VOTINGS:
                return in_array(static::PERMISSION_ADMIN_ALL, $this->defaultPermissions, true);
            case ConsultationUserGroup::PRIVILEGE_CHANGE_PROPOSALS:
                return in_array(static::PERMISSION_PROPOSED_PROCEDURE, $this->defaultPermissions, true) ||
                    in_array(static::PERMISSION_ADMIN_ALL, $this->defaultPermissions, true);
            case ConsultationUserGroup::PRIVILEGE_SPEECH_QUEUES:
                return in_array(static::PERMISSION_ADMIN_SPEECH_LIST, $this->defaultPermissions, true) ||
                    in_array(static::PERMISSION_ADMIN_ALL, $this->defaultPermissions, true);
            case ConsultationUserGroup::PRIVILEGE_GLOBAL_USER_ADMIN: // only superadmins are allowed to
            default:
                return false;
        }
    }
}
