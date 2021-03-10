<pre>
<?php 

$postdata = http_build_query(
    array(
        'var1' => 'некоторое содержимое',
        'var2' => 'doh'
    )
);

$opts = array('http' =>
    array(
        'method'  => 'POST',
        'header'  => 'Content-type: application/x-www-form-urlencoded',
        'content' => $postdata
    )
);

$context = stream_context_create($opts);
#var_dump( $context);
$result = file_get_contents('http://chesslionleague.ru/libs/test.php', false, $context);
var_dump($result);
echo "123";

 ?></pre>