import Vue from 'vue'
 
import App from './App.vue'
import router from './router'

const category = new Vue({
	el:'#category',
	template: '<app></app>',
	components: { App },
	router
});