<template>
	<div id="root">
		<main class="container-fluid">
			<template v-if="userAuthed">
				<div class="offset-1 col-5"><div class="offset-1 col-10">
						<h1>Hello, <strong class="text-primary">{{ firstname }}</strong>! Happy to see you.</h1>
						<hr>
						<h2 class="mt-2">Intel we have on you:</h2>
						<p class="h5 mt-2">Your name is <code>{{ firstname }} {{ lastname }}</code>, and your nick is <code>{{ username }}</code>.<br>
							You're located in country with code <code>{{ country_code }}</code>.
							Also, you're <template v-if="admin"><code>an admin</code></template>
							<template v-else><code>not an admin</code></template>.
						</p>
						<router-link :to="{name: 'edit', query: {'id': id}}" class="btn btn-secondary mt-2">Edit</router-link>
						<hr>	
					</div>
					<div v-if="admin" class="mt-2 col-12 py-4 shadow-lg rounded-3">
						<div class="offset-1 col-10">
							<h1 class="py-2 px-1">Admin panel</h1>
							<hr>
							<div class="d-flex align-items-end">
								<h2>Users</h2>
								<router-link class="btn btn-primary ms-auto" :to="{name: 'register'}">Add user</router-link>
							</div>
							<UsersTable />
						</div>
					</div>
				</div>
			</template>
			<h1 v-else class="offset-1 col-5">Welcome! <br>Make sure to <router-link :to="{name: 'login'}">login</router-link>.</h1>
		</main>
	</div>
</template>

<style scoped>
#root {
	margin-top: 30vh;
	margin-bottom: 5vh;
}
</style>

<script>
import UsersTable from '../components/UsersTable';

export default {
	data() {
		return {
			userAuthed: auth_user ? true : false,
			id: auth_user ? auth_user.id : '',
			firstname: auth_user ? auth_user.firstname : '',
			lastname: auth_user ? auth_user.lastname : '',
			username: auth_user ? auth_user.username : '',
			country_code: auth_user ? auth_user.country_code : '',
			//admin: auth_user ? auth_user.admin == 1 ? true : false : '',
			admin: auth_user ? true : '',
		}
	},
	components: {
		UsersTable
	}
}
</script>