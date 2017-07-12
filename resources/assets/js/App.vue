<template>
	<div>
		<div class="navbar navbar-default navbar-static-top">
			<div class="container">
	            <div class="navbar-header">
	        		<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
	                    <span class="sr-only">Toggle Navigation</span>
	                    <span class="icon-bar"></span>
	                    <span class="icon-bar"></span>
	                    <span class="icon-bar"></span>
	                </button>
	            </div>
	            <div class="collapse navbar-collapse" id="app-navbar-collapse">
		            <ul class="nav navbar-nav">
		                <li><router-link to="/item">Item</router-link></li>
		                <li><router-link to="/category/table">Category</router-link></li>
		            </ul>
                    <ul class="nav navbar-nav navbar-right">
	                    <li><router-link to="/login" v-if="!authCheck">Login</router-link></li>
	                    <li><router-link to="/register" v-if="!authCheck">Register</router-link></li>
	                    <li><a @click.stop="logout" v-if="authCheck">Logout</a></li>
	                </ul>
		        </div>
	        </div>
        </div>
        <div class="container">
        	<div class="alert alert-success col-md-8 col-md-offset-2" v-if="flash.success">
        		<strong>Success!</strong> {{ flash.success }}
        	</div>
        	<div class="alert alert-danger col-md-8 col-md-offset-2" v-if="flash.error">
        		<strong>Error!</strong> {{ flash.error }}
        	</div>
        	<router-view></router-view>
        </div>
	</div>
</template>
<script>
	import { post } from './helpers/api'
	import Flash from './helpers/flash'
	import Auth from './store/auth'
	export default {
		created() {
			Auth.initialize()
		},
		data() {
			return {
				flash: Flash.state,
				auth: Auth.state
			}
		},
		computed: {
			authCheck() {
				if(this.auth.api_token && this.auth.user_id) {
					return true
				}
				return false
			}
		},
		methods: {
			logout() {
				post('/api/logout', {id:this.auth.user_id})
					.then((res) => {
						if(res.data.logged_out) {
							Auth.remove()
							Flash.setSuccess('Logged out successfully')
							this.$router.push('/login')
						}
					})
			}
		}
	}
</script>