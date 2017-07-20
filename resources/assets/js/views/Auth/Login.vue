<template>
	<div>
		<div class="row">
	        <div class="col-md-6 col-md-offset-3">
	            <div class="panel panel-default">
	                <div class="panel-heading">Login</div>

	                <div class="panel-body">
						<form @submit.prevent="submit" class="form-horizontal">
				        	<div class="form-group col-md-12">
				        		<label for="email" class="control-label">Email Address</label>
				        		<input type="text" v-model="form.email" id="email" name="email" class="form-control">
				        		<span v-if="error.email" class="text-danger">{{ error.email[0] }}</span>
				        	</div>
				        	<div class="form-group col-md-12">
				        		<label for="password" class="control-label">Password</label>
				        		<input type="password" v-model="form.password" id="password" name="password" class="form-control">
				        		<span v-if="error.password" class="text-danger">{{ error.password[0] }}</span>
				        	</div>
				        	<div class="form-group col-md-12">
				        		<button class="btn btn-primary" :disabled="loading">Login</button>
				        		<button @click.prevent="reset" class="btn btn-default">Reset</button>
				        	</div>
						</form>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
</template>
<script>
	import { post } from '../../helpers/api'
	import Flash from '../../helpers/flash'
	import Auth from '../../store/auth'
	export default {
		data() {
			return {
				form: {
					email:'',
					password:''
				},
				error: {},
				loading: false
			}
		},
		methods: {
			submit() {
				this.loading = true
				this.error = {}
				post('api/login', this.form).
					then((res) => {
						if(res.data.logged_in) {
							Auth.set(res.data.api_token, res.data.user_id)
							this.$router.push('/')
							Flash.setSuccess('Welcome! You logged in')
						} 
						this.loading = false
					})
					.catch((err) => {
						if(err.response.status === 422)
							this.error = err.response.data
						else if(err.response.status === 501)
							Flash.setError(err.response.data)
						this.loading = false
					})
			},
			reset() {
				this.form = {}
			}
		}
	}
</script>