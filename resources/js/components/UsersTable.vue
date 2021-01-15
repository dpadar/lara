<template>
	<div>
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th scole="col">id</th>
					<th scope="col">Name</th>
					<th scope="col">Username</th>
					<th scope="col">Country</th>
				</tr>
			</thead>
			<tbody>
				<tr v-for="user in users" :key="user.id" @click.prevent="$router.push(`/edit/${user.id}`)">
					<th>{{ user.id }}</th>
					<td>{{ user.firstname }} {{ user.lastname }}</td>
					<td>{{ user.username }}</td>
					<td>{{ user.country_code }}</td>
				</tr>
			</tbody>
		</table>
		<nav>
			<ul class="pagination">
				<li v-for="page in pages" :key="page.label" class="page-item" :class="{active: page.active, disabled: !page.url}"><a class="page-link" @click.prevent="fetchPage(page.url)" ><span v-html="page.label"></span></a></li>
			</ul>
		</nav>
	</div>
</template>

<script>
import axios from 'axios';

export default {
	data() {
		return {
			users: [],
			pages: [],
		}
	},
	created() {
		this.fetchPage('/api/users');
	},
	methods: {
		fetchPage(url) {
			axios.get(url
			).then( response => {
				this.users = response.data.data;
				this.pages = response.data.links;
			})
		}
	}
}
</script>