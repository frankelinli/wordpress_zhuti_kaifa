<?php
  get_header();//获取头部部分。

?>
<main class="container">
  <div class="main-box">
    <div class="container-main">
        <!-- 文章内容 -->
        <div id="contents" class="card-box">
          <?php


            // 获取文章
            the_post();
            $cateArray = get_the_category(get_the_ID());

            // echo get_the_author_meta('ID');
            the_title('<h1>','</h1>');
            $author_url = get_author_posts_url(get_the_author_meta('ID'));
            echo '<a href="'.$author_url.'">'.get_the_author().'</a>';
            
            
            echo get_the_date('Y-m-d H:i:s');
            ?>
            <div>
              阅读：(
                <?php
                  echo set_hits(get_the_ID());
                ?>
              )次
            </div>
            <div class="line">
              <?php
                
                foreach ($cateArray as $key => $value) {
                  echo $value->cat_name.' ';
                }
                
              ?>
            </div>
            <?php       
            the_content();

            wp_link_pages();


            
          ?>
        </div>
        <!-- 文章推荐 -->
        <div class="card-box navs">
            <?php
            
            the_post_navigation(
                array(
                    'prev_text' => '<span class="nav-subtitle">上一篇：</span> <span class="nav-title">%title</span>',
                    'next_text' => '<span class="nav-subtitle">下一篇：</span> <span class="nav-title">%title</span>',
                    'screen_reader_text' => ' ',
                    'class'              => 'post-navigation-maoshu',
                    )
                );
            ?>
        </div>
        <div class="card-box comments">
        <?php
            comments_template();
        ?>
        </div>
    </div>

    <div class="sider-bar">      
      <?php
        get_sidebar();
        get_sidebar('test2');
      ?>
      <div class="card-box ">
      <?php
        $posts  =  get_posts(array(
          'numberposts'      => 30,
          'posts_per_page'=>10,
          // 'category'         => get_the_category(get_the_ID())[0]->cat_ID,
          'orderby'          => 'meta_value_num',
          'meta_key'=>'hits',
          'order'            => 'DESC',

          // 'orderby'=>'post__in',
          // 'post__in'=>array(16,51,49),
          // 'include'          => array(121190,166),
          // 'exclude'          => array(get_the_ID()),
          // 'meta_key'         => '',
          // 'meta_value'       => '',
          // 'post_type'        => 'post',
          // 'suppress_filters' => true,
        ));
        foreach ($posts as $key => $value) {
          echo '
          <div class="list-line">      
            <a href="'.get_permalink($value->ID).'" target="_blank">
            '.$value->post_title.'
            </a>
          </div>
          ';
        }

      ?>
      </div>
    </div>
  </div>
</main>

<?php
  get_footer();

?>
