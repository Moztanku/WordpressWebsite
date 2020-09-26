<?php header('Location: '.get_home_url()); // - PRZEKIEROWANIE DO STRONY GŁOWNEJ ?>
<?php get_header();?>
    <!-- INDEX -->
<?php 
/*
    $string = 'DANE TECHNICZNE *--- OPIS KATEGORII ---*';
    $opis = get_string_between($string,'*---','---*');
    echo $opis;
*/
    $args = array(
        'orderby' => 'name',
        'order' => 'ASC',
        'parent' => 0
    );
    $categories = get_categories($args);
    //print_r($categories);
?>
    <div class="page-index">
        <?php foreach($categories as $category){ 
            //print_r($category);
            if($category->name == "Bez kategorii") continue;
        ?>
        <div class="category">
            <h2 class="category-header"><?php echo $category->name; ?></h2>
            <p class="category-desc"><?php echo get_string_between($category->description,'*---','---*'); ?></p>
            <a href="<?php echo get_category_link($category->term_id); ?>" class="category-more">Zobacz kategorię</a>
        </div>
        <?php } ?>
    </div>
<?php get_footer();?>