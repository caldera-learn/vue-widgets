<template>
	<div id="app">
		aaa
		<div>{{message}}</div>
	</div>
</template>

<script>
	import WPAPI from 'wpapi';
	const wp =  new WPAPI({ endpoint: 'https://calderaforms.com/wp-json' });
	export default {
		name: 'app',
		beforeMount(){
			wp.posts().then(function( data ) {
				console.log(data);
			}).catch(function( err ) {
				// handle error
			});

		},
		data () {
			return {
				msg: 'Welcome to Your Vue.js App',
				recentPosts: {}
			}
		}
	}
</script>

<style>

</style>
