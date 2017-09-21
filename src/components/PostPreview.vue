<template>
	<article v-bind:id="'clvw-recent-posts-preview-' + post.id" class="clvw-recent-posts-preview">
		<div v-html="featured"></div>
		<h3 class="post-title" v-html="post.title.rendered">
		</h3>
		<div class="entry-content" v-html="post.content.excerpt"></div>
		<a v-bind:href="post.link">
			Read More
		</a>
	</article>
</template>

<script>
	export default {
		props : {
			post : {
				type: Object,

			},
			featured : {
				type: String,
				default: ''
			}
		}

	}
</script>