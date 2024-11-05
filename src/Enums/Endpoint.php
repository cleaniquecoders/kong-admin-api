<?php

namespace CleaniqueCoders\KongAdminApi\Enums;

use CleaniqueCoders\KongAdminApi\Contracts\Enum;

enum Endpoint: string implements Enum
{
    case SERVICES = 'services';
    case ROUTES = 'routes';
    case PLUGINS = 'plugins';
    case CONSUMERS = 'consumers';
    case CERTIFICATES = 'certificates';
    case SNIS = 'snis';
    case CA_CERTIFICATES = 'ca_certificates';
    case UPSTREAMS = 'upstreams';
    case VAULTS = 'vaults';
    case KEYS = 'keys';
    case KEY_SETS = 'key_sets';
    case INFORMATION = 'information';
    case DEBUG = 'debug';
    case TARGETS = 'targets';
    case TAGS = 'tags';

    public function label(): string
    {
        return match ($this) {
            self::SERVICES => 'Services',
            self::ROUTES => 'Routes',
            self::PLUGINS => 'Plugins',
            self::CONSUMERS => 'Consumers',
            self::CERTIFICATES => 'Certificates',
            self::SNIS => 'SNIs',
            self::CA_CERTIFICATES => 'CA Certificates',
            self::UPSTREAMS => 'Upstreams',
            self::VAULTS => 'Vaults',
            self::KEYS => 'Keys',
            self::KEY_SETS => 'Key-sets',
            self::INFORMATION => 'Information',
            self::DEBUG => 'Debug',
            self::TARGETS => 'Targets',
            self::TAGS => 'Tags',
        };
    }

    public function description(): string
    {
        return match ($this) {
            self::SERVICES => 'Gateway services',
            self::ROUTES => 'Gateway routes',
            self::PLUGINS => 'Plugins',
            self::CONSUMERS => 'Consumers',
            self::CERTIFICATES => 'Certificates',
            self::SNIS => 'SNIs',
            self::CA_CERTIFICATES => 'CA certificates',
            self::UPSTREAMS => 'Upstreams',
            self::VAULTS => 'Vaults',
            self::KEYS => 'Keys',
            self::KEY_SETS => 'Key-sets',
            self::INFORMATION => 'Information routes',
            self::DEBUG => 'Debug routes',
            self::TARGETS => 'Target routes',
            self::TAGS => 'Tag routes',
        };
    }
}
