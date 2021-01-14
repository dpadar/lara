<template>
	<form @submit.prevent="onSubmit" novalidate>
		<div class="my-2 row">
			<div class="col">
				<div class="form-floating">
					<input type="text" class="form-control" id="firstname" aria-describedby="invalidFirstnameFeedback"
					:class="firstnameValidity" @change="firstname.changed = true"
					v-model="firstname.data">
					<label for="firstname">First name</label>
					<div id="invalidFirstnameFeedback" class="invalid-feedback">
						Only real names are allowed
					</div>
				</div>
			</div>
			<div class="col">
				<div class="form-floating">
					<input type="text" class="form-control" id="lastname" aria-describedby="invalidLastnameFeedback"
					:class="lastnameValidity" @change="lastname.changed = true"
					v-model="lastname.data">
					<label for="firstname">Last name</label>
					<div id="invalidLastnameFeedback" class="invalid-feedback">
						Provide your last name
					</div>
				</div>
			</div>
		</div>
		<div class="my-2">
			<div class="form-floating">
				<input type="text" class="form-control" id="username" aria-describedby="invalidUsernameFeedback"
				:class="usernameValidity" @change="username.changed = true"
				v-model="username.data">
				<label for="username" class="form-label">Username</label>
				<div id="invalidUsernameFeedback" class="invalid-feedback">
					Username must only contain letters, numbers, - and _
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
					Password must have at least one uppercase letter and number
				</div>
			</div>
		</div>
		<div class="my-2">
			<div class="form-floating">
				<input type="password" class="form-control" id="passwordConfirmation" aria-describedby="passwordDoesntMatchFeedback"
				:class="passwordMatchiness" @change="passwordConfirmation.changed = true"
				v-model="passwordConfirmation.data">
				<label for="passwordConfirmation">Confirm password</label>
				<div id="passwordDoesntMatchFeedback" class="invalid-feedback">
					Passwords doesn't match
				</div>
			</div>
		</div>
		<div class="form-floating">
			<select class="form-select" id="country"
			v-model="countries.selected" required>
				<option value="" disabled>Choose...</option>
				<option v-for="country in countries.all" :key="country.code" :value="country.code">{{ country.name }}</option>
			</select>
			<label for="country">Your country</label>
		</div>
		<button type="submit" class="btn btn-primary my-2">Register</button>
	</form>
</template>

<script>
import axios from 'axios';

export default {
	data() {
		return {
			firstname: {
				data: '',
				changed: false,
			},
			lastname: {
				data: '',
				changed: false,
			},
			username: {
				data: '',
				changed: false,
			},
			password: {
				data: '',
				changed: false,
			},
			passwordConfirmation: {
				data: '',
				changed: false,
			},
			countries: {
				all: [],
				selected: ''
			},
		}
	},
	props: {
		edit: {
			type: Boolean,
			default: false,
		},
		id: String,
	},
	computed: {
		firstnameValidity() {
			return {
				'is-invalid': this.firstname.data == '' ? false : this.firstname.changed ? 
				!(/^(\P{N}){2,64}$/u.test(this.firstname.data)) : false
			}
		},
		lastnameValidity() {
			return {
				'is-invalid': this.lastname.data == '' ? false : this.lastname.changed ? 
				!(/^(\P{N}){2,64}$/u.test(this.lastname.data)) : false
			}
		},
		usernameValidity() {
			return {
				'is-invalid': this.username.data == '' ? false : this.username.changed ? 
				!(/^[a-z0-9 \-_]{2,64}$/i.test(this.username.data)) : false
			}
		},
		passwordValidity() {
			return {
				'is-invalid': this.password.data == '' ? false : this.password.changed ? 
				!(/.*[A-Z].*/.test(this.password.data) && /.*[0-9].*/.test(this.password.data) && 
				/.{8,256}/.test(this.password.data)) : false
			}
		},
		passwordMatchiness() {
			return {
				'is-invalid': this.passwordConfirmation.data == '' ? false : this.passwordConfirmation.changed ? 
				!(this.passwordConfirmation.data == this.password.data) : false
			}
		},
		countryValidity() {
			return {
				'is-invalid': this.countries.selected != '' ? false : true,
			}
		}
	},
	created() {
		axios.get('/api/countries'
		).then( response => {
			this.countries.all = response.data;
		});
		if (this.edit) {
			axios.get(`/api/users/${this.id}`
			).then( resp => {
				this.firstname.data = resp.data.firstname;
				this.lastname.data = resp.data.lastname;
				this.username.data = resp.data.username;
				this.countries.selected = resp.data.country_code;
			})
		}
	},
	methods: {
		onSubmit() {
			// I know it's bad
			switch (this.edit) {
				case true:
					axios.put(`/api/users/${this.id}`, this.getValid()).then( response => {
						if (response.status == 200) {
							window.location.replace(window.location.origin);
						}
					});;
					break;
			
				default:
					if (!this.firstnameValidity['is-invalid'] && !this.lastnameValidity['is-invalid'] &&
					!this.usernameValidity['is-invalid'] && !this.passwordValidity['is-invalid'] &&
					!this.passwordMatchiness['is-invalid'] && this.countries.selected != '') {
						axios.get('/sanctum/csrf-cookie').then(response => {
							axios.post('/api/users', {
								firstname: this.firstname.data,
								lastname: this.lastname.data,
								username: this.username.data,
								country: this.countries.selected,
								password: this.password.data,
							}).then( response => {
								if (response.status == 200) {
									window.location.replace(window.location.origin);
								}
							});;
						});
					}
					break;
			}
		},
		getValid() {
			let validFields = {};
			if (this.firstname.data != '' && !this.firstnameValidity['is-invalid']) {
				validFields.firstname = this.firstname.data;
			}
			if (this.lastname.data != '' && !this.lastnameValidity['is-invalid']) {
				validFields.lastname = this.lastname.data;
			}
			if (this.username.data != '' && !this.usernameValidity['is-invalid']) {
				validFields.username = this.username.data;
			}
			if (this.password.data != '' && !this.passwordValidity['is-invalid'] && !this.passwordMatchiness['is-invalid']) {
				validFields.password = this.password.data;
			}
			if (this.countries.selected != '') {
				validFields.country = this.countries.selected;
			}
			console.log(validFields);
			return validFields;
		}
	}
}
</script>