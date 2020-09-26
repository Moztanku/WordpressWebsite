<?php 
    get_header();
?>
        <div class="slider-box">
            <?php
                echo do_shortcode('[smartslider3 slider="2"]');
            ?>
        </div>
        <?php //przygotowanie danych - Aktualności
            $category_exist = get_category_by_slug('aktualnosci');
            if($category_exist){
                $category_id = $category_exist -> term_id;
                $category_link = get_category_link( $category_id );
                $category_name = get_cat_name( $category_id );
                $sticky = get_option( 'sticky_posts' );
                $stickyArgs = array(
                    'posts_per_page' => 9,
                    'order'=> 'DESC', 
                    'orderby' => 'date',
                    'category' => $category_id,
                    'post__in' => $sticky,
                    'ignore_sticky_posts' => 0
                );
                $stickyPostsList = get_posts( $stickyArgs );
                $stickyPostsListCount = count($stickyPostsList);
                $numberOfOtherPossiblePosts = 9 - $stickyPostsListCount;
                $args = array( 
                    'numberposts' => $numberOfOtherPossiblePosts, 
                    'order'=> 'DESC', 
                    'orderby' => 'date',
                    'category' => $category_id,
                    'post__not_in' => $sticky,
                    'ignore_sticky_posts' => 1
                );
                $postsList = get_posts( $args );
                $concatArrays = array_merge($stickyPostsList, $postsList);
                $allPostCount = count($concatArrays);
                if($allPostCount % 3 == 0){
                    $allPages = floor($allPostCount / 3);
                } else {
                    $allPages = floor(($allPostCount / 3) + 1);
                }
                $currentPost = 0;
            }
        ?>
        <?php if($category_exist){ ?>
        <div class="section-box">
            <div class="section-heading-box">
                <div class="heading-line"></div>
                <h3 class="section-header"><!--<a href="<?php echo $category_link; ?>">--><?php echo $category_name; ?><!--</a>--></h3>
            </div>
            <div class="arrow-box arrow-left">
                <img src="<?php echo get_template_directory_uri(); ?>/img/left-arrow.png" alt="left arrow" class="overflow-arrow arrow-disabled" id="s1bl">
            </div>
            <div class="arrow-box arrow-right">
                <img src="<?php echo get_template_directory_uri(); ?>/img/right-arrow.png" alt="right arrow" class="overflow-arrow" id="s1br">
            </div>
<?php for($i = 0; $i < $allPages; $i++){ ?>
            <div class="container first-section" id="first-section-<?php echo $i ?>">
                    <div class="row">
                    <?php 
                        for($a = 0; $a < 3; $a++){ 
                            if($currentPost == $allPostCount) break;
                            $post = $concatArrays[$currentPost];
                    ?>
                        <div class="col-md-12 col-lg-4  news-box-article <?php if(is_sticky($post -> ID)){ echo "article-sticky";}; ?>">
                            <a href="<?php echo get_permalink($post); ?>">
                                <?php
                                    if(has_post_thumbnail($post)){
                                        echo get_the_post_thumbnail($post);
                                    } else {
                                        // DEFAULT IMG W PRZYPADKU BRAKU ZDEFINIOWANIA GRAFIKI
                                        echo '<img src="'.get_template_directory_uri().'/img/artykuly/news_default.png" alt="news_default" class="wp-post-image">';
                                    }
                                ?>
                                <?php
                                    $create_date = get_the_date('',$post);
                                    $update_date = get_the_modified_date('',$post);
                                    $update_time = get_the_modified_time('',$post);
                                    echo '<div class="post-date date-create">'.$create_date.'</div>';
                                    if($create_date != $update_date){
                                        echo '<div class="post-date date-update">(Aktualizacja '.$update_date.', '.$update_time.')</div>';
                                    }
                                ?>
                                <h4><?php the_title(); ?></h4>
                                <p><?php the_excerpt(); ?></p>
                            </a>
                        </div>
                    <?php 
                        $currentPost++;
                        } 
                    ?>
                </div>
            </div>
<?php } ?>
            <a href="<?php echo get_category_link($category_id); ?>" class="all-posts">Zobacz wszystkie aktualności...</a>
        </div>
        <?php }; ?>
        <?php //przygotowanie danych - Sekcje szkolne
            $category_exist = get_category_by_slug('sekcje-szkolne');
            if($category_exist){
                $parent_category_id = $category_exist -> term_id;
                $args_category = array(
                    'hide_empty' => 0,
                    'parent' => $parent_category_id
                );
                $subcats = get_categories($args_category);
        ?>
        <div class="section-box zstie-box-sections">
            <div class="section-heading-box">
                <div class="heading-line"></div>
                <h3 class="section-header">Szkolne sekcje</h3>
            </div>
            <div class="container">
                <div class="arrow-box arrow-left">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/left-arrow.png" alt="left arrow" class="overflow-arrow arrow-disabled" id="s2bl">
                </div>
                <div class="arrow-box arrow-right">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/right-arrow.png" alt="right arrow" class="overflow-arrow" id="s2br">
                </div>
                <div class="row second-section" id="second-section-mobile">
                <?php 
                    $sectionCount = 0;
                    foreach ($subcats as $sc) {
                        if($sectionCount%3==0 && $sectionCount != 0){ //Co 3 sekcje
                            break;
                        }
                        $subcat_id = $sc -> term_id;
                        $args_firstpost_subcat = array(
                            'posts_per_page' => 1,
                            'order'=> 'ASC', 
                            'orderby' => 'date',
                            'category' => $subcat_id,
                            'ignore_sticky_posts' => 0
                        );
                        $mainPosts = get_posts($args_firstpost_subcat);
                    ?>
                    <?php foreach($mainPosts as $mainPost) :  setup_postdata($mainPost); ?>
                        <?php //if(is_sticky($mainPost -> ID)) {?>
                            <div class="col-sm-12 col-md-12 col-lg-12 zstie-section-box-article">
                                <a href="<?php echo get_category_link($subcat_id); ?>">
                                    <h4><?php echo $sc -> name; ?></h4>
                                    <?php  
                                        if(has_post_thumbnail($mainPost)){
                                            echo get_the_post_thumbnail($mainPost);
                                        }
                                    ?>
                                </a>
                            </div>
                            <?php 
                            if($sectionCount%3==0 && $sectionCount != 0){ //Co 3 sekcje
                                echo "<br>";
                            }
                            ?>
                        <?php $sectionCount++; //}?>
                    <?php endforeach; ?>
        <?php  } ?>
                </div>
                <div class="row second-section" id="second-section-0">
                    <?php 
                    $sectionCount = 0;
                    foreach ($subcats as $sc) {
                        if($sectionCount%6==0 && $sectionCount != 0){ //Co szóstą sekcje
                            echo '</div>';
                            echo '<div class="row second-section" id="second-section-'.($sectionCount/6).'">';
                        }
                        $subcat_id = $sc -> term_id;
                        $args_firstpost_subcat = array(
                            'posts_per_page' => 1,
                            'order'=> 'ASC', 
                            'orderby' => 'date',
                            'category' => $subcat_id,
                            'ignore_sticky_posts' => 0
                        );
                        $mainPosts = get_posts($args_firstpost_subcat);
                    ?>
                    <?php foreach($mainPosts as $mainPost) :  setup_postdata($mainPost); ?>
                        <?php //if(is_sticky($mainPost -> ID)) {
                            if(has_post_thumbnail($mainPost)){    
                        ?>
                            <div class="col-sm-12 col-md-4 zstie-section-box-article">
                                <a href="<?php echo get_category_link($subcat_id); ?>">
                                    <h4><?php echo $sc -> name; ?></h4>
                                    <?php  
                                        
                                            echo get_the_post_thumbnail($mainPost);
                                        
                                    ?>
                                </a>
                            </div>
                        <?php 
                            }
                            $sectionCount++;//} 
                            if($sectionCount%3==0 && $sectionCount != 0 && $sectionCount != 6){ //Co 3 sekcje
                                echo '<hr>';
                            }
                        ?>
                    <?php endforeach;?>
                    
        <?php  }} ?>
                </div>
            </div>
            <a href="<?php echo get_category_link($parent_category_id); ?>" class="all-posts">Zobacz wszystkie sekcje...</a>
        </div>
        <?php //przygotowanie danych - Projekty
            $category_exist = get_category_by_slug('projekty');
            if($category_exist){
                $parent_category_id = $category_exist -> term_id;
                $args_category = array(
                    'child_of' => $parent_category_id
                );
                $subcats = get_categories($args_category);
        ?>
        <div class="section-box zstie-box-projects">
            <div class="section-heading-box">
                <div class="heading-line"></div>
                <h3 class="section-header">Projekty</h3>
            </div>
            <div class="container">
                <div class="row">
                    <?php 
                    foreach ($subcats as $sc) {
                        $subcat_id = $sc -> term_id;
                        $args_sticky_posts = array(
                            'posts_per_page' => 1,
                            'order'=> 'DESC',
                            'orderby' => 'date',
                            'category' => $subcat_id,
                            'post__in' => $sticky,
                            'ignore_sticky_posts' => 0
                        );
                        $sticky_post_to_display = get_posts($args_sticky_posts);
                        if(count($sticky_post_to_display) == 0){
                            $args_normal_posts = array(
                                'posts_per_page' => 1,
                                'order'=> 'DESC',
                                'orderby' => 'date',
                                'category' => $subcat_id,
                                'post__not_in' => $sticky,
                                'ignore_sticky_posts' => 1
                            );
                            $normal_post_to_display = get_posts($args_normal_posts);
                            if(count($normal_post_to_display) == 1){
                                $post_to_display = $normal_post_to_display[0];
                            } else {
                                return "error";
                            }
                        } else if(count($sticky_post_to_display) == 1){
                            $post_to_display = $sticky_post_to_display[0];
                        }

                        $args_thumbnail_posts = array(
                            'posts_per_page' => 1,
                            'order'=> 'ASC',
                            'orderby' => 'date',
                            'category' => $subcat_id
                        );
                        $thumbnail_post_to_display = get_posts($args_thumbnail_posts);
                        if(count($thumbnail_post_to_display) == 0){
                            $args_normal_thumbnail = array(
                                'posts_per_page' => 1,
                                'order'=> 'DESC',
                                'orderby' => 'date',
                                'category' => $subcat_id,
                                'post__not_in' => $sticky,
                                'ignore_sticky_posts' => 1
                            );
                            $thumbnail_post_to_display = get_posts($args_normal_thumbnail);
                            if(count($thumbnail_post_to_display) == 1){
                                $thumbnail_to_display = $thumbnail_post_to_display[0];
                            } else {
                                return "error";
                            }
                        } else if(count($thumbnail_post_to_display) == 1){
                            $thumbnail_to_display = $thumbnail_post_to_display[0];
                        }
                        //$post_to_display = $normal_post_to_display[0];
                        ?>
                            <div class="col-sm-12 col-md-12 col-lg-4 zstie-section-box-project">
                                <a href="<?php echo get_category_link($subcat_id); ?>">
                                    <div class="content-aligment">
                                        <?php
                                            echo get_the_post_thumbnail($thumbnail_to_display, 'medium');
                                        ?>
                                        <h4 class="main"><?php echo $sc -> name; ?></h4>
                                        <div>
                                            <h4><?php echo $sc -> name; ?></h4>
                                            <p>
                                            <?php
                                                echo get_the_excerpt($post_to_display);
                                            ?>
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
        <?php  }} ?>
                </div>
            </div>
            <a href="<?php echo get_category_link($parent_category_id); ?>" class="all-posts">Zobacz wszystkie projekty...</a>
        </div>
        <?php //przygotowanie danych - Współprace z firmami
            $category_exist_wsp = get_category_by_slug('wspolprace-z-firmami');
            if($category_exist_wsp){
                //print_r($category_exist_wsp);
                $parent_category_id_wsp = $category_exist_wsp -> term_id;
                $args_category_wsp = array(
                    'parent' => $parent_category_id_wsp,
                    'hide_empty' => 0,
                    'order'    => 'ASC'
                );
                //print_r($args_category_wsp);
                $subcats_wsp = get_categories($args_category_wsp);
                //print_r($subcats_wsp);
            /*
                if($category_exist){
                $category_id = $category_exist -> term_id;
                $args = array( 
                    'posts_per_page' => 999,
                    'order'=> 'ASC', 
                    'orderby' => 'date',
                    'category' => $category_id
                );
                $postsList = get_posts( $args );
            */
        ?>
        <div class="section-box wspolprace pb-2">
            <div class="section-heading-box">
                <div class="heading-line"></div>
                <h3 class="section-header">Współprace z firmami</h3>
            </div>
            <div class="container">
                <div class="arrow-box arrow-left">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/left-arrow.png" alt="left arrow" class="overflow-arrow arrow-disabled" id="s3bl">
                </div>
                <div class="arrow-box arrow-right">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/right-arrow.png" alt="right arrow" class="overflow-arrow" id="s3br">
                </div>
                <div class="row third-section" id="third-section-0">
                <?php
                    $sectionCount_wsp = 0;
                    foreach ($subcats_wsp as $sc_wsp) {
                        if($sectionCount_wsp%6==0 && $sectionCount_wsp != 0){
                            echo '</div><div class="row third-section" id="third-section-'.($sectionCount_wsp/6).'">';
                        }
                        $subcat_id_wsp = $sc_wsp -> term_id;
                        $args_firstpost_subcat_wsp = array(
                            'posts_per_page' => 1,
                            'order'=> 'ASC', 
                            'orderby' => 'date',
                            'category' => $subcat_id_wsp,
                            'ignore_sticky_posts' => 0
                        );
                        $mainPosts_wsp = get_posts($args_firstpost_subcat_wsp);
                        //print_r($mainPosts_wsp);
                ?> 
                 <?php foreach($mainPosts_wsp as $mainPost_wsp) :  setup_postdata($mainPost_wsp); ?>
                    <?php if ( has_post_thumbnail($mainPost_wsp) ) { ?>
                        <div class="col-md-4 col-lg-2">
                            <a href="<?php echo get_category_link($sc_wsp); ?>">
                                <?php
                                    echo get_the_post_thumbnail($mainPost_wsp, 'thumbnail', array( 'class' => 'mx-auto' ) );
                                ?>
                            </a>
                        </div>
                    <?php }; ?>
                <?php 
                    $sectionCount_wsp += 1;
                    endforeach;
                ?>
            <?php }; }; ?>
                </div>
            </div>
        </div>
<?php get_footer();?>