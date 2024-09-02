<?php
   // echo '<h2>'.get_the_title().'</h2>';
echo 
  '<div class="card-box list">';
          
   the_title('<h1><a href="'.get_permalink().'">','</a></h1>');
   the_excerpt();
   echo '<div class="date-line">
          <span>
          '.the_date('Y-m-d').' '.get_the_author().'
          </span>
          <a href="'.get_permalink().'"><span>查看详情</span></a>
        </div>';
        
echo '</div>';
 // the_date('Y-m-d','<span class="date">日期：','</span>');
?>