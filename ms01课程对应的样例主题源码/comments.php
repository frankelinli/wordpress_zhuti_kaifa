<div class="comments-box">
    <h3>评论<span><?php echo get_comments_number();?></span></h3>

    <!-- //评论列表内容 -->
    <?php 
    // wp_list_comments(); 
    wp_list_comments(array(
        // 'max_depth'         => '',
        'style'             => 'ul',
        'callback'          => 'custom_comment',
        // 'end-callback'      => null,
        'type'              => 'all',
        'per_page'          => '',
        // 'avatar_size'       => 16,
        'reverse_top_level' => true,
        'reverse_children'  => true,
    )); 
    ?>

    <!-- //上一页 下一页 -->
    <?php the_comments_navigation();?>

    <!-- //评论输入框 -->
    <?php comment_form(array(
        "fields"=>array(
            "author"=>"请输入你的名称：<input name='author'>",
            'others'=>'其他要说明的内容',
            'others2'=>'其他要说明的内容222',
        ),
        "logged_in_as"=>' '
    )); ?>
</div>