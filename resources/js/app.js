require('./bootstrap');

import Vue from 'vue';
import App from './App.vue';
import VueRouter from 'vue-router';
import RegistrationPage from './pages/RegistrationPage';
import LoginPage from './pages/LoginPage';
import NotFoundPage from './pages/NotFoundPage';
import IndexPage from './pages/IndexPage';
import EditPage from './pages/EditPage';

Vue.use(VueRouter);

const router = new VueRouter({
	mode: 'history',
	routes: [
		{
			path: '/',
			name: 'root',
			component: IndexPage,
		},
		{
			path: '/create',
			name: 'register',
			component: RegistrationPage,
		},
		{
			path: '/login',
			name: 'login',
			component: LoginPage,
		},
		{
			path: '/edit/:id',
			name: 'edit',
			component: EditPage,
		},
		{
			path: '*',
			component: NotFoundPage,
		}
	]
});

new Vue({
	el: '#app',
	render: f => f(App),
	router
});