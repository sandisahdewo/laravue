import Vue from 'vue'
 
import App from './App.vue'
import router from './router'
import Auth from './store/auth'
import Flash from './helpers/flash'

import { isAuthenticated, getToken } from './helpers/authenticated'

router.beforeEach((to, from, next) => {
	if(to.matched.some(record => record.meta.isAuthenticated)) {
		if(isAuthenticated()) {
			next()
		} else {
			Flash.setError('You must logged in!')
			return next({
				path:'/login'
			})
		}
	} else next()
})

const app = new Vue({
	el:'#app',
	template: '<app></app>',
	components: { App },
	router:router
});