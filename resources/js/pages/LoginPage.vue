<template>
	<div id="root" class="d-flex vh-100 align-items-center">
		<main class="container">
			<div v-if="userAuthed" class="alert alert-warning col-6" role="alert">
				<p>You're already logined as {{ firstname }} {{ lastname }}</p>
				<hr>
				<p class="mb-0">Let's <router-link :to="{name: 'root'}">go home</router-link> instead?</p>
			</div>
			<h1>Your secrets, please</h1>
			<LoginForm />
		</main>
	</div>
</template>

<script>
import LoginForm from '../components/LoginForm';

export default {
	data() {
		return {
			userAuthed: auth_user ? true : false,
			firstname: auth_user ? auth_user.firstname : '',
			lastname: auth_user ? auth_user.lastname : '',
		}
	},
	components: {
		LoginForm
	}
}
</script>