<?php
header("Content-Type:text/css");
function checkhexcolor($color){
    return preg_match('/^#[a-f0-9]{6}$/i', $color);
}

$color = '';
$secondColor = '';

if (isset($_GET['color']) AND $_GET['color'] != '') {
    $color = "#" . $_GET['color'];
}

if (!$color OR !checkhexcolor($color)) {
    $color = "#336699";
}

if (isset($_GET['secondColor']) AND $_GET['secondColor'] != '') {
    $secondColor = "#" . $_GET['secondColor'];
}

if (!$secondColor OR !checkhexcolor($secondColor)) {
    $secondColor = "#336699";
}


function hexToRgb($hex, $alpha = false) {
    $hex      = str_replace('#', '', $hex);
    $length   = strlen($hex);
    $rgb['r'] = hexdec($length == 6 ? substr($hex, 0, 2) : ($length == 3 ? str_repeat(substr($hex, 0, 1), 2) : 0));
    $rgb['g'] = hexdec($length == 6 ? substr($hex, 2, 2) : ($length == 3 ? str_repeat(substr($hex, 1, 1), 2) : 0));
    $rgb['b'] = hexdec($length == 6 ? substr($hex, 4, 2) : ($length == 3 ? str_repeat(substr($hex, 2, 1), 2) : 0));
    if ( $alpha ) {
       $rgb['a'] = $alpha;
    }
    return $rgb;
}

?>


:root{
    --base: <?php echo hexToRgb($color)['r']; ?>,
            <?php echo hexToRgb($color)['g']; ?>,
            <?php echo hexToRgb($color)['b']; ?>;
            
    --linear-bg: linear-gradient(50deg,<?php echo $color; ?>, <?php echo $secondColor; ?>);
    --linear-bg-hover: linear-gradient(50deg,<?php echo $secondColor; ?>, <?php echo $color; ?>);
            
}

.cookies-card a, .email-verify a{
    color: <?php echo $color; ?>;
}
.cookies-card a:hover{
    color: <?php echo $color; ?>;
}

