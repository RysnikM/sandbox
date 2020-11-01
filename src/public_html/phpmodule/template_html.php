<?php
function templates($filename){
  $content=file_get_contents($filename);
  //$content=htmlspecialchars($content);
//$content=template_parse($content);
	$content = preg_replace("/\{([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*\(([^{}]*)\))\}/","<?php echo \\1;?>",$content);
	$content = preg_replace("/\{\\$([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*\(([^{}]*)\))\}/","<?php echo \\1;?>",$content);
	$content = preg_replace("/\{(\\$[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*)\}/","<?php echo \\1;?>",$content);
	$content = preg_replace("/\{(\\$[a-zA-Z0-9_\[\]\'\"\$\x7f-\xff]+)\}/es", "addquote('<?php echo \\1;?>')",$content);
	$content = preg_replace("/\{([A-Z_\x7f-\xff][A-Z0-9_\x7f-\xff]*)\}/s", "<?php echo \\1;?>",$content);
file_put_contents($filename, $content);

 return $filename;
}


function template_parse($tpl)
{
	$tpl = preg_replace("/([\n\r]+)\t+/s","\\1",$tpl);
	$tpl = preg_replace("/\<\!\-\-\{(.+?)\}\-\-\>/s", "{\\1}",$tpl);
	$tpl = preg_replace("/\{template\s+(.+)\}/","\n<?php include template(\\1); ?>\n",$tpl);
	$tpl = preg_replace("/\{template_wap\s+(.+)\}/","\n<?php include template_wap(\\1); ?>\n",$tpl);
	$tpl = preg_replace("/\{include\s+(.+)\}/","\n<?php include \\1; ?>\n",$tpl);
	$tpl = preg_replace("/\{php\s+(.+)\}/","\n<?php \\1?>\n",$tpl);
	$tpl = preg_replace("/\{if\s+(.+?)\}/","<?php if(\\1) { ?>",$tpl);
	$tpl = preg_replace("/\{else\}/","<?php } else { ?>",$tpl);
	$tpl = preg_replace("/\{elseif\s+(.+?)\}/","<?php } elseif (\\1) { ?>",$tpl);
	$tpl = preg_replace("/\{\/if\}/","<?php } ?>",$tpl);
	$tpl = preg_replace("/\{loop\s+(\S+)\s+(\S+)\}/","<?php if(is_array(\\1)) foreach(\\1 AS \\2) { ?>",$tpl);
	$tpl = preg_replace("/\{loop\s+(\S+)\s+(\S+)\s+(\S+)\}/","\n<?php if(is_array(\\1)) foreach(\\1 AS \\2 => \\3) { ?>",$tpl);
	$tpl = preg_replace("/\{\/loop\}/","\n<?php } ?>\n",$tpl);
	$tpl = preg_replace("/\{([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*\(([^{}]*)\))\}/","<?php echo \\1;?>",$tpl);
	$tpl = preg_replace("/\{\\$([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*\(([^{}]*)\))\}/","<?php echo \\1;?>",$tpl);
	$tpl = preg_replace("/\{(\\$[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*)\}/","<?php echo \\1;?>",$tpl);
	$tpl = preg_replace("/\{(\\$[a-zA-Z0-9_\[\]\'\"\$\x7f-\xff]+)\}/es", "addquote('<?php echo \\1;?>')",$tpl);
	$tpl = preg_replace("/\{([A-Z_\x7f-\xff][A-Z0-9_\x7f-\xff]*)\}/s", "<?php echo \\1;?>",$tpl);
	$tpl = "<?php  ?>".$tpl;

	return $tpl;
}
?>