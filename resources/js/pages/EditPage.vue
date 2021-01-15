<template>
	<div class="d-flex vh-100 align-items-center">
		<main class="conteiner-fluid offset-1 col-4">
			<h1>Here, the edit form:</h1>
			<RegistrationForm :edit="true" class="mt-3" />
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
	props: {
		id: {
			type: String
		}
	},
	components: {
		RegistrationForm
	}
}
</script>