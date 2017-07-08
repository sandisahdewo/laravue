var app = new Vue({
	el: '#app',
	data: {
		message: 'Hello Vue!',
		groceryList: [
			{ id: 0, text: 'Vegetables' },
			{ id: 1, text: 'Cheese' },
			{ id: 2, text: 'Whatever else humans are supposed to eat' }
	    ]
	}
})

var	app2 = new Vue({
	el: '#app-2',
	data: {
		message: 'You loaded this page on ' + new Date()
	}
})

var	app3 = new Vue({
	el: '#app-3',
	data: {
		seen:true
	}
})

var app4 = new Vue({
	el: '#app-4',
	data: {
		todos : [
			{text: 'learn vue', value: 'Leaning Vue JS'},
			{text: 'learn laravel', value: 'Learning Laravel'}
		],
		newTodos: '',
	},
	methods: {
		pushInput: function () {
			this.todos.push({text: this.newTodos, value: this.newTodos})
			this.newTodos = ''
		},
		deleteTodo: function(index) {
			this.todos.splice(index, 1)
		}
	}
})
app4.todos.push({text: 'learn js', value: 'Learning JS'})

var app5 = new Vue({
	el: '#app-5',
	data: {
		message: 'Hello vuejs!',
	},
	methods: {
		reverseMessage: function () {
			this.message = this.message.split('').reverse().join('')
		}
	}
})

Vue.component('todo-item', {
	props: ['todo'],
	template: '<li>This is a todo</li>'
})