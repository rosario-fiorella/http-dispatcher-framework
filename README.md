# HTTP Dispatcher Framework

## About
> **!IMPORTANT:** this is an experimental version not to be used for production development

This http-based framework implements the [Dispatcher pattern (more info from Oracle Java)](https://www.oracle.com/java/technologies/front-controller.html) and can be configured as a front-controller or delegate the request to an application. Suitable for REST API services or monolithic server-side rendering.

## Key Architectural Concepts
- **Dispatcher Pattern**: Centralizes HTTP request handling. See `Core/Http/Dispatcher.php` and example usage in `01-example-dispatcher-as-front-controller/` and `02-example-dispatcher-as-proxy-using-application/`.
- **Front Controller vs Proxy**: Two main modes. Front controller directly handles requests; proxy delegates to an application. Example directories illustrate both patterns.
- **Filters & Interceptors**: Custom HTTP filters (`Core/Http/Filter.php`) and interceptors (`Core/Http/Interceptor.php`) can be registered for request/response manipulation.
- **Negotiation**: Request content validation is handled via negotiation classes (`Core/Http/Negotiation.php`).
- **Localization**: Uses POEDIT and `.po/.mo` files under `locale/`. Requires PHP extensions: `gettext`, `intl`, `mbstring`.
- **Dependency Injection & Service Locator**: DI is used for configuration. See `Core/Utils/ObjectStorage.php` for service locator, and `Core/Boot/Registry.php` for singleton usage.

## Developer Workflows
- **No build step required**; PHP >= 8.2 is mandatory.
- **Enable required PHP extensions**: `filter`, `gettext`, `iconv`, `intl`, `json`, `mbstring`, `reflection`, `spl`.
- **Debugging**: Debugging is enabled for local development only. Sensitive info should be hidden in HTTP requests/responses.
- **Security**: Set recommended HTTP headers using `.htaccess` (Apache), `default.config` (Nginx), or via `Core/Http/Response::setHeader` in controllers.

## Project-Specific Conventions
- **Singletons**: Only `Core/Boot/Registry.php` uses singleton; avoid elsewhere.
- **Localization**: Add new languages by creating `.po/.mo` files in `locale/` and updating configuration.
- **Controllers & Views**: Organize under `Controllers/` and `Views/` in example directories. Follow naming conventions as shown.
- **Configuration**: Use DI and configuration classes under `Config/` and `Boot/`.

## Integration Points
- **External dependencies**: No composer or package manager; all dependencies are PHP extensions.
- **Cross-component communication**: Use DI and service locator for sharing state and services.

## References
- Dispatcher: `Core/Http/Dispatcher.php`
- Service Locator: `Core/Utils/ObjectStorage.php`
- Singleton: `Core/Boot/Registry.php`
- Example usage: `01-example-dispatcher-as-front-controller/`, `02-example-dispatcher-as-proxy-using-application/`
- Localization: `locale/`

---

**For questions or unclear conventions, review the README or example directories.**
