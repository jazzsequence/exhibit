/**
 * Main.js
 */

/** Global Router */
( function( $, _, undefined ) {
	var apiUrl = 'http://exhibit.dev/wp-json', // TODO: this needs to not be hard-coded
		$element = $( '#js-data' );

	/**
	 * Event handler for visitors that click the logo image.
	 * This isn't currently used because there is no logo image element.
	 *
	 * Routes visitors to the homepage when they click the logo.
	 *
	 * @param  {object} event    Event object.
	 */
	/*
	$logo.click( function( event ) {
		event.preventDefault();
	*/
		/**
		 * Route to the homepage view.
		 *
		 * This is the same as calling:
		 * listPostswithPagination( '1' );
		 * history.pushState( null, null, 'http://wpapi.dev/' );
		 */
	/*
		router.setRoute( '/' );
	});
	*/

	/**
	 * Single Post route callback.
	 *
	 * @param  {string} postName - The post slug.
	 */
	var viewPost = function( postName ) {
		$.get( apiUrl + '/posts/?filter[name]=' + postName + '&_embed', function( data ) {
			var output = data[0],
				template = _.template( $( '#post-tmpl' ).html(), output );

			$element.html( template );
		});
	};

	/**
	 * Homepage and Post list pagination routes callback.
	 *
	 * @param  {string} page - Pagination location.
	 */
	var listPostswithPagination = function( page ) {
		page = typeof page !== 'undefined' ? page : '1';

		$.get( apiUrl + '/posts?page=' + page, function( data, textStatus, jqxhr ) {
			var output = { data: data },
				currentPage = parseInt( page, 10 ),
				maxPages = parseInt( jqxhr.getResponseHeader( 'X-WP-TotalPages' ), 10 ),
				template;
			// console.log(output);
			if ( currentPage > 1 ) {
				output.previous = currentPage - 1;
			}

			if ( currentPage < maxPages ) {
				output.next = currentPage + 1;
			}

    		template = _.template( $( '#posts-tmpl' ).html(), output );

			$element.html( template );

			/**
			 * Click event handler for a single view of a listed Post.
			 *
			 * @param  {Object} event - Event object.
			 */
			$( '.js-single-post' ).click( function( event ) {
				event.preventDefault();
				var slug = $( this ).data( 'name' );

				router.setRoute( '/news/' + slug );

				// Scroll to the top of the page.
				$( 'html, body' ).animate( { scrollTop: 0 }, 'slow' );
			});
		});
	};

	/**
	 * Define our routing paths and their accompanying callbacks.
	 *
	 * @type {Object}
	 */
	var routes = {
		'/': listPostswithPagination,
		'/:page': listPostswithPagination,
		'/news/:postName': viewPost
	};

	/**
	 * The Router object for our routes.
	 */
	var router = new window.Router( routes );

	router.configure( { html5history: true } );

	router.init();


})( jQuery, _ );


/**
 * Date Formatting function.
 * @since 0.2.1
 */
function exhibitFormatDate( date ) {
	var theDate = new Date(date);

	// This stuff comes from this article: http://www.elated.com/articles/working-with-dates/
	var month_names = new Array ( );
	month_names[month_names.length] = "January";
	month_names[month_names.length] = "February";
	month_names[month_names.length] = "March";
	month_names[month_names.length] = "April";
	month_names[month_names.length] = "May";
	month_names[month_names.length] = "June";
	month_names[month_names.length] = "July";
	month_names[month_names.length] = "August";
	month_names[month_names.length] = "September";
	month_names[month_names.length] = "October";
	month_names[month_names.length] = "November";
	month_names[month_names.length] = "December";

	var day_names = new Array ( );
	day_names[day_names.length] = "Sunday";
	day_names[day_names.length] = "Monday";
	day_names[day_names.length] = "Tuesday";
	day_names[day_names.length] = "Wednesday";
	day_names[day_names.length] = "Thursday";
	day_names[day_names.length] = "Friday";
	day_names[day_names.length] = "Saturday";

	var output = day_names[theDate.getDay()] + ", " + month_names[theDate.getMonth()] + " " + theDate.getDate() + ", " + theDate.getFullYear();

	return output;
}

/**
 * Function to return post terms and links.
 * @since 0.2.1
 */
function exhibitGetCategories( terms ) {
	var term_list = '';
	var index, count;
	var categories = terms.category;
	for ( index = 0, count = exhibitObjectLength(categories); index < count; ) {
		term_list = term_list + '<a href="' + categories[index].link + '">' + categories[index].name + '</a>';
		++index;

		if ( index !== count ) {
			term_list = term_list + ', ';
		}
	};

	return term_list;
}

/**
 * Function to get the length (count) of an object
 * @param  {object} obj The object to count.
 * @return {int}        The number of elements in the object.
 * @link                http://stackoverflow.com/a/2693037
 * @since  0.2.1
 */
function exhibitObjectLength( obj ) {
	var result = 0;
	for(var prop in obj) {
		if (obj.hasOwnProperty(prop)) {
			// or Object.prototype.hasOwnProperty.call(obj, prop)
			result++;
		}
	}
	return result;
}

/**
 * Attempts to return the classes for the post the same way post_class() does in WordPress core.
 * @param  {object} post The post object.
 * @return {string}      The classes for the post wrapped in class="".
 * @since  0.2.2
 */
function postClass( post ) {
	var classes = '';
	console.log (post.type);
	console.log(post.status);
	console.log(post.format);
	console.log(post.ID);
	console.log(post.sticky);
	classes = post.type + ' type-' + post.type + ' status-' + post.status + ' format-' + post.format + ' hentry post-' + post.ID;

	if ( true == post.sticky ) {
		classes = classes + ' sticky';
	}

	classes = 'class="' + classes + '"';

	return classes;
}