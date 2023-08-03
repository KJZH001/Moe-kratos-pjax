<?php

define('KRATOS_VERSION','0.4.6');

require_once(get_template_directory().'/inc/core.php');
require_once(get_template_directory().'/inc/shortcode.php');
require_once(get_template_directory().'/inc/imgcfg.php');
require_once(get_template_directory().'/inc/post.php');
require_once(get_template_directory().'/inc/ua.php');
require_once(get_template_directory().'/inc/widgets.php');
require_once(get_template_directory().'/inc/smtp.php');
require_once(get_template_directory().'/inc/logincfg.php');
require_once(get_template_directory().'/inc/avatars.php');

// 博客后台登录失败时发送邮件通知管理员
// function wp_login_failed_notify()
// {
//     date_default_timezone_set('PRC');
//     $admin_email = get_bloginfo('admin_email');
//     $to = $admin_email;
//     $subject = '【登录失败』有人使用了错误的用户名或密码登录【' . get_bloginfo('name') . '』';
//     $message = '<span style="color:red; font-weight: bold;">【' . get_bloginfo('name') . '』有一条登录失败的记录产生，若登录操作不是您产生的，请及时注意网站安全！</span><br />空大人，请留心哦~<br /><br />';
//     $message .= '登录名：' . $_POST['log'];
//     $message .= '<br />尝试的密码：' . $_POST['pwd'];
//     $message .= '<br />登录的时间：' . date("Y-m-d H:i:s");
//     $message .= '<br />登录的 IP：' . $_SERVER['REMOTE_ADDR'];
//     $message .= '<br /><br />';
//     $message .= '您可以： <a href="' . get_bloginfo('url') . '" target="_target">进入' . get_bloginfo('name') . '»</a>';
//     wp_mail( $to, $subject, $message, "Content-Type: text/html; charset=UTF-8" );
// }
// add_action('wp_login_failed', 'wp_login_failed_notify');