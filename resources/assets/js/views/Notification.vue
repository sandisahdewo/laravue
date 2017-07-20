<template>
	<div>
		<div class="row">
	        <div class="col-md-8 col-md-offset-2">
	            <div class="panel panel-default">
	                <div class="panel-heading">Notification
	                </div>
	                <div class="panel-body">
						<table class="table">
							<tr>
								<th>#</th>
								<th>Code</th>
								<th>Name</th>
								<th>Read at</th>
								<th class="text-center">Action</th>
							</tr>
							<tr v-for="(row, i) in rows" :class="{ unread:!row.read_at }">
								<td>{{ i+=1 }}</td>
								<td>{{ row.data.item_code }}</td>
								<td>{{ row.data.item_name }}</td>
								<td>{{ row.read_at }}</td>
								<td width="50">
									<button class="btn btn-sm btn-default" v-if="!row.read_at" @click.prevent="read(row.id)">Read</button>
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
	import { get, del } from '../helpers/api'
	import Notification from '../helpers/notification'
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
			getData() {
				get('/api/get-all-notification').
					then((res) => {
						this.rows = res.data
					})
					.catch((err) => {

					})
			},
			read(id) {
				get('/api/mark-read-notification/'+id).
					then((res) => {
						if(res.status === 200) this.getData()
						Notification.count()
					})
					.catch((err) => {

					})
			}
		}
	}
</script>

<style scoped>
	.unread {
		font-weight: bold;
		background-color: #e3eaea;
	}
</style>