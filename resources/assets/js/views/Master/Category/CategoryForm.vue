<template>
	<div>
		<div class="row">
	        <div class="col-md-8 col-md-offset-2">
	            <div class="panel panel-default">
	                <div class="panel-heading">Form Category</div>

	                <div class="panel-body">
						<form @submit.prevent="submit" class="form-horizontal">
							<div class="form-group col-md-12">
				        		<label for="code" class="control-label">Code</label>
				        		<input type="text" v-model="form.code" id="code" name="code" class="form-control">
				        		<span v-if="error.code" class="text-danger">{{ error.code[0] }}</span>
				        	</div>
				        	<div class="form-group col-md-12">
				        		<label for="name" class="control-label">Name</label>
				        		<input type="text" v-model="form.name" id="name" name="name" class="form-control">
				        		<span v-if="error.name" class="text-danger">{{ error.name[0] }}</span>
				        	</div>
				        	<div class="form-group col-md-12">
				        		<button class="btn btn-primary" v-if="!isEdit" :disabled="isProcessing">Create New</button>
				        		<button class="btn btn-primary" v-if="isEdit" :disabled="isProcessing">Update</button>
				        		<router-link to="/category/table" v-if="!isEdit" class="btn btn-default">Cancel</router-link>
				        		<button type="button" @click="addNew" class="btn btn-default" v-if="isEdit">Add New</button>
				        	</div>
						</form>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
</template>
<script>
	import { get } from '../../../helpers/api'
	import { post } from '../../../helpers/api'
	import Flash from '../../../helpers/flash'
	export default {
		data() {
			return {
				form: {
					code:'',
					name:''
				},
				error: {},
				isProcessing: false,
				isEdit: false
			}
		},
		created() {
			let id = this.$route.params.id
			if(id) {
				get('master/categories/find/'+id).
					then((res) => {
						this.isEdit = true
						this.form = { code:res.data.code, name:res.data.name }
					})
					.catch((err) => {

					})
			}
		},
		methods: {
			submit: function() {
				this.isProcessing = true
				this.error = {}
				let url = 'master/categories'
				let msg = 'Create category success.'
				if(this.isEdit) {
					url = 'master/categories/update/'+this.$route.params.id
					msg = 'Update category success.'
				}
				post(url, this.form).
					then((res) => {
						if(res.status === 200) {
							Flash.setSuccess(msg)
							this.$router.push('/category/table')
						}
						this.isProcessing = false
					})
					.catch((err) => {
						if(err.response.status === 422) {
							this.error = err.response.data
						}
						this.isProcessing = false
					})
			},
			addNew: function() {
				this.isEdit = false
				this.$router.push('/category/form')
				this.form = { code:'', name:'' }
			}
		}
	}
</script>