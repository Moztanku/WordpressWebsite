<?php get_header();?>
    <!-- PAGE -->
    <?php 
        $parent_id = get_post_ancestors(get_the_ID()); 
        $parent_post = get_post($parent_id[0]);
        $current_post_id = get_the_ID();
    ?>
    <div class="article">
        <a href="<?php echo get_home_url(); ?>" class="mainpage-link">Powrót do Strony Głownej</a>
        <?php if(count($parent_id) != 0) { ?>
            <a href="<?php echo get_permalink($parent_id[0]) ?>" class="category-link">Powrót do <?php echo $parent_post->post_title ?></a>
        <?php } ?>
        <div class="section-heading-box">
            <div class="heading-line"></div>
            <h2 class="section-header"><?php the_title(); ?></h2>
        </div>

        <?php if(have_posts()) : while(have_posts()) : the_post();?>
            <?php the_content(); ?>
        <?php endwhile; endif; ?>
    </div>

<?php get_footer();?>