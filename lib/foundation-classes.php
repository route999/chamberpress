<?php
function display_class($col = array('s'=>'12', 'm'=>'6', 'l'=>'6')){
	$arr = Array(
		"r" => 'row',
		"s"=> 'small',
		"m"=> 'medium',
		"mp"=>'medium-push',
		"mpl"=>'medium-pull',
		"l"=> 'large'
	);
	$classes="";
	foreach($col as $k=>$v){
		if($v != ""){
			$classes[] = $arr[$k]."-".$v;
		}else{
			$classes[] = $arr[$k];
		}
	}
	$col = "";
	if(!in_array ('row', $classes) ){
		$col = " columns";
		
	}
	$classes = implode(" ", $classes).$col;
	return $classes;
}
function get_display_class($out){
	echo display_class($out);
}