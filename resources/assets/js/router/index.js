import Vue from 'vue'
import VueRouter from 'vue-router'

import Register from '../views/Auth/Register.vue'
import Login from '../views/Auth/Login.vue'
import Items from '../views/Master/Items.vue'
import CategoryForm from '../views/Master/Category/Form.vue'
import CategoryTable from '../views/Master/Category/Table.vue'

Vue.use(VueRouter)

const router = new VueRouter({
	routes: [
		{ path:'/register', component:Register },
		{ path:'/login', component:Login },
		{ path:'/item', component:Items },
		{ path:'/category/form/:id?', component:CategoryForm },
		{ path:'/category/table', name:'category-table', component:CategoryTable },
	],
})

export default router