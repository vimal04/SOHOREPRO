<?php
if ($_POST['number_of_booklet'] != '') {

    $booklet_value = $_POST['number_of_booklet'];

    for ($x = 1; $x <= $booklet_value; $x++) {
        ?>
        <div style="width:100%;float:left;margin-top: 10px;margin-bottom: 10px;background-color: #F6F2F2;padding: 5px;">
            <div style="width:100%;float:left;font-weight: bold;font-size: 15px;margin-bottom: 10px;">Original <?php echo $x; ?></div>
            <div style="clear:both;"><label>Mounting</label>
            <div class="drop" style="margin-right:0px;margin-left:0px;height:2px;">
                <div style="float:left;margin-right:0px;">
                    <select class="order_0_set1_0_mounting kdSelect " style="width:150px;" id="order_0_set1_0_mounting" name="">
                        <option value="none" selected="selected">None</option>
                        <option value="3308">FoamBoard 3/16 White</option>
                        <option value="3309">FoamBoard 3/16 Black</option>
                        <option value="3315">FoamBoard 1/2 White</option>
                        <option value="3316">FoamBoard 1/2 Black</option>
                        <option value="3311">GatorBoard 3/16 White</option>
                        <option value="3312">GatorBoard 3/16 Black</option>
                        <option value="3317">GatorBoard 1/2 White</option>
                        <option value="3318">GatorBoard 1/2 Black</option>
                        <option value="3319">Plasti-Cor  WHITE</option>
                        <option value="3313">Illustration Board 1/8 White</option>
                        <option value="3313">Illustration Board 1/8 Black</option>                                                                                
                    </select>
                </div>
                <div class="dropdown_selector">

                </div>

            </div>

            </div>
            <div>
            <label>Lamination</label>
            <div class="drop" style="margin-right:0px;margin-left:0px;height:2px;">
                <div style="float:left;margin-right:0px;">
                    <select class="order_0_set1_0_lamination kdSelect " style="width:150px;" id="order_0_set1_0_lamination" name="order[0][set1][0][lamination]">
                        <option value="none" selected="selected">None</option>
                        <option value="3317">Lamination Pouch,7mil 9x12 Gloss</option>
                        <option value="3317">Lamination Pouch,7mil 12x18 Gloss</option>
                        <option value="3319">Lamination, 3mil Satin</option>
                        <option value="3319">Lamination, 3mil Gloss</option>                                                                               
                    </select>
                </div>                                                                        
            </div>                                                                            
            </div>
            <div>
            <label>Dimensions</label>
            <div class="drop" style="margin-right:0px;margin-left:0px;height:2px;">
                <div style="float:left;margin-right:0px;">
                   <input class="order_0_set1_0_original k-input kdText " style="width: 40px;margin-left: 10px;padding: 3px;" id="order_0_set1_0_original" name="order[0][set1][0][original]" type="text">
                   <span style="margin-right: 10px;">W</span>  
                </div>  
                <div style="float:left;margin-right:0px;">                  
                  <input class="order_0_set1_0_original k-input kdText " style="width: 40px;padding: 3px;" id="order_0_set1_0_original" name="order[0][set1][0][original]" type="text">
                  <span>L</span>  
                </div> 
            </div>                                                                            
            </div>

            <div>
            <label>Grommets</label>                                                                   
            <input type="checkbox" id="grommets" name="grommets" value="grommets">                                                                                                                                                 
            </div>
        </div>        
        <?php
    }
}

