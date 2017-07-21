<?php
/*
	Plugin Name:ECT Social Share
	Plugin URI: http://www.ecommercetemplates.com/wordpress/wp-plugins.asp
	Description:This plugin will share your purchase to social media sites like facebook, twitter, google plus etc.
	Author:Andy Chapman
	Author URI:http://www.ecommercetemplates.com
	Version:1.1
*/

add_action('admin_menu','ect_social_nav');
function ect_social_nav()
{	
	add_menu_page('ECT Social Share','ECT Social Share','manage_options','ect_social','ect_ss_fun',plugin_dir_url(__FILE__).'img/ect28x28.png',1015);
}
register_activation_hook('install_opts_for_social',__FILE__);
function install_opts_for_social()
{
	add_option('ect_social_share1','');
}
function ect_ss_fun()
{
	$SocialArr=array('Twitter'=>'twitter','Facebook'=>'facebook','Pinterest'=>'pinterest','Google Plus'=>'gplus');
	if(isset($_GET['msg']) && $_GET['msg']==1)
	{
		echo '<div class="updated below-h2" id="message"><p>Settings Saved Successfully.</p></div>';
	}
	$GetSocial=get_option('ect_social_share1');
	?>
	<h2>ECT SOCIAL SHARE</h2>
	<form method="post" class="social_plug">
		<ul>
			<?php foreach($SocialArr as $k=>$v):?>
			<li>
				<label><?php echo $k?></label>
				<?php if(!empty($GetSocial['share_on']) && is_array($GetSocial) && in_array($v,$GetSocial['share_on'])):?>
						<input type="checkbox" checked="checked" name="social[<?php echo $v?>]"/>
				<?php else:?>
					<input type="checkbox" name="social[<?php echo $v?>]"/>
				<?php endif;?>
			</li>
			<?php endforeach;?>
			<li>
				<label>Share URL</label>
				<input type="text" name="share_url" value="<?php echo stripslashes($GetSocial['share_url'])?>"/>
			</li>
			<li>
				<label>Share Subject</label>
				<input type="text" name="share_sub" value="<?php echo stripslashes($GetSocial['share_sub'])?>"/>
			</li>
			<li>
				<label>Title on Facebook</label>
				<input type="text" name="share_sub_fb" value="<?php echo stripslashes($GetSocial['share_sub_fb'])?>"/>
			</li>
			<li>
				<label>Share Text</label>
				<textarea cols="60" rows="6" name="txt"><?php echo stripslashes($GetSocial['share_txt'])?></textarea>
				<!--%%PRODUCT_NAME%%, %%STORE_URL%%-->
			</li>
		</ul>
		<ul>
			<li><label>&nbsp;</label>
			<input type="submit" value="Update" class="button button-primary button-large"/>
			</li>
		</ul>
	</form>
	<style>
		.social_plug ul li input[type=text]
		{
			width:345px;
		}
		.social_plug ul li label
		{
			width:150px;
			display:inline-block;
			font-weight:bold;
			float:left;
			cursor: default !important;
		}
	</style>
<?php
//echo do_shortcode('[ect_socialshare pname="Pname"]');
	if(!empty($_POST))
	{
		$EctSocialShare='';
		$social=esc_sql($_POST['social']);
		foreach($social as $sh=>$sv)
		{
			$EctSocialShare['share_on'][]=$sh;
		}
		$txt=esc_sql($_POST['txt']);
		$share_sub=esc_sql($_POST['share_sub']);
		$share_sub_fb=esc_sql($_POST['share_sub_fb']);
		$share_url=esc_sql($_POST['share_url']);
		
		$EctSocialShare['share_txt']=$txt;
		$EctSocialShare['share_sub']=$share_sub;
		$EctSocialShare['share_sub_fb']=$share_sub_fb;
		$EctSocialShare['share_url']=$share_url;
		update_option('ect_social_share1',$EctSocialShare);
		echo '<script type="text/javascript">window.location="admin.php?page=ect_social&msg=1"</script>';
	}
}
add_shortcode('ect_socialshare','ect_socialshare_fun');
function ect_socialshare_fun($attrs='')
{
	
	$GetSocial=get_option('ect_social_share1');
	$SocialSub=$GetSocial['share_sub'];
	$share_sub_fb=$GetSocial['share_sub_fb'];
	$SocialSumm=$GetSocial['share_txt'];
	$SocialUrl=$GetSocial['share_url'];
	
	$st_title=$SocialSub;
	$share_sub_fb=$share_sub_fb;
	$st_image=site_url('/').$attrs['pimg'];
	$st_summary=$SocialSumm;
	//$Attrs=$st_title.$st_image.$st_summary;
	
	$Pname=$attrs['pname'];
	$SrhArrr=array('%%PRODUCT_NAME%%','%%STORE_URL%%');
	$RepArrr=array($Pname,$SocialUrl);
	$st_summary=str_replace($SrhArrr,$RepArrr,$st_summary);
	$SiteUrl=urlencode($SocialUrl);
	
	$ShareLinks=$li='';
	$ShareLinks='';
	if(!empty($GetSocial['share_on']))
	{
		foreach($GetSocial['share_on'] as $SL)
		{
			$T=$I=$Txt='';
			if($SL=='facebook')
			{
				$T=1;
				$I='fb';
				$Txt='Facebook';
			}
			elseif($SL=='gplus')
			{
				$T=2;
				$I='gplus';
				$Txt='Google +';
			}
			elseif($SL=='pinterest')
			{
				$T=3;
				$I='pinterest';
				$Txt='Pinterest';
			}
			elseif($SL=='twitter')
			{
				$T=4;
				$I='twitter';
				$Txt='Twitter';
			}
			$ShareLinks.="<li>
							<a href='javascript:void(0)' onclick='LoadPop($T)'>
								<img src='".plugin_dir_url(__FILE__)."img/$I.png' alt='".$Pname."'/>
								<span>Share on ".$Txt."</span>
							</a>
						</li>";
		}
	}	
	return '</div><div class="ect_share">
					<div class="ect_head">'.stripslashes($SocialSub).'</div>
					<ul><li style="border: 1px solid; float: left; margin-right: 6px;"><img width="85" src="'.$attrs['pimg'].'" alt="'.$attrs['pname'].'"/></li>'.$ShareLinks."</ul><script type='text/javascript'>
		function LoadPop(type)
		{
			var left, top;
			var x = screen.width/2 - 500/2;
			var y = screen.height/2 - 300/2;
			if(type==1)
			{
				window.open('http://www.facebook.com/sharer.php?s=100&p[title]=$share_sub_fb&p[url]=$SiteUrl&p[summary]=$st_summary&p[images][0]=$st_image','ECT Social Share','menubar=1,resizable=0,width=500,height=300,top='+y+',left='+x);
	
			}
			else if(type==2)
			{
				window.open('https://plus.google.com/share?url=$SiteUrl','ECT Social Share','menubar=1,resizable=0,width=500,height=300,top='+y+',left='+x);
			}
			else if(type==3)
			{
				window.open('http://pinterest.com/pin/create/button/?url=$SiteUrl&media=$st_image&description=$st_summary','ECT Social Share','menubar=1,resizable=0,width=500,height=300,top='+y+',left='+x);
			}
			else if(type==4)
			{
				window.open('https://twitter.com/intent/tweet?text=$st_summary&source=webclient','ECT Social Share','menubar=1,resizable=0,width=500,height=300,top='+y+',left='+x);
			}
			
		}
	</script>";

}
add_action('wp_head','ect_add_css');
function ect_add_css()
{
	
	echo "<style>
	.ect_share ul
		{
			 list-style: none outside none;
			margin: 6px auto;
			width: 30%;
		}
	@media screen and (max-width: 980px) {
	.ect_share ul
		{
			 list-style: none outside none;
			margin: 6px auto;
			width: 33%;
		}
	}
	
	@media screen and (max-width: 803px) {
	.ect_share ul
		{
			 list-style: none outside none;
			margin: 6px auto;
			width: 45%;
		}
	}
	
	@media screen and (max-width: 650px) {
	.ect_share ul
		{
			 list-style: none outside none;
			margin: 6px auto;
			width: 65%;
		}
	}
	@media screen and (max-width: 480px) {
	.ect_share ul
		{
			 list-style: none outside none;
			margin: 6px auto;
			width: 84%;
		}
	}
	
	@media screen and (max-width: 320px) {
	.ect_share ul
		{
			  list-style: none outside none;
    margin: 5px auto 5px -24px;
    width: 100%;
		}
	}
	@media screen and (max-width: 240px) {
	.ect_share ul
		{
			 list-style: none outside none;
			margin: 6px auto;
			width: 132%;
		}
	} 
	.ect_share .imgd
	{
		margin-top: 6px; margin-left: 327px; float: left; border: 0px solid;
	}
	.ect_share .imgd img
	{
		width: 102px; border: 1px solid;
	}
	.ect_share ul li
	{
		line-height:24px;
	}
	.ect_share .ect_head
	{
		font-size:18px;
		text-align:center;
	}
	.ect_share a
	{
		text-decoration:none;
	}
	.ect_share a span
	{	
		 color: #000000;
    font-size: 16px;
    margin-left: 11px;
	}
	</style>";
}
?>