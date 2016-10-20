<?php
$page_names=explode("/",$_SERVER['SCRIPT_NAME']);

$pagename_pos = count($page_names)-1;

$page_name_new= $page_names[$pagename_pos];
$user_id         = $_SESSION['sohorepro_userid'];
$totoal_cart     = totalCart($user_id);
?>
<div id="content_output-navigation" style="margin-bottom: 0px !important;" >
    <ul class="navigation primary">
        <li class="navPlotting" onclick="return mask_show();">
            <a href="#service_plotting.php" class=" " style="<?php if($page_name_new=='service_plotting.php') { echo "font-weight: bold;"; } ?>font-weight: bold;">
                PLOTTING &amp; ARCHITECTURAL COPIES
            </a>
        </li>
        <li class="navLargeFormat" onclick="return mask_show();">
            <a href="#" class=" " style="text-decoration: none !important;color: #7D7070 !important;">
                LARGE FORMAT COLOR &amp; BW
            </a>
        </li>
        <li class="navFineArts" onclick="return mask_show();">
            <a href="#" class=" " style="text-decoration: none !important;color: #7D7070 !important;">
                FINE ART PRINTING
            </a>
        </li>
        <li class="navCopyshop" onclick="return mask_show();">
            <a href="#" class=" " style="text-decoration: none !important;color: #7D7070 !important;">
                COPY SHOP
            </a>
        </li>
        <li class="navMounting" onclick="return mask_show();">
            <a href="#" class=" " style="text-decoration: none !important;color: #7D7070 !important;">
                MOUNTING &amp; LAMINATING
            </a>
        </li>
        <li class="navBinding" onclick="return mask_show();">
            <a href="#" class=" " style="text-decoration: none !important;color: #7D7070 !important;">
                BINDING
            </a>
        </li>
        <li class="navScanning" onclick="return mask_show();">
            <a href="#" class=" " style="text-decoration: none !important;color: #7D7070 !important;">
                SCANNING
            </a>
        </li>
        <li class="navOffset" >
<!--            <a href="#" class=" " style="text-decoration: none !important;color: #7D7070 !important;">
                OFFSET PRINTING
            </a>-->
            <a href="service_offset.php" class="" style="<?php if($page_name_new=='service_offset.php') { echo "font-weight: bold;"; } ?>">
                OFFSET PRINTING
            </a>
        </li>
    </ul>
    <div style="clear:both">
    </div>

</div>