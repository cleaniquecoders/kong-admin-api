# Contributing to CleaniqueCoders/KongAdminApi

Thank you for considering contributing to this project! Your contributions help make this package better for everyone. Please follow these guidelines to make the process smooth and effective.

## Code of Conduct

Please note that this project is under the [Code of Conduct](CODE_OF_CONDUCT.md). By participating, you agree to abide by its terms.

## How Can You Contribute?

### Reporting Issues

1. **Search existing issues**: Before creating a new issue, check if the same or similar issue already exists.
2. **Submit a new issue**: If your issue is new, create a detailed bug report including:
   - The package version you’re using.
   - Steps to reproduce the issue.
   - Expected and actual outcomes.
   - Any relevant logs or screenshots.

### Suggesting Enhancements

1. **Search existing issues and discussions**: Your suggestion may already be discussed or planned.
2. **Open a new issue**: For new suggestions, submit a detailed enhancement request, describing:
   - The problem or improvement.
   - Potential benefits of this enhancement.
   - Any alternative solutions considered.

## Pull Requests

We welcome pull requests! Before submitting, please follow these steps:

1. **Fork the repository** and create your branch from `main`.
2. **Make your changes** in a logically structured and readable manner.
3. **Write tests** for any new functionality. This package uses [PestPHP](https://pestphp.com) for testing.
4. **Check coding standards** by running `composer format`.
5. **Test your changes** to ensure they don’t break any existing functionality.
6. **Update the documentation** if necessary, including README or inline comments.
7. **Commit with a descriptive message** that follows the [conventional commit format](https://www.conventionalcommits.org/).

### Running Tests

To run tests, execute the following command:

```bash
composer test
```

### Running PHPStan

To run tests, execute the following command:

```bash
composer analyse
```

### Running Code Style Fix

To run tests, execute the following command:

```bash
composer format
```

### Submitting a Pull Request

1. Push your branch to your fork and create a pull request to the main repository.
2. Provide a detailed description of your changes and link any relevant issues.
3. Be open to feedback: maintainers may suggest changes.

## Development Environment

This package uses PHP 8.3 and PestPHP for testing. Ensure your local environment matches these requirements. Refer to the [README](README.md) for installation instructions.

## Security Vulnerabilities

If you discover any security issues, please check our [security policy](../../security/policy) for details on responsible disclosure.

## Thank You!

We appreciate your contributions and look forward to working together to improve this package.
```

This document encourages contributors to follow best practices for reporting issues, making code changes, and testing. Let me know if you want any specific sections or customizations.
