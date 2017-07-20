import Vue from 'vue'
import VueRouter from 'vue-router'

import { mustAuthenticated } from '../helpers/authenticated'

import Register from '../views/Auth/Register.vue'
import Login from '../views/Auth/Login.vue'
import Dashboard from '../views/Dashboard.vue'
import CategoryForm from '../views/Master/Category/Form.vue'
import CategoryTable from '../views/Master/Category/Table.vue'
import ItemForm from '../views/Master/Item/Form.vue'
import ItemTable from '../views/Master/Item/Table.vue'
import Notification from '../views/Notification.vue'

Vue.use(VueRouter)

const router = new VueRouter({
	routes: [
		{ 
			path:'/register', 
			component:Register
		},
		{ 
			path:'/login', 
			component:Login 
		},
		{ 
			path:'/', 
			component:Dashboard,
			meta:{
				isAuthenticated:true
			} 
		},
		{ 
			path:'/notification', 
			component:Notification,
			meta:{
				isAuthenticated:true
			} 
		},
		{ 
			path:'/category/form/:id?', 
			component:CategoryForm,
			meta:{
				isAuthenticated:true
			}
		},
		{ 
			path:'/category/table', 
			component:CategoryTable,
			meta:{
				isAuthenticated:true
			}
		},
		{ 
			path:'/item/form/:id?', 
			component:ItemForm,
			meta:{
				isAuthenticated:true
			}
		},
		{ 
			path:'/item/table', 
			component:ItemTable,
			meta:{
				isAuthenticated:true
			}
		}
	],
})

export default router