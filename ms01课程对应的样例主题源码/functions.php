<?php
// 注册：菜单项
register_nav_menus(array(
    'primary' => '主导航菜单',
    'footer' => '页脚菜单',
    'menus123' => '菜单666',
));
// 启用菜单
// add_theme_support( 'menus' );

// 注释长度
function custom_excerpt_length($length) {
    return 20; // 修改文章摘要长度为20个单词
}
add_filter('excerpt_length', 'custom_excerpt_length');

// add_theme_support( 'widgets' );

// functions 自定义侧边栏
function my_custom_sidebar() {
    register_sidebar(
        array (
            'name' => '测试侧边栏',//侧边栏名称
            'id' => 'test-side-bar',//侧边栏ID
            'description' => '这里是侧边栏的描述',//侧边栏描述
            'before_widget' => '<div class="widget-content">',//侧边栏前面的代码
            'after_widget' => "</div>",//侧边栏后面的代码
            'before_title' => '<h3 class="widget-title">',//侧边栏标题的前面的代码
            'after_title' => '</h3>',//侧边栏标题的后面的代码
        )
    );
    
	//可同时注册多个小工具
	register_sidebar(
        array (
            'name' => '测试侧边栏2',//侧边栏名称
            'id' => 'test-side-bar2',//侧边栏ID
            'description' => '这里是侧边栏的描述2',//侧边栏描述
            'before_widget' => '<div class="widget-content2">',//侧边栏前面的代码
            'after_widget' => "</div>",//侧边栏后面的代码
            'before_title' => '<h3 class="widget-title2">',//侧边栏标题的前面的代码
            'after_title' => '</h3>',//侧边栏标题的后面的代码
            // 'before_sidebar' => '前面的html',
		    // 'after_sidebar'  => '后面的html',
        )
    );
}
add_action( 'widgets_init', 'my_custom_sidebar' );


//评论模板
function custom_comment($comment, $args, $depth){
    $GLOBALS['comment'] = $comment; 
    // var_dump($args);
    $ava = get_avatar($comment,'48');
    $author_link = get_comment_author_link();
    // $author = get_comment_author();
    // echo $author;

    echo '
    <li class="comment-list">
        <div class="avatar">
        '.$ava.'
        </div>
        <div class="comment_content">
            <div class="comment_author">
                '.$author_link.'
            </div>
            
            <div class="comment_time">
           '.get_comment_time('Y-m-d H:i:s').'
            </div>
        ';
        ?>
            <div class="edit-line">
                <?php 
                    // 显示评论的编辑链接 
                    edit_comment_link( '编辑', '<p class="edit-link">', '</p>' ); 
                ?>
                <div class="reply">
                    <?php 
                        // 显示评论的回复链接 
                        comment_reply_link( array_merge( $args, array( 
                        'reply_text' =>  '回复', 
                        'after'      =>  ' <span>&darr;</span>', 
                        'depth'      =>  $depth, 
                        'max_depth'  =>  $args['max_depth'] ) ) ); 
                    ?>
                </div>
            </div>
            <?php
              comment_text()
            ?>
        </div>
    </li>
    <?php
}


// 解决头像不显示的问题

if ( ! function_exists( 'get_cravatar_url' ) ) {
    /**
     * 替换 Gravatar 头像为 Cravatar 头像
     *
     * Cravatar 是 Gravatar 在中国的完美替代方案，您可以在 https://cravatar.com 更新您的头像
     */
    function get_cravatar_url( $url ) {
        $sources = array(
            'www.gravatar.com',
            '0.gravatar.com',
            '1.gravatar.com',
            '2.gravatar.com',
            'secure.gravatar.com',
            'cn.gravatar.com',
            'gravatar.com',
        );
        return str_replace( $sources, 'cravatar.cn', $url );
    }
    add_filter( 'um_user_avatar_url_filter', 'get_cravatar_url', 1 );
    add_filter( 'bp_gravatar_url', 'get_cravatar_url', 1 );
    add_filter( 'get_avatar_url', 'get_cravatar_url', 1 );
}
if ( ! function_exists( 'set_defaults_for_cravatar' ) ) {
    /**
     * 替换 WordPress 讨论设置中的默认头像
     */
    function set_defaults_for_cravatar( $avatar_defaults ) {
        $avatar_defaults['gravatar_default'] = 'Cravatar 标志';
        return $avatar_defaults;
    }
    add_filter( 'avatar_defaults', 'set_defaults_for_cravatar', 1 );
}
if ( ! function_exists( 'set_user_profile_picture_for_cravatar' ) ) {
    /**
     * 替换个人资料卡中的头像上传地址
     */
    function set_user_profile_picture_for_cravatar() {
        return '<a href="https://cravatar.com" target="_blank">您可以在 Cravatar 修改您的资料图片</a>';
    }
    add_filter( 'user_profile_picture_description', 'set_user_profile_picture_for_cravatar', 1 );
}

// 获取阅读次数
function get_hits($post_id){
   $count = get_post_meta($post_id,'hits',true);
   return $count===''?0:$count;
}

// 设置阅读次数
function set_hits($post_id){
    $count = get_hits($post_id);
    $key = 'hits';
    if($count == 0){
        delete_post_meta($post_id,$key);
        add_post_meta($post_id,$key,1);
    }
    else{
        update_post_meta($post_id,$key,$count+1);
    }
    return $count;
}

define('_MS_VERSION','v1.0.0');
function ms1_scripts() {
	
	wp_enqueue_style( 'style', get_stylesheet_uri(),array(),_MS_VERSION);
	wp_enqueue_style( 'index_style', get_template_directory_uri() . '/assets/css/index.css',array(),_MS_VERSION);
	wp_enqueue_script('test-jq',get_template_directory_uri() . '/assets/js/jquery.js',array(),_MS_VERSION,array(
        'in_footer' => true
    ));

    if(is_single()){
        wp_enqueue_style( 'high_style', 'https://cdn.bootcdn.net/ajax/libs/highlight.js/11.8.0/styles/atom-one-dark.min.css',array(),_MS_VERSION);
        wp_enqueue_script('high_js','https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js',array(),_MS_VERSION); 
    }
}
add_action( 'wp_enqueue_scripts', 'ms1_scripts' );

?>