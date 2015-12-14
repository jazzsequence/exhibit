<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package exhibit
 */

?>

		<?php tha_footer_before(); ?>
		<footer class="row">
			<?php tha_footer_top(); ?>
			<p class="credit">
				<?php echo wp_kses_post( sprintf( __( 'Powered by the <a href="%s">WP REST API</a>', 'exhibit' ), 'https://github.com/WP-API/WP-API' ) ); ?>
			</p>
			<?php tha_footer_bottom(); ?>
		</footer>
		<?php tha_footer_after(); ?>
		<?php wp_footer(); ?>
	</div><!-- closes .container -->

	<?php tha_body_bottom(); ?>
	<?php wp_footer(); ?>
	</body>

	<script id="posts-tmpl" type="text/template">
		<% _.each( data, function( post ) { %>
			<div id="post-<%= post.id %>">
				<h1><a class="js-single-post" data-name="<%= post.slug %>" href="http://wpapi.dev/news/<%= post.slug %>">
					<%= post.title.rendered %>
				</a></h1>
				<%= post.excerpt.rendered %>
			</div>
		<% }); %>
		<div id="pagination">
			<% if ( typeof previous !== 'undefined' ) { %>
				<a class="page-prev" href="http://wpapi.dev/<%= previous %>"><< Previous</a>
			<% } %>

			<% if ( typeof next !== 'undefined' ) { %>
				<a class="page-next" href="http://wpapi.dev/<%= next %>">Next >></a>
			<% } %>
		</div>
	</script>

	<script id="post-tmpl" type="text/template">
		<% if ( typeof _embedded["https://api.w.org/featuredmedia"] !== 'undefined' ) { %>
			<div class="featured" id="attachment-<%= _embedded["https://api.w.org/featuredmedia"][0].id %>">
				<img class="aligncenter" src="<%= _embedded["https://api.w.org/featuredmedia"][0].source_url %>">
			</div>
		<% } %>
		<div id="post-<%= id %>">
			<h1><%= title.rendered %></h1>

			<p class="author-info">Written by: <img src="<%= _embedded.author[0].avatar_urls[24] %>"> <%= _embedded.author[0].name %></p>

			<%= content.rendered %>
		</div>
	</script>
</html>
