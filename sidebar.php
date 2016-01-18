<?php
/**
 * This is the sidebar.
 *
 * @package Exhibit
 */

?>

<?php tha_sidebars_before(); ?>

 <div class="sidebar">
 	<?php tha_sidebar_top(); ?>
	<ul>
        <?php dynamic_sidebar( 'Sidebar' ); ?>
    </ul>
    <?php tha_sidebar_bottom(); ?>
</div>

<?php tha_sidebars_after();
