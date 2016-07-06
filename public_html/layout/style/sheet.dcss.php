<?php
$i = mt_rand(0,7);
$imgDIR = "/images/";
switch ($i) {
    case 0:
        $url=$imgDIR . "bg1.jpg";
        break;
    case 1:
        $url=$imgDIR . "bg2.jpg";
        break;
    case 2:
        $url=$imgDIR . "bg3.jpg";
        break;
    case 3:
        $url=$imgDIR . "bg4.jpg";
        break;
    case 4:
        $url=$imgDIR . "bg5.jpg";
        break;
    case 5:
        $url=$imgDIR . "bg6.jpg";
        break;
    case 6:
        $url=$imgDIR . "bg7.jpg";
        break;
     case 7:
        $url=$imgDIR . "bg8.jpg";
        break;
    default:
       $url=$imgDIR . "bg1.jpg";
}  

$url_st=$imgDIR . "cave.jpg";

echo ".container_bg { \n";
echo "background-image:url(\"",$url,"\");\n";
echo "height:1080px;\n";
echo "width:100%;\n";
echo "background-size:cover;\n";
echo "background-position: 0,0;\n";
echo "opacity:1;\n";
echo "}\n";

echo ".container_st { \n";
echo "background-image:url(\"",$url_st,"\");\n";
echo "height: 1080px;\n";
echo "width:100%;\n";
echo "background-size:cover;\n";
echo "background-position: 0,0;\n";
echo "opacity:1;\n";
echo "}\n";

echo ".btn-outline\n";
echo "{\n";
echo "background-color: transparent;\n";
echo "color: inherit;\n";
echo "border-width: 2px;\n";
echo "-webkit-transition: all 0.75s;\n";
echo "-moz-transition: all 0.75s;\n";
echo "transition: all 0.75s;\n";
echo "height: 80%;\n";
echo "}\n";

?>