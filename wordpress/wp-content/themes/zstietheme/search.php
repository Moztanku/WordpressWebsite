<?php get_header()?>
<div class="row page-search"> 
            <?php 
            if(have_posts()){
                while(have_posts()): the_post(); ?>
                    <?php get_template_part('content', 'search') 
                    ?>
                <?php endwhile;
            } else {
                echo "<h3 class='no-search-items'> Brak wyszukań </h3>";
            };
            ?>
    
</div>
<?php get_footer()?>