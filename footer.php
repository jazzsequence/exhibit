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
			<article <%= postClass(post) %> id="post-<%= post.ID %>">
				<?php tha_entry_before(); ?>
					<section class="entry media">
						<?php tha_entry_top(); ?>
						<% if ( post.featured_image !== null ) { %>
							<div class="featured pull-left" id="attachment-<%= post.featured_image.ID %>">
								<img class="alignleft" src="<%= post.featured_image.attachment_meta.sizes.thumbnail.url %>">
							</div>
						<% } %>
						<div class="media-body">
							<h1><a class="js-single-post" data-name="<%= post.slug %>" href="<?php echo sprintf( '%1$s/%2$s', esc_url( home_url( 'news' ) ), '<%= post.slug %>' ); ?>">
								<%= post.title %>
							</a></h1>
							<%= post.excerpt %>
						</div>
						<?php tha_entry_bottom(); ?>
					</section>
				<?php tha_entry_after(); ?>
			</article>
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
		<% var postDate = exhibitFormatDate(date) %>
		<article <?php post_class(); ?> id="post-<%= ID %>">
			<?php tha_entry_before(); ?>
			<section class="entry">
				<?php tha_entry_top(); ?>
			<% if ( featured_image !== null ) { %>
				<div class="featured" id="attachment-<%= featured_image.ID %>">
					<img class="aligncenter" src="<%= featured_image.source %>">
				</div>
			<% } %>
			<div id="post-<%= ID %>">
				<h1><%= title %></h1>
				<% _.each( terms, function( term ) {
				//	console.log(term);
				}); %>
				<% var category_list = exhibitGetCategories(terms); %>
				<% if ( author ) {
					var authorURL = null;
					var authorDisplay = author.name;
					if ( author.URL ) {
						authorURL = author.URL;
						authorDisplay = '<a href="' + author.URL + '">' + author.name + '</a>';
					} %>
					<p class="postmetadata">
						<div class="media">
							<div class="media-body">
								<?php echo sprintf( esc_html__( 'Posted in %1$s on %2$s by %3$s', 'exhibit' ), '<%= category_list %>', '<% print( postDate ) %>', '<%= authorDisplay %>' ); ?>
							</div>
							<div class="media-right thumbnail pull-right">
								<img src="<%= author.avatar %>" alt="<?php echo sprintf( __( 'Avatar for %s', 'exhibit' ), '<% author.name %>' ); ?>" height="50" width="50" />
							</div>
						</div>
					</p>
				<% } else { %>
					<p class="postmetadata"><?php echo sprintf( esc_html__( 'Posted in %1$s on %2$s', 'exhibit' ), '<%= terms.category[0].name %>', '<% print( postDate ) %>' ); ?></p>
				<% } %>

				<%= content %>
			</div>
		</article>
	</script>
</html>
