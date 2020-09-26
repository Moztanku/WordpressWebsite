<?php get_header();?>
    <!-- SINGLE -->
    <?php $category = get_the_category(); ?>
    <div class="page-single">
        <a href="<?php echo get_home_url(); ?>" class="mainpage-link">Powrót do Strony Głownej</a>
        <a href="<?php echo get_category_link($category[0]->term_id); ?>" class="category-link">Powrót do <?php echo $category[0]->name ?></a>
        <div class="article">
            <div class="section-heading-box">
                <div class="heading-line"></div>
                <h2 class="section-header"><?php the_title(); ?></h2>
            </div>

            <?php if(have_posts()) : while(have_posts()) : the_post();?>
                <p><?php the_content(); ?></p>
            <?php endwhile; endif; ?>
        </div>
    </div>
<?php get_footer();?>