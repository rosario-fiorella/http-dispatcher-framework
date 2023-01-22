# micro-framework-http
Http Rest service micro framework

# Architecture
This framework uses filters and interceptors, it can render Mvc Page and Rest Api Service

```
---- Client Request
    ----> Run Filter Chain 
          ----> Dispatcher, 
                ----> Handler Mapping and resolve ControllerName
                ----> Handler interceptor start

                      ----> Execute controller
                      <---- Retrieve Model and View

                <---- Handler interceptor stop
          <---- View Resolver
    <---- Request / Response Filter Chain
---- Response, Rendering View
```

example usage:
- define openapi routing in 'App/routing.json'
- set the "tag" property with the convention name before "module-name", after "controller-name". Example
```
    "tags": [
        "ModuleName/ControllerName"
    ],
```
- make "modules" folder and "controller" file in 'App/Modules/{{module-name}}/Controllers/{{controller-name}}
- make "view" file in 'App/Modules/{{module-name}}/Views/{{view-name}}'

Example using the file 'App/routing.json'

```
curl http://{{host}}/App/rest/123
{
  "data": [
    {
      "title": "Product title n. 0",
      "content": "Product content."
    },
    {
      "title": "Product title n. 1",
      "content": "Product content."
    },
    {
      "title": "Product title n. 2",
      "content": "Product content."
    },
    {
      "title": "Product title n. 3",
      "content": "Product content."
    },
    {
      "title": "Product title n. 4",
      "content": "Product content."
    }
  ]
}
```

This micro framework used MVC pattern, rest service and MVC web page.
Usage example MVC page with VUE.js

http://{{host}}/App/vue/123

