<template>
	<div class="d-flex vh-100 align-items-center">
		<main class="conteiner-fluid offset-1 col-4">
			<h1>Here, the registration form:</h1>
			<RegistrationForm class="mt-3" />
		</main>
	</div>
</template>

<script>
import axios from 'axios';
import RegistrationForm from '../components/RegistrationForm';

export default {
	data() {
		return {
			notifications: {
				added: false,
			}
		}
	},
	beforeRouteEnter(to, from, next) {
		if (auth_user) {
			if (auth_user.admin == '1') {
				next();
			} else {
				next({name: 'root'});
			}
		} else {
			next({name: 'login'});
		}
	},
	components: {
		RegistrationForm
	}
}
</script>