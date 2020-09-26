<div class="col-md-12 col-sm-12 col-xsm-12 search-box-item">
    <?php echo sprintf('<a href="%s" rel="bookmark">',esc_url(get_permalink())); ?>
    <h5 class="search-result-h5"><?php the_title() ?></h5>
    </a>
    <aside class="search-result-p"><?php the_excerpt() ?></aside>
</div> 

<?php /*
<!-- 
<div class="container">
<?php

 * The template part for displaying results in search pages
 *
 * Learn more: {@link https://developer.wordpress.org/themes/basics/template-hierarchy/}
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->

	<?php if ( 'post' === get_post_type() ) : ?>

		<footer class="entry-footer">
			
		</footer><!-- .entry-footer -->

	<?php else : ?>

		

	<?php endif; ?>

</article><!-- #post-<?php the_ID(); ?> -->
</div>
<div class="heading-line"></div> -->
*/?>