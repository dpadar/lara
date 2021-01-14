<template>
	<form class="mt-3 col-6" @submit.prevent="onSubmit" novalidate>
		<div class="my-2">
			<div class="form-floating">
				<input type="text" class="form-control" id="username" aria-describedby="invalidUsernameFeedback"
				:class="usernameValidity" @change="username.changed = true"
				v-model="username.data">
				<label for="username" class="form-label">Username</label>
				<div id="invalidUsernameFeedback" class="invalid-feedback">
					Username cannot be blank
				</div>
			</div>
		</div>
		<div class="my-2">
			<div class="form-floating">
				<input type="password" class="form-control" id="password" aria-describedby="invalidPasswordFeedback"
				:class="passwordValidity" @change="password.changed = true"
				v-model="password.data">
				<label for="password">Password</label>
				<div id="invalidPasswordFeedback" class="invalid-feedback">
					Password cannot be blank
				</div>
			</div>
		</div>
		<button type="submit" class="btn btn-primary my-2" :class="loginBtnActiveness">Login</button>
	</form>
</template>

<script>
import axios from 'axios';

export default {
	data() {
		return {
			username: {
				data: '',
				changed: false,
			},
			password: {
				data: '',
				changed: false,
			},
		}
	},
	computed: {
		usernameValidity() {
			return {
				'is-invalid': this.username.changed && this.username.data == ''
			}
		},
		passwordValidity() {
			return {
				'is-invalid': this.password.changed && this.password.data == ''
			}
		},
		loginBtnActiveness() {
			return {
				'disabled': !(this.username.data != '' && this.password.data != '')
			}
		},
	},
	methods: {
		onSubmit() {
			if (this.username.data != '' && this.password.data != '') {
			axios.get('/sanctum/csrf-cookie').then(response => {
    			axios.post('/login', {
					username: this.username.data,
					password: this.password.data,
				}).then( response => {
					if (response.status == 200) {
						window.location.replace(window.location.origin)
					}
				});
			});
			}
		},
	}
}
</script>