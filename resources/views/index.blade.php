<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel Vue</title>
    </head>
    <body>
        <div id="app">
            <p>@{{ message }}</p>
            <input type="text" v-model="message">
        </div>

        <div id="app-2">
            <span v-bind:title="message">
                Hover your mouse over me for a few seconds
                to see my dynamically bound title!
            </span>
        </div>

        <div id="app-3">
            <p v-if="seen">Now you seen me</p>
        </div>
        
        <div id="app-4">
            <ol>
                <li v-for="(todo, index) in todos">
                    @{{ todo.text }} | @{{ todo.value }} 
                    <button v-on:click="deleteTodo(index)">x</button>
                </li>
            </ol>
            <input type="text" v-model="newTodos">
            <button v-on:click="pushInput">Push</button>
        </div>

        <div id="app-5">
            <p>@{{ message }}</p>
            <button v-on:click="reverseMessage">Reverse Message</button>
        </div>


        <script src="js/vue/vue.min.js"></script>
        <script src="js/index.js"></script>
    </body>
</html>
