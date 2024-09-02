<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <link rel="stylesheet" href="<?php echo get_stylesheet_uri()?>"> -->
    <!-- <script src="https://cdn.bootcdn.net/ajax/libs/jquery/3.7.1/jquery.js"></script> -->
    <!-- <script src="<?php echo esc_url(get_template_directory_uri()).'/assets/js/jquery.js'?>"></script> -->
    <?php
      wp_head();

      if(is_single()){
        echo '<script>hljs.highlightAll();</script>';
      }
    ?>
</head>
<body>
    <header>
        <div class="container">
            <div class="name" style="font-weight: bold;">
                <a href="<?php
                  echo home_url();
                ?>">
                <?php
                  echo bloginfo( 'name' );
                ?>
                </a>
            </div>
            <div class="nav">
                <?php
                  get_search_form();//搜索框
                  echo wp_nav_menu( array( 
                    'container' => 'div',//容器标签 
                    'container_class' => 'navbar-box',//ul父节点class值 
                    'container_id' => 'nav-bar',//ul父节点id值 
                    'theme_location' => 'menus123',//导航别名 
                    'items_wrap' => '<ul class="navbar-nav">%3$s</ul>', //包装列表 
                    ) );
                ?>
            </div>
        </div>
        
        <?php

var_dump(is_date(),'is_date()<br>');
var_dump(is_year(),'is_year()<br>');
var_dump(is_month(),'is_month()<br>');
var_dump(is_day(),'is_day()<br>');
        
          if(is_home()){

          
          ?>
          <div class="big-container">
              <div class="big-img" style="background-image: url(<?php echo get_template_directory_uri();?>/assets/images/bg-big.jpg);"></div>
              <div class="big-main">
                <?php
                  get_search_form(array(
                    'echo'       => true,
                    'aria_label' => '测试无障碍文字',
                  ));//搜索框
                ?>
              </div>
          </div>
          <?php
          }
        ?>
    </header>