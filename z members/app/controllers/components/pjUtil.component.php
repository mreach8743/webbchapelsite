<?php
if (!defined("ROOT_PATH"))
{
	header("HTTP/1.1 403 Forbidden");
	exit;
}
require_once ROOT_PATH . 'core/framework/components/pjToolkit.component.php';
class pjUtil extends pjToolkit
{
	public static function printInstallNotice($title, $body, $convert = true, $close = true)
	{
		?>
		<div class="install-notice-box">
			<div class="notice-top"></div>
			<div class="notice-middle">
				<span class="notice-info">&nbsp;</span>
				<?php
				if (!empty($title))
				{
					printf('<span class="block bold">%s</span>', $convert ? htmlspecialchars(stripslashes($title)) : stripslashes($title));
				}
				if (!empty($body))
				{
					printf('<span class="block">%s</span>', $convert ? htmlspecialchars(stripslashes($body)) : stripslashes($body));
				}
				if ($close)
				{
					?><a href="#" class="notice-close"></a><?php
				}
				?>
			</div>
			<div class="notice-bottom"></div>
		</div>
		<?php
	}
	
	static public function html2txt($document){
		$search = array('@<script[^>]*?>.*?</script>@si', 
		               '@<[\/\!]*?[^<>]*?>@si',           
		               '@<style[^>]*?>.*?</style>@siU',   
		               '@<![\s\S]*?--[ \t\n\r]*>@'    
		);
		$text = preg_replace($search, '', $document);
		return $text;
	}
	
	static public function truncateDescription($string, $limit, $break=".", $pad="..."){
		if(strlen($string) <= $limit) 
			return $string;  
		if(false !== ($breakpoint = strpos($string, $break, $limit))) 
		{ 
			if($breakpoint < strlen($string) - 1) 
			{ 
				$string = substr($string, 0, $breakpoint) . $pad; 
			} 
		} 
		return $string;
	}
}

function __($key, $return=false)
{
	$text = pjUtil::field($key);
	if ($return)
	{
		return $text;
	}
	echo $text;
}

function __autoload($className)
{
	$paths = array(
		PJ_FRAMEWORK_PATH . $className . '.class.php',
		PJ_CONTROLLERS_PATH . $className . '.controller.php',
		PJ_MODELS_PATH . str_replace('Model', '', $className) . '.model.php',
		PJ_COMPONENTS_PATH. $className . '.component.php',
		PJ_FRAMEWORK_PATH . 'components/'. $className . '.component.php'
	);

	foreach ($paths as $filename)
	{
		if (is_file($filename))
		{
			require $filename;
			return;
		}
	}
}
?>