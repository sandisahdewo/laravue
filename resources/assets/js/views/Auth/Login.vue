<template>
	<div>
		<div class="row">
	        <div class="col-md-8 col-md-offset-2">
	            <div class="panel panel-default">
	                <div class="panel-heading">Register</div>

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
				        		<button class="btn btn-primary">Login</button>
				        		<button class="btn btn-default">Reset</button>
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
	export default {
		data() {
			return {
				form: {
					email:'',
					password:''
				},
				error: {},
				isProcessing: false
			}
		},
		methods: {
			submit: function() {
				this.isProcessing = true
				this.error = {}
				post('/login', this.form).
					then((res) => {
						if(res.response.success) {

						}
					})
					.catch((err) => {
						if(err.response.status === 422) {
							this.error = err.response.data
							console.log(this.error)
						}
						this.isProcessing = false
					})
			}
		}
	}
</script>