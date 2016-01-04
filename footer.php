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
	</div><!-- closes .container -->

	<?php tha_body_bottom(); ?>
	<?php wp_footer(); ?>
	</body>

	<script id="posts-tmpl" type="text/template">
		<% _.each( data, function( post ) { %>
			<div id="post-<%= post.ID %>">
				<h1><a class="js-single-post" data-name="<%= post.slug %>" href="<?php echo sprintf( '%1$s/%2$s', esc_url( home_url( 'news' ) ), '<%= post.slug %>' ); ?>">
					<%= post.title %>
				</a></h1>
				<%= post.excerpt %>
			</div>
		<% }); %>
		<div id="pagination">
			<% if ( typeof previous !== 'undefined' ) { %>
				<a class="page-prev" href="<?php echo sprintf( '%1$s/%2$s', esc_url( home_url() ), '<%= previous %>' ); ?>"><?php echo sprintf( '&laquo; %s', esc_html__( 'Previous', 'exhibit' ) ); ?></a>
			<% } %>

			<% if ( typeof next !== 'undefined' ) { %>
				<a class="page-next" href="<?php echo sprintf( '%1$s/%2$s', esc_url( home_url() ), '<%= next %>' ); ?>"><?php echo sprintf( '%s &raquo;', esc_html__( 'Next', 'exhibit' ) ); ?></a>
			<% } %>
		</div>
	</script>

	<script id="post-tmpl" type="text/template">
		<%= console.log(featured_image) %>
		<% if ( featured_image !== null ) { %>
			<div class="featured" id="attachment-<%= featured_image.ID %>">
				<img class="aligncenter" src="<%= featured_image.source %>">
			</div>
		<% } %>
		<div id="post-<%= ID %>">
			<h1><%= title %></h1>
			<%= console.log(author) %>
			<%= console.log(author.avatar) %>
			<% if ( author ) { %>
				<p class="postmetadata"><?php echo sprintf( esc_html__( 'Posted in %1$s on %2$s by %3$s', 'exhibit' ), '<%= terms.category[0].name %>', '<% print( new Date(date) ) %>', '<%= author.name %>' ); ?></p>
			<% } else { %>
				<p class="postmetadata"><?php echo sprintf( esc_html__( 'Posted in %1$s on %2$s', 'exhibit' ), '<%= terms.category[0].name %>', '<% print( new Date(date) ) %>' ); ?></p>
			<% } %>

			<%= content %>
		</div>
	</script>
</html>
