# micro-framework-http
Http Rest service micro framework

# Architecture
This framework uses filters and interceptors, it can render Mvc Page and Rest Api Service

![uml](https://user-images.githubusercontent.com/41728059/218578195-33b6feff-886c-46e0-9db2-c65cc199333b.png)

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

![webpage-example](https://user-images.githubusercontent.com/41728059/213929619-e78c167c-5ebe-4808-9945-7144253d3c39.png)
