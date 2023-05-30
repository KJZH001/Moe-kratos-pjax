<?php
//smtp init
add_action('phpmailer_init','mail_smtp');
function mail_smtp($phpmailer){
    if(kratos_option('mail_smtps')==1){
        $mail_name = kratos_option('mail_name');
        $mail_host = kratos_option('mail_host');
        $mail_port = kratos_option('mail_port');
        $mail_username = kratos_option('mail_username');
        $mail_passwd = kratos_option('mail_passwd');
        $mail_smtpsecure = kratos_option('mail_smtpsecure');
        $phpmailer->FromName = $mail_name?$mail_name:'Moe-dog Services Team'; 
        $phpmailer->Host = $mail_host?$mail_host:'smtp.office365.com';
        $phpmailer->Port = $mail_port?$mail_port:'587';
        $phpmailer->Username = $mail_username?$mail_username:'no_reply@fczbl.vip';
        $phpmailer->Password = $mail_passwd?$mail_passwd:'123456789';
        $phpmailer->From = $mail_username?$mail_username:'no_reply@fczbl.vip';
        $phpmailer->SMTPAuth = kratos_option('mail_smtpauth')==1?true:false ;
        $phpmailer->SMTPSecure = $mail_smtpsecure?$mail_smtpsecure:'STARTTLS';
        $phpmailer->IsSMTP();
    }
}
//Comment approved mail
add_action('comment_unapproved_to_approved','kratos_comment_approved');
function kratos_comment_approved($comment){
    if(is_email($comment->comment_author_email)){
        $wp_email = 'no-reply@'.preg_replace('#^www\.#','',strtolower($_SERVER['SERVER_NAME']));
        $to = trim($comment->comment_author_email);
        $post_link = get_permalink($comment->comment_post_ID);
        $subject = __('[通知] 您的留言已经通过审核','moedog');
        $message = '
            <style>img.wp-smiley{width:auto!important;height:auto!important;max-height:8em!important;margin-top:-4px;display:inline}</style>
            <div style="background:#ececec;width:100%;padding:50px 0;text-align:center">
                <div style="background:#fff;width:750px;text-align:left;position:relative;margin:0 auto;font-size:14px;line-height:1.5">
                    <div style="zoom:1;padding:25px 40px;background:#518bcb;border-bottom:1px solid #467ec3">
                        <h1 style="color:#fff;font-size:25px;line-height:30px; margin:0"><a href="'.get_option('home').'" style="text-decoration:none;color:#FFF">'.htmlspecialchars_decode(get_option('blogname'),ENT_QUOTES).'</a></h1>
                    </div>
                    <div style="padding:35px 40px 30px">
                        <h2 style="font-size:18px;margin:5px 0">Hi '.trim($comment->comment_author).':</h2>
                        <p style="color:#313131;line-height:20px;font-size:15px;margin:20px 0">'.__('您有一条留言通过了管理员的审核并显示在文章页面，摘要信息请见下表。','moedog').'</p>
                        <table cellspacing="0" style="font-size:14px;text-align:center;border:1px solid #ccc;table-layout:fixed;width:500px">
                            <thead>
                                <tr>
                                    <th style="padding:5px 0;text-indent:8px;border:1px solid #eee;border-width:0 1px 1px 0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;font-weight:normal;color:#a0a0a0;background:#eee;border-color:#dfdfdf" width="280px">'.__('文章','moedog').'</th>
                                    <th style="padding:5px 0;text-indent:8px;border:1px solid #eee;border-width:0 1px 1px 0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;font-weight:normal;color:#a0a0a0;background:#eee;border-color:#dfdfdf" width="270px">'.__('内容','moedog').'</th>
                                    <th style="padding:5px 0;text-indent:8px;border:1px solid #eee;border-width:0 1px 1px 0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;font-weight:normal;color:#a0a0a0;background:#eee;border-color:#dfdfdf" width="110px">'.__('操作','moedog').'</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="padding:5px 0;text-indent:8px;border:1px solid #eee;border-width:0 1px 1px 0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis">《'.get_the_title($comment->comment_post_ID).'》</td>
                                    <td style="padding:5px 0;text-indent:8px;border:1px solid #eee;border-width:0 1px 1px 0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis">'.convert_smilies(trim($comment->comment_content)).'</td>
                                    <td style="padding:5px 0;text-indent:8px;border:1px solid #eee;border-width:0 1px 1px 0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis"><a href="'.get_comment_link($comment->comment_ID).'" style="color:#1E5494;text-decoration:none;vertical-align:middle" target="_blank">'.__('查看留言','moedog').'</a></td>
                                </tr>
                            </tbody>
                        </table>
                        <br>
                        <div style="font-size:13px;color:#a0a0a0;padding-top:10px">'.__('该邮件由系统自动发出，如果不是您本人操作，请忽略此邮件。','moedog').'</div>
                        <div class="qmSysSign" style="padding-top:20px;font-size:12px;color:#a0a0a0">
                            <p style="color:#a0a0a0;line-height:18px;font-size:12px;margin:5px 0">'.htmlspecialchars_decode(get_option('blogname'),ENT_QUOTES).'</p>
                            <p style="color:#a0a0a0;line-height:18px;font-size:12px;margin:5px 0"><span style="border-bottom:1px dashed #ccc" t="5" times="">'.date("Y-m-d",time()).'</span></p>
                        </div>
                    </div>
                </div>
            </div>';
        $from = "From: \"".htmlspecialchars_decode(get_option('blogname'),ENT_QUOTES)."\" <$wp_email>";
        $headers = "$from\nContent-Type: text/html; charset=".get_option('blog_charset')."\n";
        wp_mail($to,$subject,$message,$headers);
    }
}
//Comment reply mail
add_action('comment_post','comment_mail_notify');
function comment_mail_notify($comment_id){
    $comment = get_comment($comment_id);
    $parent_id = $comment->comment_parent?$comment->comment_parent:'';
    $spam_confirmed = $comment->comment_approved;
    if(($parent_id!='')&&($spam_confirmed!='spam')){
        $wp_email = 'no-reply@'.preg_replace('#^www\.#','',strtolower($_SERVER['SERVER_NAME']));
        $to = trim(get_comment($parent_id)->comment_author_email);
        $subject = __('[通知] 您的留言有了新的回复','moedog');
        $message = '
            <style type="text/css">
                div, tr, td, p, a, h1, h2, h3, h4, h5, h6, ul, li {
                    margin: 0;
                    padding: 0;
                }
                
                a {
                    text-decoration: none;
                }
                
                img {
                    max-width: 100%;
                    border: none;
                    outline: none;
                    text-decoration: none;
                    -ms-interpolation-mode: bicubic;
                }
                
                a img {
                    border: none;
                }
            </style>
            <div style="text-align: center;padding-bottom:4px">
                <font size="1" color="#808080"><a rel="webversion">如邮件无法正常显示，请尝试显示不受信任的内容</a></font>
            </div>
            <div style="font:Verdana normal 14px;color:#000;">
                <style type="text/css"></style>
                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                    <tbody>
                        <tr>
                            <td bgcolor="#f3f3f3" align="center" style="padding:22px 0 15px 0" class="padding6">
                                <table width="550" border="0" cellpadding="0" cellspacing="0" style="border-radius:10px; margin:0 auto; background-color:#ffffff;" class="responsive-table">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <table border="0" cellspacing="0" cellpadding="0" width="100%" style="border-radius:10px; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; margin-bottom: 30px;" class="responsive-table">
                                                    <tbody>
                                                        <tr>
                                                            <!--<td align="center" class="padding2"> <img style="border-top-left-radius:4px; border-top-right-radius:4px; vertical-align:-3px;outline: none; border: none; text-decoration: none; -ms-interpolation-mode: bicubic;margin:0;padding:0;display:inline;width:100%;" src="https://img.cdn.loliloli.net/images/2022/06/16/rt6Q.png" class="img"> </td>-->
                                                            <td align="center" class="padding2"> <img style="border-top-left-radius:4px; border-top-right-radius:4px; vertical-align:-3px;outline: none; border: none; text-decoration: none; -ms-interpolation-mode: bicubic;margin:0;padding:0;display:inline;width:100%;" src="https://cdn-js.moeworld.top/gh/KJZH001/Moe-kratos-pjax/static/images/mail.webp" class="img"> </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="center">
                                                <table border="0" cellpadding="0" cellspacing="0" width="550" class="responsive-table">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td>
                                                                                <table cellpadding="0" cellspacing="0" border="0" align="left" class="responsive-table">
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td align="left" valign="top" style="padding: 0 58px 0px 58px;" class="padding1">
                                                                                                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                                                                                    <tbody>
                                                                                                        <tr>
                                                                                                            <td align="left" style="font-size: 20px; color:#595757; line-height:25px;width:434px"><b>Hi '.trim(get_comment($parent_id)->comment_author).'：</b> </td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td align="left" valign="top" style="font-size:15px; color:#595757; font-size:14px; line-height: 25px; font-family:Hiragino Sans GB; padding: 15px 0 0 0"> 您有一条留言有了新的回复，摘要信息请见如下：</td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td align="left" valign="top" style="font-size:18px; color:#595757; line-height: 25px; padding: 15px 0 0 0"> 作者：'.trim($comment->comment_author).' 回复的内容 </td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td align="left" valign="top" style="color:#595757; font-size:14px; line-height: 25px; font-family:Hiragino Sans GB; padding: 15px 0 0 0"> '.convert_smilies(trim($comment->comment_content)).' </td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td align="left" valign="top" style="font-size:18px; color:#595757; line-height: 25px;  padding: 15px 0 0 0 "> 您的原文 </td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td align="left" valign="top" style="font-size:15px; color:#595757; font-size:14px; line-height: 25px; font-family:Hiragino Sans GB; padding: 15px 0 15px 0 "> '.convert_smilies(trim(get_comment($parent_id)->comment_content)).' </td>
                                                                                                        </tr>
                                                                                                        
                                                                                                        <tr>
                                                                                                            <td style="padding: 28px 0 28px 0;" align="center" class="padding">
                                                                                                                <table border="0" cellspacing="0" cellpadding="0" class="responsive-table">
                                                                                                                    <tbody>
                                                                                                                        <tr>
                                                                                                                            <td> <span style="font-family:Hiragino Sans GB;font-size:13px;"> <div style="text-decoration: none; color: rgb(255, 255, 255); padding: 10px 36px; border-radius: 3px; text-align: center; background-color: rgb(15, 136, 235); font-size: 16px; margin: 0px; white-space: nowrap;"><a href="'.get_comment_link($comment->comment_ID).'" style="color: rgb(255, 255, 255);">在原文中查看</a></div> </span> </td>
                                                                                                                        </tr>
                                                                                                                    </tbody>
                                                                                                                </table>
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                        
                                                                                                        <tr>
                                                                                                        <td align="left" valign="top" style="font-family:Hiragino Sans GB; font-size:12px; color: rgba(0,0,0,0.40); line-height:17px; padding:0 0 25px 0;">
                                                                                                            <a href="'.get_option('home').'">'.htmlspecialchars_decode(get_option('blogname'),ENT_QUOTES).'</a>
                                                                                                            <br>'.date("Y-m-d",time()).'</td>
                                                                                                        </tr>
                                                                                                        
                                                                                                    </tbody>
                                                                                                </table>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table cellpadding="0" cellspacing="0" border="0" width="100%">
                    <tbody>
                        <tr>
                            <td bgcolor="#ffffff" align="center">
                                <table width="550" border="0" cellpadding="0" cellspacing="0" align="center" class="responsive-table">
                                    <tbody>
                                        <tr>
                                            <td align="center" valign="top" bgcolor="#ffffff" style="font-family:Hiragino Sans GB; font-size:12px; color: rgba(0,0,0,0.40); line-height:17px; padding:0 0 25px 0;">
                                                <br> © 空梦世界 MoeWorld Inc. 
                                                <br>
                                                <br>该邮件由不受监视的邮箱系统自动发出，如果不是您本人操作，请忽略此邮件</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>';
        $from = "From: \"".htmlspecialchars_decode(get_option('blogname'),ENT_QUOTES)."\" <$wp_email>";
        $headers = "$from\nContent-Type: text/html; charset=".get_option('blog_charset')."\n";
        wp_mail($to,$subject,$message,$headers);
    }
}
//Reset pwd mail
add_filter('retrieve_password_message','kratos_reset_password_message',null,2);
function kratos_reset_password_message($message,$key){
    add_filter('wp_mail_content_type',function(){return "text/html";});
    if(strpos($_POST['user_login'],'@')){
        $user_data = get_user_by('email',trim($_POST['user_login']));
    }else{
        $login = trim($_POST['user_login']);
        $user_data = get_user_by('login',$login);
    }
    $message = '
        <div style="background:#ececec;width:100%;padding: 50px 0;text-align:center">
            <div style="background:#fff;width:750px;text-align:left;position:relative;margin:0 auto;font-size:14px;line-height:1.5">
                <div style="zoom:1;padding:25px 40px;background:#518bcb;border-bottom:1px solid #467ec3">
                    <h1 style="color:#fff;font-size:25px;line-height:30px;margin:0"><a href="'.get_option('home').'" style="text-decoration:none;color:#FFF">'.htmlspecialchars_decode(get_option('blogname'),ENT_QUOTES).'</a></h1>
                </div>
                <div style="padding:35px 40px 30px">
                    <h2 style="font-size:18px;margin:5px 0">Hi '.$user_data->display_name.':</h2>
                    <p style="color:#313131;line-height:20px;font-size:15px;margin:20px 0">'.__("您正在请求重置密码，摘要信息如下表。","moedog").'</p>
                    <table cellspacing="0" style="font-size:14px;text-align:center;border:1px solid #ccc;table-layout:fixed;width:500px">
                        <thead>
                            <tr>
                                <th style="padding:5px 0;text-indent:8px;border:1px solid #eee;border-width:0 1px 1px 0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;font-weight:normal;color:#a0a0a0;background:#eee;border-color:#dfdfdf" width="260px">'.__("账号","moedog").'</th>
                                <th style="padding:5px 0;text-indent:8px;border:1px solid #eee;border-width:0 1px 1px 0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;font-weight:normal;color:#a0a0a0;background:#eee;border-color:#dfdfdf" width="260px">'.__("邮箱","moedog").'</th>
                                <th style="padding:5px 0;text-indent:8px;border:1px solid #eee;border-width:0 1px 1px 0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;font-weight:normal;color:#a0a0a0;background:#eee;border-color:#dfdfdf" width="140px">'.__("操作","moedog").'</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="padding:5px 0;text-indent:8px;border:1px solid #eee;border-width:0 1px 1px 0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis">'.trim($user_data->user_login).'</td>
                                <td style="padding:5px 0;text-indent:8px;border:1px solid #eee;border-width:0 1px 1px 0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis">'.trim($user_data->user_email).'</td>
                                <td style="padding:5px 0;text-indent:8px;border:1px solid #eee;border-width:0 1px 1px 0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis"><a href="'.network_site_url("wp-login.php?action=rp&key=$key&login=".rawurlencode($user_data->user_login),'login').'" style="color:#1E5494;text-decoration:none;vertical-align:middle" target="_blank">'.__("立即重置","moedog").'</a></td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    <div style="font-size:13px;color:#a0a0a0;padding-top:10px">'.__("该邮件由系统自动发出，如果不是您本人操作，请忽略此邮件。","moedog").'</div>
                    <div class="qmSysSign" style="padding-top:20px;font-size:12px;color:#a0a0a0;">
                        <p style="color:#a0a0a0;line-height:18px;font-size:12px;margin:5px 0">'.htmlspecialchars_decode(get_option('blogname'),ENT_QUOTES).'</p>
                        <p style="color:#a0a0a0;line-height:18px;font-size:12px;margin:5px 0"><span style="border-bottom:1px dashed #ccc" t="5" times="">'.date("Y-m-d",time()).'</span></p>
                    </div>
                </div>
            </div>
        </div>';
    return $message;
}
//Register mail
add_filter('password_change_email','__return_false');
add_filter('wp_new_user_notification_email','__return_false');
add_action('user_register','kratos_pwd_register_mail',101);
function kratos_pwd_register_mail($user_id){
    $user = get_user_by('id',$user_id);
    $blogname = htmlspecialchars_decode(get_option('blogname'),ENT_QUOTES);
    if(kratos_option('mail_reg')){
        $pwd = __("您设定的密码","moedog");
    }else{
        $pwd = wp_generate_password(10,false);
        $user->user_pass = $pwd;
        $new_user_id = wp_update_user($user);
    }
    $message = '
        <div style="background:#ececec;width:100%;padding:50px 0;text-align:center">
            <div style="background:#fff;width:750px;text-align:left;position:relative;margin:0 auto;font-size:14px;line-height:1.5">
                <div style="zoom:1;padding:25px 40px;background:#518bcb;border-bottom:1px solid #467ec3">
                    <h1 style="color:#fff;font-size:25px;line-height:30px;margin:0"><a href="'.get_option('home').'" style="text-decoration:none;color:#FFF">'.$blogname.'</a></h1>
                </div>
                <div style="padding:35px 40px 30px">
                    <h2 style="font-size:18px;margin:5px 0">Hi '.$user->nickname.':</h2>
                    <p style="color:#313131;line-height:20px;font-size:15px;margin:20px 0">'.__("恭喜您注册成功，请使用下面的信息登录并修改密码。","moedog").'</p>
                    <table cellspacing="0" style="font-size:14px;text-align:center;border:1px solid #ccc;table-layout:fixed;width:500px">
                        <thead>
                            <tr>
                                <th style="padding:5px 0;text-indent:8px;border:1px solid #eee;border-width:0 1px 1px 0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;font-weight:normal;color:#a0a0a0;background:#eee;border-color:#dfdfdf" width="180px">'.__("账号","moedog").'</th>
                                <th style="padding:5px 0;text-indent:8px;border:1px solid #eee;border-width:0 1px 1px 0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;font-weight:normal;color:#a0a0a0;background:#eee;border-color:#dfdfdf" width="180px">'.__("邮箱","moedog").'</th>
                                <th style="padding:5px 0;text-indent:8px;border:1px solid #eee;border-width:0 1px 1px 0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;font-weight:normal;color:#a0a0a0;background:#eee;border-color:#dfdfdf" width="180px">'.__("密码","moedog").'</th>
                                <th style="padding:5px 0;text-indent:8px;border:1px solid #eee;border-width:0 1px 1px 0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;font-weight:normal;color:#a0a0a0;background:#eee;border-color:#dfdfdf" width="120px">'.__("操作","moedog").'</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="padding:5px 0;text-indent:8px;border:1px solid #eee;border-width:0 1px 1px 0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis">'.trim($user->user_login).'</td>
                                <td style="padding:5px 0;text-indent:8px;border:1px solid #eee;border-width:0 1px 1px 0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis">'.trim($user->user_email).'</td>
                                <td style="padding:5px 0;text-indent:8px;border:1px solid #eee;border-width:0 1px 1px 0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis">'.trim($pwd).'</td>
                                <td style="padding:5px 0;text-indent:8px;border:1px solid #eee;border-width:0 1px 1px 0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis"><a href="'.wp_login_url().'" style="color:#1E5494;text-decoration:none;vertical-align:middle" target="_blank">'.__("立即登录","moedog").'</a></td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    <div style="font-size:13px;color:#a0a0a0;padding-top:10px">'.__("该邮件由系统自动发出，如果不是您本人操作，请忽略此邮件。","moedog").'</div>
                    <div class="qmSysSign" style="padding-top:20px;font-size:12px;color:#a0a0a0">
                        <p style="color:#a0a0a0;line-height:18px;font-size:12px;margin:5px 0">'.$blogname.'</p>
                        <p style="color:#a0a0a0;line-height:18px;font-size:12px;margin:5px 0"><span style="border-bottom:1px dashed #ccc" t="5" times="">'.date("Y-m-d",time()).'</span></p>
                    </div>
                </div>
            </div>
        </div>';
    $headers = "Content-Type:text/html;charset=UTF-8\n";
    wp_mail($user->user_email,'['.$blogname.'] '.__('欢迎注册','moedog'),$message,$headers);
}