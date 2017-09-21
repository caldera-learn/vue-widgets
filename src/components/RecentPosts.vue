<template>
	<div>
		<article v-for="post in posts" class="clvw-recent-posts" v-if="!inPreview">
			<a v-bind:href="post.link" target="_blank">
				<h3 class="post-title" v-html="post.title.rendered">
				</h3>
			</a>
			<a href="#" @click.prevent="preview(post.id)">
				Preview
			</a>
		</article>
		<div v-if="inPreview">
			<post-preview :post="currentPost" :featured="previewFeatured"></post-preview>
			<a href="#" @click.prevent="exitPreview()">Exit Preview</a>
		</div>
	</div>
</template>
<script>
	import PostPreview from './PostPreview.vue';
	export  default {
		props : {
			posts : {
				type: Object,
				default: {}
			}
		},
		components: {
			'post-preview' : PostPreview,
		},
		methods: {
			preview(id){
				this.currentPost = this.posts.find(post => post.id === id);
				this.$parent.wp.media().id( this.currentPost.featured_media ).then( ( r ) => {
					this.previewFeatured = r.description.rendered;
				}).catch(( err ) => {
					// handle error
				});

				this.inPreview = true;
			},
			exitPreview(){
				this.inPreview = false;
				this.currentPost = {};
				this.previewFeatured = '';

			}
		},
		data(){
			return{
				currentPost: {},
				inPreview: false,
				previewFeatured: ''
			}
		}
	}
</script>