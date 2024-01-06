<?php
$tags = array(
  $kekkon = array (
    'name' => '結婚記念日',
    'url' => 'https://peruco.net/post172/',
  ),
  $mother = array (
    'name' => '母の日',
    'url' => 'https://peruco.net/post174/',
  ),
)
?>
<?php
  foreach($tags as $tag) {
    echo '<a href="'.$tag['url'].'">'.$tag['name'].'</a>';
  };
?>
