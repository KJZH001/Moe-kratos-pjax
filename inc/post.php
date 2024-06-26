<?php
//The article reading quantity statistics
function kratos_set_post_views(){
    if(is_singular()){
      global $post;
      $post_ID = $post->ID;
      if($post_ID){
          $post_views = (int)get_post_meta($post_ID,'views',true);
          if(!update_post_meta($post_ID,'views',($post_views+1))) add_post_meta($post_ID,'views',1,true);
      }
    }
}
add_action('wp_head','kratos_set_post_views');
function num2tring($num){
    if($num>=1000) $num = round($num/1000*100)/100 .'k';
    return $num;
}
function kratos_get_post_views($before='',$after='',$echo=1){
  global $post;
  $post_ID = $post->ID;
  $views = (int)get_post_meta($post_ID,'views',true);
  return num2tring($views);
}
//Appreciate the article
function kratos_love(){
    global $wpdb,$post;
    $id = $_POST["um_id"];
    $action = $_POST["um_action"];
    if($action=='love'){
        $raters = get_post_meta($id,'love',true);
        $expire = time()+99999999;
        $domain = ($_SERVER['HTTP_HOST']!='localhost')?$_SERVER['HTTP_HOST']:false;
        setcookie('love_'.$id,$id,$expire,'/',$domain,false);
        if(!$raters||!is_numeric($raters)){
            update_post_meta($id,'love',1);
        }else{
            update_post_meta($id,'love',($raters+1));
        }
        echo get_post_meta($id,'love',true);
    }
    die;
}
add_action('wp_ajax_nopriv_love','kratos_love');
add_action('wp_ajax_love','kratos_love');
//Post title optimization
add_filter('private_title_format','kratos_private_title_format' );
add_filter('protected_title_format','kratos_private_title_format' );
function kratos_private_title_format($format){return '%s';}
//Password protection articles
add_filter('the_password_form','custom_password_form');
function custom_password_form(){
    $url = wp_login_url();
    global $post;$label='pwbox-'.(empty($post->ID)?rand():$post->ID);$o='
    <form class="protected-post-form" action="'.$url.'?action=postpass" method="post">
        <div class="panel panel-pwd">
            <div class="panel-body text-center">
                <img class="post-pwd" src="'.get_template_directory_uri().'/static/images/fingerprint.png"><br />
                <h4>'.__('这是一篇受保护的文章，请输入阅读密码！','moedog').'</h4>
                <div class="input-group" id="respond">
                    <div class="input-group-addon"><i class="fa fa-key"></i></div>
                    <p><input class="form-control" placeholder="'.__('输入阅读密码','moedog').'" name="post_password" id="'.$label.'" type="password" size="20"></p>
                </div>
                <div class="comment-form" style="margin-top:15px;"><button id="generate" class="btn btn-primary btn-pwd" name="Submit" type="submit">'.__('确认','moedog').'</button></div>
            </div>
        </div>
    </form>';
return $o;
}
//Comments face
add_filter('smilies_src','custom_smilies_src',1,10);
function custom_smilies_src($img_src,$img,$siteurl){
    if(kratos_option('owo_out')) $owodir = 'https://cdn-js.moeworld.top/gh/KJZH001/Moe-kratos-pjax@'.KRATOS_VERSION; else $owodir = get_bloginfo('template_directory');
    return $owodir.'/static/images/smilies/'.$img;
}
function smilies_reset(){
    global $wpsmiliestrans,$wp_smiliessearch,$wp_version;
    if(!get_option('use_smilies')||$wp_version<4.2) return;
    $wpsmiliestrans = array(
     ':hehe:' => 'hehe.png',
     ':haha:' => 'haha.png',
    ':tushe:' => 'tushe.png',
        ':a:' => 'a.png',
       ':ku:' => 'ku.png',
       ':nu:' => 'nu.png',
   ':kaixin:' => 'kaixin.png',
      ':han:' => 'han.png',
      ':lei:' => 'lei.png',
  ':heixian:' => 'heixian.png',
    ':bishi:' => 'bishi.png',
':bugaoxing:' => 'bugaoxing.png',
 ':zhenbang:' => 'zhenbang.png',
     ':qian:' => 'qian.png',
    ':yiwen:' => 'yiwen.png',
  ':yinxian:' => 'yinxian.png',
       ':tu:' => 'tu.png',
       ':yi:' => 'yi.png',
    ':weiqv:' => 'weiqv.png',
   ':huaxin:' => 'huaxin.png',
       ':hu:' => 'hu.png',
  ':xiaoyan:' => 'xiaoyan.png',
     ':leng:' => 'leng.png',
':taikaixin:' => 'taikaixin.png',
     ':meng:' => 'meng.png',
    ':huaji:' => 'huaji.png',
   ':huaji2:' => 'huaji2.png',
   ':huaji3:' => 'huaji3.gif',
   ':huaji4:' => 'huaji4.png',
   ':huaji5:' => 'huaji5.gif',
   ':huaji6:' => 'huaji6.png',
   ':huaji7:' => 'huaji7.png',
   ':huaji8:' => 'huaji8.png',
   ':huaji9:' => 'huaji9.png',
  ':huaji10:' => 'huaji10.png',
  ':huaji11:' => 'huaji11.png',
  ':huaji12:' => 'huaji12.png',
  ':huaji13:' => 'huaji13.png',
  ':huaji14:' => 'huaji14.png',
  ':huaji15:' => 'huaji15.png',
  ':huaji16:' => 'huaji16.gif',
  ':huaji17:' => 'huaji17.png',
  ':huaji18:' => 'huaji18.png',
  ':huaji19:' => 'huaji19.png',
  ':huaji20:' => 'huaji20.gif',
  ':huaji21:' => 'huaji21.gif',
  ':huaji22:' => 'huaji22.png',
  ':huaji23:' => 'huaji23.png',
':mianqiang:' => 'mianqiang.png',
 ':kuanghan:' => 'kuanghan.png',
     ':guai:' => 'guai.png',
 ':shuijiao:' => 'shuijiao.png',
   ':jingku:' => 'jingku.png',
  ':shengqi:' => 'shengqi.png',
   ':jingya:' => 'jingya.png',
      ':pen:' => 'pen.png',
    ':aixin:' => 'aixin.png',
   ':xinsui:' => 'xinsui.png',
   ':meigui:' => 'meigui.png',
     ':liwu:' => 'liwu.png',
  ':caihong:' => 'caihong.png',
     ':xxyl:' => 'xxyl.png',
      ':sun:' => 'sun.png',
    ':money:' => 'money.png',
     ':bulb:' => 'bulb.png',
      ':cup:' => 'cup.png',
     ':cake:' => 'cake.png',
    ':music:' => 'music.png',
    ':haha2:' => 'haha2.png',
      ':win:' => 'win.png',
     ':good:' => 'good.png',
      ':bad:' => 'bad.png',
       ':ok:' => 'ok.png',
     ':stop:' => 'stop.png',
    ':qy_afraid:' => 'qy_afraid.gif',
    ':qy_angry:' => 'qy_angry.gif',
    ':qy_chigua:' => 'qy_chigua.gif',
    ':qy_cry:' => 'qy_cry.gif',
    ':qy_die:' => 'qy_die.gif',
    ':qy_fue:' => 'qy_fue.gif',
    ':qy_happy:' => 'qy_happy.gif',
    ':qy_heng:' => 'qy_heng.gif',
    ':qy_huaj:' => 'qy_huaj.gif',
    ':qy_moe:' => 'qy_moe.gif',
    ':qy_ok:' => 'qy_ok.gif',
    ':qy_quest:' => 'qy_quest.gif',
    ':qy_see:' => 'qy_see.gif',
    ':qy_sleep:' => 'qy_sleep.gif',
    ':qy_soap:' => 'qy_soap.gif',
    ':qy_surprised:' => 'qy_surprised.gif',
    ':qy_tuxie:' => 'qy_tuxie.gif',
    ':qy_witty:' => 'qy_witty.gif',
    ':qy_wuyv:' => 'qy_wuyv.gif',
    ':qy_yaot:' => 'qy_yaot.gif',
    ':lqy_question:' => '10001.1.6063507425417614E9.jpeg',
    ':lqy_speechless:' => '10002.1.6063507364518287E9.jpeg',
    ':lqy_canttalk:' => '10003.1.6063507449046478E9.jpeg',
    ':lqy_black:' => '10004.1.6063507410935416E9.jpeg',
    ':lqy_more:' => '10005.1.606350743074853E9.jpeg',
    ':lqy_kill:' => '10006.1.6063507416954522E9.jpeg',
    ':hxj_666:' => '幻星集_666.png',
    ':hxj_Love:' => '幻星集_Love.png',
    ':hxj_NoDotDotDot:' => '幻星集_No.....png',
    ':hxj_NextTimeForSure:' => '幻星集_下次一定.png',
    ':hxj_IamAwesome:' => '幻星集_不愧是我.png',
    ':hxj_ImDead:' => '幻星集_啊我死了.png',
    ':hxj_LetsDoIt:' => '幻星集_奥利给.png',
    ':hxj_IGotIt:' => '幻星集_我觉得行.png',
    ':hxj_ThrowFlowers:' => '幻星集_撒花.png',
    ':hxj_QuestionMark:' => '幻星集_问号.png',
    ':原味稽:' => 'goodboyboy-huaji/原味稽.png',
    ':还是算了:' => 'goodboyboy-huaji/还是算了.png',
    ':蓝纹稽:' => 'goodboyboy-huaji/蓝纹稽.jpg',
    ':随稽应变:' => 'goodboyboy-huaji/随稽应变.jpg',
    ':蠕动:' => 'goodboyboy-huaji/蠕动.gif',
    ':束手无稽:' => 'goodboyboy-huaji/束手无稽.jpg',
    ':微笑默叹以为妙绝:' => 'goodboyboy-huaji/微笑默叹以为妙绝.png',
    ':喝嘤料:' => 'goodboyboy-huaji/喝嘤料.jpg',
    ':暗中观察:' => 'goodboyboy-huaji/暗中观察.jpg',
    ':高兴:' => 'goodboyboy-huaji/高兴.jpg',
    ':惊稽:' => 'goodboyboy-huaji/惊稽.jpg',
    ':可这和我的帅有什么关系:' => 'goodboyboy-huaji/可这和我的帅有什么关系.jpg',
    ':狱稽:' => 'goodboyboy-huaji/狱稽.jpg',
    ':梆:' => 'goodboyboy-huaji/梆.jpg',
    ':吃鱼摆摆:' => 'goodboyboy-huaji/吃鱼摆摆.gif',
    ':跃跃欲试_3:' => 'goodboyboy-huaji/跃跃欲试_3.gif',
    ':突然滑稽:' => 'goodboyboy-huaji/突然滑稽.jpg',
    ':扶墙怂:' => 'goodboyboy-huaji/扶墙怂.jpg',
    ':阔以:' => 'goodboyboy-huaji/阔以.jpg',
    ':不得行:' => 'goodboyboy-huaji/不得行.jpg',
    ':少儿不宜:' => 'goodboyboy-huaji/少儿不宜.jpg',
    ':稽日可期:' => 'goodboyboy-huaji/稽日可期.jpg',
    ':哎:' => 'goodboyboy-huaji/哎.jpg',
    ':别看丢人:' => 'goodboyboy-huaji/别看丢人.jpg',
    ':地稽 2:' => 'goodboyboy-huaji/地稽_2.jpg',
    ':地稽:' => 'goodboyboy-huaji/地稽.jpg',
    ':老阔有点扣:' => 'goodboyboy-huaji/老阔有点扣.gif',
    ':啊哈哈:' => 'goodboyboy-huaji/啊哈哈.jpg',
    ':无稽可奈:' => 'goodboyboy-huaji/无稽可奈.jpg',
    ':老实巴交:' => 'goodboyboy-huaji/老实巴交.jpg',
    ':紧张:' => 'goodboyboy-huaji/紧张.jpg',
    ':摇摆稽:' => 'goodboyboy-huaji/摇摆稽.gif',
    ':又不是不能用:' => 'goodboyboy-huaji/又不是不能用.jpg',
    ':一时滑稽:' => 'goodboyboy-huaji/一时滑稽.jpg',
    ':无法接受:' => 'goodboyboy-huaji/无法接受.jpg',
    ':嘤雄豪稽:' => 'goodboyboy-huaji/嘤雄豪稽.jpg',
    ':相视双稽:' => 'goodboyboy-huaji/相视双稽.jpg',
    ':稽皮发麻:' => 'goodboyboy-huaji/稽皮发麻.jpg',
    ':地稽 3:' => 'goodboyboy-huaji/地稽_3.jpg',
    ':地稽委屈:' => 'goodboyboy-huaji/地稽委屈.jpg',
    ':地稽抚摸:' => 'goodboyboy-huaji/地稽抚摸.gif',
    ':绝望:' => 'goodboyboy-huaji/绝望.jpg',
    ':气稽败坏:' => 'goodboyboy-huaji/气稽败坏.jpg',
    ':当场去世:' => 'goodboyboy-huaji/当场去世.jpg',
    ':喝酒:' => 'goodboyboy-huaji/喝酒.jpg',
    ':老衲摆摊算命:' => 'goodboyboy-huaji/老衲摆摊算命.gif',
    ':老哥，稳:' => 'goodboyboy-huaji/老哥，稳.jpg',
    ':自闭稽:' => 'goodboyboy-huaji/自闭稽.jpg',
    ':无话可说:' => 'goodboyboy-huaji/无话可说.jpg',
    ':跃跃欲试:' => 'goodboyboy-huaji/跃跃欲试.jpg',
    ':跃跃欲试 2:' => 'goodboyboy-huaji/跃跃欲试_2.jpg',
    ':满脑子骚操作:' => 'goodboyboy-huaji/满脑子骚操作.gif',
    ':稽之舞:' => 'goodboyboy-huaji/稽之舞.gif',
    ':将稽就稽:' => 'goodboyboy-huaji/将稽就稽.gif',
    );
}
smilies_reset();
//Paging
function kratos_pages($range=5){
    global $paged,$wp_query,$max_page;
    if(!$max_page){$max_page=$wp_query->max_num_pages;}
    if($max_page>1){if(!$paged){$paged=1;}
    echo "<div class='text-center' id='page-footer'><ul class='pagination'>";
        if($paged != 1) echo '<li><a href="'.get_pagenum_link(1).'" class="extend" title="'.__('首页','moedog').'">&laquo;</a></li>';
        if($paged>1) echo '<li><a href="'.get_pagenum_link($paged-1).'" class="prev" title="'.__('上一页','moedog').'">&lt;</a></li>';
        if($max_page>$range){
            if($paged<$range){
                for($i=1;$i<=($range+1);$i++){
                    echo "<li";
                    if($i==$paged) echo " class='active'";
                    echo "><a href='".get_pagenum_link($i)."'>$i</a></li>";
                }
            }
            elseif($paged>=($max_page-ceil(($range/2)))){
                for($i=$max_page-$range;$i<=$max_page;$i++){
                    echo "<li";
                    if($i==$paged) echo " class='active'";echo "><a href='".get_pagenum_link($i)."'>$i</a></li>";
                }
            }
            elseif($paged>=$range&&$paged<($max_page-ceil(($range/2)))){
                for($i=($paged-ceil($range/2));$i<=($paged+ceil(($range/2)));$i++){
                    echo "<li";
                    if($i==$paged) echo " class='active'";
                    echo "><a href='".get_pagenum_link($i)."'>$i</a></li>";
                }
            }
        }else{
            for($i=1;$i<=$max_page;$i++){
                echo "<li";
                if($i==$paged) echo " class='active'";
                echo "><a href='".get_pagenum_link($i)."'>$i</a></li>";
            }
        }
        if($paged<$max_page) echo '<li><a href="'.get_pagenum_link($paged+1).'" class="next" title="'.__('下一页','moedog').'">&gt;</a></li>';
        if($paged!=$max_page) echo '<li><a href="'.get_pagenum_link($max_page).'" class="extend" title="'.__('尾页','moedog').'">&raquo;</a></li>';
        echo "</ul></div>";
    }
}