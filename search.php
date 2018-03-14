<form action='/search' method='get'>
	<input name='q' type='search' placeholder='Keywords..'/>
	<button id='find' type='submit'>
</form>
<?php
// Powered by ProcessWire!
$q = $sanitizer->text($input->get->q);
$item = explode(" ", $q);
$i=0;
$select = "";
foreach($item as $item){
	if($i>0) $select .= ", ";
	$select .= "title|body|body_hero|body_list%=$item";
	$i++;
}
echo "<section id='info'><div class='container'><h1>Haku</h1>";
$item = $pages->findMany($select);
if($item->first->id){
	$content .= "<p>Haku löysi $item->count tulosta haulle: \"$q\".</p>";
	foreach($item as $item) echo "<div class='result'><h2>". $item->get("headline|title") ."</h2><p>". summary($item) ."</p><p><a class='nappi bgb' href='$item->url'>Lue lisää</a></p></div>";
} else {
	echo "<p>No results.</p>";
}
echo "</div></div>";
