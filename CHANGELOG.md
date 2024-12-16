# Changelog

All notable changes to `kong-admin-api` will be documented in this file.

## v1.0.2 - 2024-12-16

### What's Changed

* Update larastan/larastan requirement from ^2.9 to ^3.0 by @dependabot in https://github.com/cleaniquecoders/kong-admin-api/pull/1

### New Contributors

* @dependabot made their first contribution in https://github.com/cleaniquecoders/kong-admin-api/pull/1

**Full Changelog**: https://github.com/cleaniquecoders/kong-admin-api/compare/v1.0.1...v1.0.2

## v1.0.1 - 2024-11-05

**Full Changelog**: https://github.com/cleaniquecoders/kong-admin-api/compare/v1.0.0...v1.0.1

## v1.0.0 - 2024-11-05

### Release v1.0.0

#### 🚀 Initial Release

The **v1.0.0** release of the `CleaniqueCoders\KongAdminApi` package provides a comprehensive and framework-agnostic solution for interacting with Kong Gateway's Admin API in PHP.

#### 🛠️ Features

- **Service Management**: Create, update, retrieve, and delete services within Kong.
  
- **Route Management**: Full CRUD operations for managing routes associated with services.
  
- **Consumer Management**: Manage consumers including creation, retrieval, updating, and deletion.
  
- **Plugin Support**:
  
  - Associate plugins with `consumers`, `routes`, and `services`.
  - Supported plugins include **rate-limiting**, **CORS**, **JWT**, and more (limited to Kong's free tier).
  
- **Structured API Responses**: Responses follow a structured format with `status`, `data`, and `meta` sections for consistency.
  
- **Configuration-Based Setup**: Easily configure API base URL, authentication, and headers.
  

**Full Changelog**: https://github.com/cleaniquecoders/kong-admin-api/commits/v1.0.0

#### 🧪 Testing

- Full unit test coverage using **PestPHP**, with mocks for simulating API interactions.
- Includes tests for all primary operations and plugin integrations.

#### 📚 Documentation

- Examples provided for basic service, route, and consumer management.
- Plugin-specific usage examples for attaching, updating, and deleting plugins on resources.


---

This release sets the foundation for seamless interaction with Kong Gateway, supporting key administrative tasks and plugin management for free-tier use cases.
