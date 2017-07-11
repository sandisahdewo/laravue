<template>
	<div>
		<div class="row">
	        <div class="col-md-8 col-md-offset-2">
	            <div class="panel panel-default">
	                <div class="panel-heading">Data Category
					<router-link to="/category/form" class="btn btn-primary">Create New</router-link>
	                </div>
	                <div class="panel-body">
						<table class="table table-striped">
							<tr>
								<th>Code</th>
								<th>Name</th>
								<th class="text-center">Action</th>
							</tr>
							<tr v-for="row in rows">
								<td>{{ row.code }}</td>
								<td>{{ row.name }}</td>
								<td width="150">
									<button class="btn btn-sm btn-warning" v-on:click="editData(row.id)">Edit</button>
									<button class="btn btn-sm btn-danger" v-on:click="deleteData(row.id)">Delete</button>
								</td>
							</tr>
						</table>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
</template>
<script>
	import { get } from '../../../helpers/api'
	import Flash from '../../../helpers/flash'
	export default {
		data() {
			return {
				rows:{}
			}
		},
		created() {
			this.getData()
		},
		methods: {
			getData: function() {
				get('master/categories').
					then((res) => {
						this.rows = res.data
					})
					.catch((err) => {

					})
			},
			editData: function(id) {
				this.$router.push({path:'/category/form/'+id})
			},
			deleteData: function(id) {
				let confirmDelete = confirm('Are you sure?')
				if(!confirmDelete) return
				get('master/categories/delete/'+id).
					then((res) => {
						if(res.status === 200) this.getData()
						Flash.setSuccess('Delete category success.')
					})
					.catch((err) => {

					})
			}
		}
	}
</script>