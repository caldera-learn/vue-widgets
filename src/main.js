import Vue from 'vue'
import App from './components/App.vue'

import RecentPosts from './components/RecentPosts.vue';
import WPAPI from 'wpapi';

if( 'object' === typeof  CLVJW_CONFIG ){
  const strings = CLVJW_CONFIG.strings;
  for (var [widgetId, args] of Object.entries(CLVJW_CONFIG.widgets)) {
    factoryRecentPosts( args.restURL, widgetId, strings );

  }
}

function  factoryRecentPosts( restURL, widgetId, strings ) {
  return new Vue({
    el: '#' + widgetId,
    components: {
      'recent-posts': RecentPosts
    },
    template: `<div><recent-posts :posts="recentPosts"></recent-posts>`,
    beforeMount(){
      this.wp = new WPAPI({ endpoint: restURL });
      this.wp.posts().embed().then( ( r ) => {
        this.recentPosts = r;
      }).catch(( err ) => {
        // handle error
      });

    },
    data () {
      return {
        recentPosts: {},
        strings: strings
      }
    }
  });
}
