<template>
	<div>
		<div class="row">
	        <div class="col-md-8 col-md-offset-2">
	            <div class="panel panel-default">
	                <div class="panel-heading">Data Item
					<router-link to="/item/form" class="btn btn-primary">Create New</router-link>
					<button @click.prevent="deleteSelected" class="btn btn-danger pull-right">Delete Selected</button>
	                </div>
	                <div class="panel-body">
						<table class="table">
							<tr>
								<th><input type="checkbox" v-on:click="checkAll" v-model="selectedAll"></th>
								<th>Code</th>
								<th>Name</th>
								<th>Category</th>
								<th class="text-center">Action</th>
							</tr>
							<tr v-for="(row, i) in rows">
								<td><input type="checkbox" v-model="row.selected" v-on:click="checkSelectAll"></td>
								<td>{{ row.code }}</td>
								<td>{{ row.name }}</td>
								<td>{{ row.category.name }}</td>
								<td width="50">
									<button class="btn btn-sm btn-warning" v-on:click="editData(row.id)">Edit</button>
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
	import { get, post } from '../../../helpers/api'
	import Notification from '../../../helpers/notification'
	import Flash from '../../../helpers/flash'
	export default {
		data() {
			return {
				rows:{
					selected: false,
					code: '',
					name: '',
					category_id: ''
				},
				selectedAll: false,
				delete: [],
			}
		},
		created() {
			this.getData()
		},
		methods: {
			getData() {
				get('/api/master/item/get').
					then((res) => {
						this.rows = res.data
						this.checkAll()
					})
					.catch((err) => {

					})
			},
			editData(id) {
				this.$router.push('/item/form/'+id)
			},
			checkAll() {
				if(this.selectedAll) {
					this.selectedAll = true;
					this.rows.forEach((row) => {
						row.selected = true
					})
				} else {
					this.selectedAll = false;
					this.rows.forEach((row) => {
						row.selected = false
					})
				}
			},
			checkSelectAll() {
				var check = true;
                this.rows.forEach((row) => {
                    if (row.selected == false) {
                        check = false;
                    } 
                });
                this.selectedAll = check;
			},
			deleteSelected() {
				var conf = confirm("Are you sure?");
				if(!conf) return true;
				var vm = this;
				this.rows.forEach((row) => {
					if(row.selected) {
						vm.delete.push({id:row.id})
					}
				})
				post('/api/master/item/delete', this.delete)
				.then((res) => {
					if(res.status === 200) this.getData()
					Notification.count()
					Flash.setSuccess('Delete item success.')
				})
				.catch((err) => {
					console.log(err)
				})
			}
		}
	}
</script>