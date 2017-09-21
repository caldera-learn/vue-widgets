# A Collection Of VueJS Powered WordPress Widgets

The reason for building  of this plugin is, in order of importance:
* Try out and improve [VueJS plugin boilerplate](https://github.com/caldera-learn/vue-webpack-wordpress-plugin) I'm working on.
* Have something to teach later.
* Experiment with diffferent ways to use VueJS and [the API client](https://github.com/WP-API/node-wpapi).
* Release a cool plugin on dot org eventually.

Important: No build file is currently avaible. You must use Composer and NPM after git pulling to get a working plugin. See development notes below.

## Widgets
One so far!
### Recent Posts
Can be from any site and has a list and preview mode.

Notes:
* If you don't use same site's REST URL, other site must have proper CORS headers for cross-origin request.
* CSS on this is fugly. Pull request welcome.

## Development
After git checkout, switch to directory and

* `npm install`
* `npm run dev`
* `composer install`
