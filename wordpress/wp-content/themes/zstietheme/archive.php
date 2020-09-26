<?php get_header();?>
    <!-- ARCHIVE -->
    <?php 
        global $wp;
        $current_url = home_url( add_query_arg( array(), $wp->request ) );
        $category = get_the_category();
        $url_array = explode('/',$current_url); 

        $slugByUrl = $url_array[count($url_array)-1];
        $slugByCategory = $category[0] -> slug;

        if($slugByUrl == $slugByCategory) $mainCategory = true;
        else $mainCategory = false;

        if($category[0]->parent == 0) $hasParent = false;
        else $hasParent = true;

        if(!$hasParent){ //Jeżeli nie ma rodzica
            $returnCategory = $category[0];
        } else { // Jeżeli ma rodzica
            $parentCategory = get_category($category[0]->parent);
            $returnCategory = $parentCategory;
        }

        if(isset($_GET["page"])){
            $page_url = $_GET['page'];
        } else {
            $page_url = 0;
        }

        //print_r($returnCategory);
    ?>
    <div class="page-archive">
        <div class="section-heading-box">
            <div class="heading-line"></div>
            <h1 class="section-header"><?php single_cat_title(); ?></h1>
        </div>
        <a href="<?php echo get_home_url(); ?>" class="mainpage-link">Powrót do Strony Głownej</a>
        <?php if($hasParent && $mainCategory){ ?>
            <a href="<?php echo get_category_link($returnCategory->term_id); ?>" class="category-link">Powrót do <?php echo $returnCategory->name ?></a>
        <?php } ?>
        <?php 
            //if(have_posts()) : while(have_posts()) : the_post();
            $mainCategoryObject = get_category_by_slug($slugByUrl);
            // Jeżeli posiada - Pobranie subkategorii
            $args_subcategories = array(
                'child_of' => $mainCategoryObject->term_id
            );
            $subcats = get_categories($args_subcategories);

            $czyWyswietlacPodkategorieWKategorii = false;
            if($slugByUrl == "sekcje-szkolne") $czyWyswietlacPodkategorieWKategorii = true;
            else if($slugByUrl == "projekty") $czyWyswietlacPodkategorieWKategorii = true;

            if(count($subcats) <= 0 && $page_url == 0){
                $page_url = 1;
                //header('Location: '.home_url( $wp->request ).'?page=1'); // - PRZEKIEROWANIE DO STRONY 1 W PRZYPADKU BRAKU PODKATEGORII
            }
            if(!$czyWyswietlacPodkategorieWKategorii && $page_url == 0){
                $page_url = 1;
            }
            if(count($subcats) > 0 && $czyWyswietlacPodkategorieWKategorii){
                //print_r($subcats);
                //Wypisanie subkategorii
                ?>
                <div class="categories-box row">
                        <?php
                        $cat_count = 0;
                        if($page_url == 0){
                            foreach($subcats as $subcat){
                                $subcat_id = $subcat -> term_id;
                                $args_firstpost_subcat = array(
                                    'posts_per_page' => 1,
                                    'order'=> 'ASC', 
                                    'orderby' => 'date',
                                    'category' => $subcat_id,
                                    'ignore_sticky_posts' => 0
                                );
                                $mainPosts = get_posts($args_firstpost_subcat); 
                                if(count($mainPosts) > 0){
                                    $mainPost = $mainPosts[0];
                                    if(has_post_thumbnail($mainPost)){?>
                                <div class="col-md-12 col-lg-4 category">
                                    <a href="<?php echo get_category_link($subcat_id); ?>" class="subcategory-link">
                                        <?php
                                            
                                                
                                                    echo get_the_post_thumbnail($mainPost, 'medium');
                                                
                                            
                                        ?>
                                        <h2 class="category-name"><?php echo get_cat_name($subcat_id); ?></h2>
                                    </a>
                                </div>
                                <?php
                                $cat_count++;
                                }}
                                
                                if($cat_count%3==0 && $cat_count!=0){
                                    echo "<hr>";
                                }
                            }
                        }
                        ?>
                </div>
                <?php 
            }
            // Jeżeli posiada - Pobranie postów w kategorii (pobranie kategorii przez Slug)
                $args_posts = array(
                    'posts_per_page' => 999,
                    'order'=> 'DESC',
                    'orderby' => 'date',
                    'category' => $mainCategoryObject->term_id
                );
                $posts = get_posts($args_posts);
                $post_count = count($posts);
                if($post_count > 0){
                    //print_r($posts);
                    //Wypisanie postów
                    ?>
                    <div class="posts-box">
                    <?php
                    //foreach($posts as $post){
                    for($i = ($page_url-1)*5; $i < $page_url*5; $i++){
                        $post = $posts[$i];
                        $create_date = get_the_date('',$post->ID);
                        $create_time = get_the_time('',$post->ID);
                        $update_date = get_the_modified_date('',$post->ID);
                        $update_time = get_the_modified_time('',$post->ID);
                        $wasEdited = true;
                        if($create_date == $update_date && $create_time == $update_time){
                            $wasEdited = false;
                        }
                        if($page_url >= 1){
                        ?>
                            <a href="<?php echo get_post_permalink($post->ID);?>test" class="post-link">
                                <div class="post <?php if(is_sticky($post->ID)) echo "post-highlight"; ?>">
                                    <h3 class="post-header"><?php the_title(); ?></h3>
                                    <div class="post-date-create">Utworzono: <?php print($create_date); echo " "; print($create_time); ?></div>
                                    <?php
                                        if($wasEdited){
                                            ?>
                                                <div class="post-date-update">| Aktualizacja: <?php print($update_date); echo " "; print($update_time); ?></div>
                                            <?php 
                                        }
                                    ?>
                                    <p class="post-content"><?php the_excerpt(); ?></p>
                                </div>
                            </a>
    
                        <?php
                        }
                        if($post_count-1 <= $i){
                            $end_of_pages = true;
                            break;
                        } else {
                            $end_of_pages = false;
                        }
            }
                ?>
                </div>
                <div class="page-control">
                    <?php 
                        $obj_id = get_queried_object_id();
                        $current_url = get_permalink( $obj_id );
                        if($page_url>1){
                            echo '<a href="'.get_category_link($mainCategoryObject->term_id).'?page='.($page_url-1).'" id="prev-page">';
                            echo '<img src="'.get_template_directory_uri().'/img/left-arrow.png" alt="left arrow" class="overflow-arrow">';
                            echo '</a>';
                        }
                        if($page_url == 0){
                            echo '<div class="right-arrow-text">Przejdź do wpisów</div>';
                        }
                        if(!$end_of_pages){
                            echo '<a href="'.get_category_link($mainCategoryObject->term_id).'?page='.($page_url+1).'" id="next-page">';
                            echo '<img src="'.get_template_directory_uri().'/img/right-arrow.png" alt="right arrow" class="overflow-arrow">';
                            echo '</a>';
                        }
                    ?>
                </div> 
                <?php
                
            }

            /*
            $create_date = get_the_date('',get_the_ID());
            $create_time = get_the_time('',get_the_ID());
            $update_date = get_the_modified_date('',get_the_ID());
            $update_time = get_the_modified_time('',get_the_ID());
            $wasEdited = true;
            if($create_date == $update_date && $create_time == $update_time){
                $wasEdited = false;
            }
            */
        ?>
            <!--
            
            -->
        <?php //endwhile; endif; ?>
    </div>
<?php get_footer();?>


<?php ?>