<?php
  get_header();//获取头部部分。

?>
<main class="container">
  <div class="main-box">
    <div class="container-main">

        <?php
          the_archive_title('<h1>','</h1>');
        ?>
      
        <div id="lists">
          <?php
            
            // 获取文章列表
            while(have_posts()){
              the_post();
              get_template_part('templates/cons');         
            }
            // 文章分页
            the_posts_pagination( array(
              'mid_size' => 3, //当前页码数的 两边 显示几个页码。
              'prev_text' =>'上一页', //上一页
              'next_text' =>'下一页', //下一页
              'screen_reader_text'=>' '
              ) );
          ?>
        </div>
    </div>

    <div class="sider-bar">      
      <?php
        get_sidebar();
        get_sidebar('test2');
      ?>
    </div>
  </div>
</main>

<?php
  get_footer();

?>
