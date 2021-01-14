<template>
	<router-view></router-view>
</template>

<style lang="scss">
@import "../../node_modules/bootstrap/scss/bootstrap";
</style>

<script>
	import bootstrap from 'bootstrap';
	import VueRouter from 'vue-router';
	import RegistrationPage from './pages/RegistrationPage';
	import LoginPage from './pages/LoginPage';

	export default {
		components: {
			RegistrationPage
		}
	}
</script>