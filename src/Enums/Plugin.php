<?php

namespace CleaniqueCoders\KongAdminApi\Enums;

use CleaniqueCoders\KongAdminApi\Contracts\Enum;

enum Plugin: string implements Enum
{
    case ACL = 'acl';
    case BOT_DETECTION = 'bot-detection';
    case CORS = 'cors';
    case IP_RESTRICTION = 'ip-restriction';
    case JWT = 'jwt';
    case KEY_AUTH = 'key-auth';
    case LDAP_AUTH = 'ldap-auth';
    case OAUTH2 = 'oauth2';
    case RATE_LIMITING = 'rate-limiting';
    case REQUEST_SIZE_LIMITING = 'request-size-limiting';
    case REQUEST_TERMINATION = 'request-termination';
    case RESPONSE_RATELIMITING = 'response-ratelimiting';
    case SESSION = 'session';
    case BASIC_AUTH = 'basic-auth';
    case HMAC_AUTH = 'hmac-auth';
    case DATADOG = 'datadog';
    case PROMETHEUS = 'prometheus';
    case STATSD = 'statsd';
    case TCP_LOG = 'tcp-log';
    case UDP_LOG = 'udp-log';
    case FILE_LOG = 'file-log';
    case HTTP_LOG = 'http-log';
    case SYSLOG = 'syslog';

    public function label(): string
    {
        return match ($this) {
            self::ACL => 'ACL',
            self::BOT_DETECTION => 'Bot Detection',
            self::CORS => 'CORS',
            self::IP_RESTRICTION => 'IP Restriction',
            self::JWT => 'JWT',
            self::KEY_AUTH => 'Key Authentication',
            self::LDAP_AUTH => 'LDAP Authentication',
            self::OAUTH2 => 'OAuth 2.0',
            self::RATE_LIMITING => 'Rate Limiting',
            self::REQUEST_SIZE_LIMITING => 'Request Size Limiting',
            self::REQUEST_TERMINATION => 'Request Termination',
            self::RESPONSE_RATELIMITING => 'Response Rate Limiting',
            self::SESSION => 'Session Management',
            self::BASIC_AUTH => 'Basic Authentication',
            self::HMAC_AUTH => 'HMAC Authentication',
            self::DATADOG => 'Datadog',
            self::PROMETHEUS => 'Prometheus',
            self::STATSD => 'StatsD',
            self::TCP_LOG => 'TCP Log',
            self::UDP_LOG => 'UDP Log',
            self::FILE_LOG => 'File Log',
            self::HTTP_LOG => 'HTTP Log',
            self::SYSLOG => 'Syslog',
        };
    }

    public function description(): string
    {
        return match ($this) {
            self::ACL => 'Control access to services and routes by whitelisting or blacklisting consumers.',
            self::BOT_DETECTION => 'Identify and block bot traffic based on various techniques and algorithms.',
            self::CORS => 'Enable Cross-Origin Resource Sharing (CORS) on a service or route.',
            self::IP_RESTRICTION => 'Allow or deny access based on the client\'s IP address.',
            self::JWT => 'Validate JSON Web Tokens (JWT) for authentication purposes.',
            self::KEY_AUTH => 'Authenticate users using an API key that consumers include in their requests.',
            self::LDAP_AUTH => 'Authenticate users against an LDAP server.',
            self::OAUTH2 => 'Add OAuth 2.0 authentication to protect your APIs.',
            self::RATE_LIMITING => 'Limit the number of requests a user can make to an API within a defined period.',
            self::REQUEST_SIZE_LIMITING => 'Limit the size of client request bodies.',
            self::REQUEST_TERMINATION => 'Terminate incoming requests based on certain criteria, such as status code or message.',
            self::RESPONSE_RATELIMITING => 'Control response rates based on defined criteria.',
            self::SESSION => 'Manage sessions and store session data across multiple requests.',
            self::BASIC_AUTH => 'Provide basic authentication (username and password) for consumers.',
            self::HMAC_AUTH => 'Authenticate users using HMAC signature-based authentication.',
            self::DATADOG => 'Send request metrics to Datadog for monitoring and alerting.',
            self::PROMETHEUS => 'Expose metrics in a format that Prometheus can scrape for monitoring.',
            self::STATSD => 'Send request metrics to a StatsD server for monitoring.',
            self::TCP_LOG => 'Log request data to a TCP server for monitoring or analysis.',
            self::UDP_LOG => 'Log request data to a UDP server for monitoring or analysis.',
            self::FILE_LOG => 'Log request data to a file for later review.',
            self::HTTP_LOG => 'Log request data to an HTTP endpoint for monitoring or analysis.',
            self::SYSLOG => 'Log request data to the Syslog service for centralized logging.',
        };
    }
}
