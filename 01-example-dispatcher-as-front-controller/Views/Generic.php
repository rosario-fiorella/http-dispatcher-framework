<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>VUE - Example MVC Page</title>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/3.3.4/vue.global.prod.min.js"></script>
</head>

<body>
    <main>

        <div id="app">
            <div>
                <p>{{ content }}</p>
            </div>
        </div>

        <script>
            const {
                createApp
            } = Vue

            createApp({
                data() {
                    return <?php echo $data; ?>
                }
            }).mount('#app')
        </script>

        <p>
            <?php printf("time: %.2f seconds.", microtime(true) - $_SERVER['REQUEST_TIME']); ?>
        </p>
    </main>

</body>

</html>