<?php

include './admin/config.php';
include './admin/db_connection.php';

if($_POST['new_add_mount_form'] == '1'){
?>

<div class="serviceOrderSetDIV">
    <div>
        <label>Originals<span class="ref_div_star">*</span></label>
        <input class="order_0_set1_0_original k-input kdText " style="width:70px;" id="original_lam" name="original_lam" type="number" min="1">
    </div>
    <div style="width: 100%;float: left;">
        <input type="checkbox" name="all_books" id="all_books" checked="checked" style="width: 2% !important;" onclick="get_all_booklet();" />All Originals to be Mounted / Laminated alike
    </div>

    <div style="width: 100%;float: left;">
        <div style="float:left;width:100%;">
            <ul class="arch_radio">
                <li><input type="radio" name="mount_lam_check" id="mount_lam_check" style="width:2% !important;" value="1" onclick="return active_mount();"><span id="plotting_check_spn" style="font-size: 13px;padding-left: 7px;font-weight: bold;">Mounting</span></li>
                <li><input type="radio" name="mount_lam_check" id="mount_lam_check_0" style="width:2% !important;" value="0" onclick="return active_lamin();"><span id="plotting_check_0_spn" style="font-size: 13px;padding-left: 7px;font-weight: bold;">Laminating</span></li>
                <li><input type="radio" name="mount_lam_check" id="mount_lam_check_1" style="width:2% !important;" value="0" onclick="return active_both();"><span id="plotting_check_0_spn" style="font-size: 13px;padding-left: 7px;font-weight: bold;">Both</span></li>
            </ul>
            <span id="errmsg_mount"></span>
        </div>
    </div>

    <div id="ass_option" style="width: 100%;float: left;background-color: #F6F2F2;padding: 5px;">
            <div style="clear:both;"><label>Mounting<span id="mounting_req" style="color: red;display: none;">*</span></label>
            <div class="drop" style="margin-right:0px;margin-left:0px;height:2px;">
                <div style="float:left;margin-right:0px;">
                    <select class="order_0_set1_0_mounting kdSelect " style="width:150px;" id="mounting_select" name="mounting_select" onchange="return restrict_number();">
                        <option value="none" selected="selected">None</option>
                        <option value="FoamBoard 3/16 White">FoamBoard 3/16 White</option>
                        <option value="FoamBoard 3/16 Black">FoamBoard 3/16 Black</option>
                        <option value="FoamBoard 1/2 White">FoamBoard 1/2 White</option>
                        <option value="FoamBoard 1/2 Black">FoamBoard 1/2 Black</option>
                        <option value="GatorBoard 3/16 White">GatorBoard 3/16 White</option>
                        <option value="GatorBoard 3/16 Black">GatorBoard 3/16 Black</option>
                        <option value="GatorBoard 1/2 White">GatorBoard 1/2 White</option>
                        <option value="GatorBoard 1/2 Black">GatorBoard 1/2 Black</option>
                        <option value="Plasti-Cor  WHITE">Plasti-Cor  WHITE</option>
                        <option value="Illustration Board 1/8 White">Illustration Board 1/8 White</option>
                        <option value="Illustration Board 1/8 Black">Illustration Board 1/8 Black</option>                                                                                
                    </select>
                </div>
                <div class="dropdown_selector">

                </div>

            </div>

        </div>
        <div>
            <label>Lamination<span id="laminating_req" style="color: red;display: none;">*</span></label>
            <div class="drop" style="margin-right:0px;margin-left:0px;height:2px;">
                <div style="float:left;margin-right:0px;">
                    <select class="order_0_set1_0_lamination kdSelect " style="width:150px;" id="lamination_select" onchange="return lamination_value_change();" name="lamination_select">
                        <option value="none" selected="selected">None</option>
                        <option value="Lamination Pouch,7mil 9x12 Gloss">Lamination Pouch,7mil 9x12 Gloss</option>
                        <option value="Lamination Pouch,7mil 12x18 Gloss">Lamination Pouch,7mil 12x18 Gloss</option>
                        <option value="Lamination, 3mil Satin">Lamination, 3mil Satin</option>
                        <option value="Lamination, 3mil Gloss">Lamination, 3mil Gloss</option>                                                                               
                    </select>
                </div>                                                                        
            </div>                                                                            
        </div>
        <div style="text-align: center;">
            <label>Dimensions ( " )</label>
            <div class="drop" style="margin-right:0px;margin-left:0px;height:2px;">
                <div style="float:left;margin-right:0px;">
                    <input type="hidden" name="width_val_set" id="width_val_set" value="48" />
                    <input class="order_0_set1_0_original k-input kdText " style="width: 40px;margin-left: 10px;padding: 3px;" id="width_values" onkeyup="return width_value_restriction();" min="1" max="48" name="width_values" type="number"> 
                   <span style="margin-right: 10px;">W</span>  
                </div>  
                <div style="float:left;margin-right:0px;">
                    <input type="hidden" name="length_val_set" id="length_val_set" value="96" />
                    <input class="order_0_set1_0_original k-input kdText " style="width: 40px;padding: 3px;" id="length_values" onkeyup="return length_value_restriction();" min="1" max="96" name="width_values"  type="number">                                                                            
                   <span>L</span>  
                </div> 
            </div>                                                                            
        </div>

            <div class="grom">
            <label>Grommets</label>                                                                   
            <input type="checkbox" id="grommets" name="grommets" value="grommets" style="margin-top: 5px !important;">                                                                                                                                                 
        </div>
        </div>

    <div id="booklet" style="width: 100%;float: left;">

    </div>
    <div style="width: 100%;float: left;font-weight: bold;font-size: 13px;border-bottom: 1px solid #FF7E00;">
        Special Instructions
    </div>
    <div id="sp_inst" style="margin-top:10px;">
        <textarea class="splins" id="splins" rows="4" cols="60" style="min-width: 370px;min-height: 60px;max-width: 370px;max-height: 60px;"></textarea>
    </div> 

</div>
<?php } ?>