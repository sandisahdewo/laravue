<template>
	<div>
		<div class="row">
	        <div class="col-md-8 col-md-offset-2">
	            <div class="panel panel-default">
	                <div class="panel-heading">Form Item</div>

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
				        		<label for="category">Category</label>
				        		<select name="category" v-model="form.category_id" id="cateogry" class="form-control">
				        			<option :value="defaultOption">-- Choose Category --</option>
				        			<option v-for="category in categories" :value="category.id">{{ category.name }}</option>
				        		</select>
				        		<span v-if="error.category_id" class="text-danger">{{ error.category_id[0] }}</span>
				        	</div>
				        	<div class="form-group col-md-12">
				        		<button class="btn btn-primary" v-if="!isEdit" :disabled="loading">Create New</button>
				        		<button class="btn btn-primary" v-if="isEdit" :disabled="loading">Update</button>
				        		<router-link to="/item/table" v-if="!isEdit" class="btn btn-default">Cancel</router-link>
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
	import { get, post } from '../../../helpers/api'
	import Flash from '../../../helpers/flash'
	export default {
		data() {
			return {
				form: {
					code:'',
					name:'',
					category_id:''
				},
				categories: {},
				error: {},
				loading: false,
				isEdit: false
			}
		},
		created() {
			this.getCategories()
			let id = this.$route.params.id
			if(id) {
				get('/api/master/item/find/'+id).
					then((res) => {
						this.isEdit = true
						this.form = { 
							code:res.data.code, 
							name:res.data.name,
							category_id:res.data.category.id
						}
					})
					.catch((err) => {
						console.log(err)
					})
			}
		},
		methods: {
			getCategories() {
				get('/api/master/category/get').
					then((res) => {
						this.categories = res.data
					})
			},
			submit() {
				this.loading = true
				this.error = {}
				let url = '/api/master/item/create'
				let msg = 'Create item success.'
				if(this.isEdit) {
					url = '/api/master/item/update/'+this.$route.params.id
					msg = 'Update item success.'
				}
				post(url, this.form).
					then((res) => {
						if(res.status === 200) {
							Flash.setSuccess(msg)
							this.$router.push('/item/table')
						}
						this.loading = false
					})
					.catch((err) => {
						if(err.response.status === 422) {
							this.error = err.response.data
						}
						this.loading = false
					})
			},
			addNew() {
				this.isEdit = false
				this.$router.push('/item/form')
				this.form = { code:'', name:'' }
			}
		},
		computed: {
			defaultOption() {
				return ''
			}
		}
	}
</script>