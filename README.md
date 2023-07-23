# micro-framework-http

## About
> **!IMPORTANT:** this is an experimental version not to be used for production development

This http-based framework implements the [Dispatcher pattern (more info from Oracle Java)](https://www.oracle.com/java/technologies/front-controller.html) and can be configured as a front-controller or delegate the request to an application. Suitable for REST API services or monolithic server-side rendering.

## Framework features
- Filters, register custom Http Filter
- Interceptors, register custom http interceptors
- Localization, use [POEDIT](https://poedit.net/) to translate strings or add new languages. (Note: required enable php extensions ```gettext```, ```intl```, ```mbstring``` [more info](#requirements))
- Powerful configuration, registering a custom application to handle specific endpoint requests or simply using front-controllers (best for api)
- DI - dependency injection
- Service Locator [see \Core\Utils\ObjectStorage](/Core/Utils/ObjectStorage.php)
- Singleton only used for [see \Core\Boot\Registry](/Core/Boot/Registry.php), no other class uses singleton

## Requirements
PHP >= 8.2

Note: if using Apache enabled ```mod_rewrite```

Enabled PHP extensions
- filter
- gettext
- iconv
- intl
- json
- mbstring
- reflection
- spl

## Learning - Case Study

### Dispatcher lifecycle management 
![workflow](https://github.com/rosario-fiorella/micro-framework-http/assets/41728059/6c3b82f6-5195-4b77-afda-d1e49b8afcca)

### Example 1: Dispatcher as Front-Controller
case study: [dispatcher as front controller without proxy application](https://github.com/rosario-fiorella/micro-framework-http/blob/feature/front-controller/01-example-dispatcher-as-front-controller/index.php)

### Example 2: Dispatcher as Proxy using Application
case study: [dispatcher as proxy using application](https://github.com/rosario-fiorella/micro-framework-http/tree/feature/front-controller/02-example-dispatcher-as-proxy-using-application)

## Security Vulnerabilities
For better security setup, add the following http response headers [more info](https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers) edit **.htaccess** if using **Apache** or **default.config** on **Nginx**, or use [```\Core\Http\Response::setHeader```](/Core/Http/Response.php) method in your controller

- ```X-Frame-Options: SAMEORIGIN```;
- ```X-XSS-Protection: "1; mode=block"```;
- ```X-Content-Type-Options: nosniff```;
- ```Referrer-Policy: strict-origin-when-cross-origin```;

Debugging enabled local development only

Hide sensitive information in http requests/response

Hide file path information in http requests/responses

Always validate/escape user input of requests

Do not allow direct access to files and folders

## License
[see license here](https://github.com/rosario-fiorella/micro-framework-http/blob/master/LICENSE)