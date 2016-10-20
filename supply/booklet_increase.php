<?php
if ($_POST['number_of_booklet'] != '') {

    $booklet_value = $_POST['number_of_booklet'];

    for ($x = 1; $x <= $booklet_value; $x++) {
        
        $x_initial_value    =   ($x == '1')? '101' : $x;
        ?>
        <div style="width:100%;float:left;margin-top: 10px;margin-bottom: 10px;background-color: #F6F2F2;padding: 5px;">
            <div style="width:100%;float:left;font-weight: bold;font-size: 15px;margin-bottom: 10px;">Book <?php echo $x_initial_value; ?></div>
            <div style="width:20%;float:left;margin-bottom: 5px;">
                <label>Size</label>
                <select class="" style="" id="size_<?php echo $x_initial_value; ?>" name="size" onchange="return change_size_dyn('<?php echo $x_initial_value; ?>');">
<!--                    <option value="N">None</option>-->
                    <option selected="selected">8.5x11</option>
                    <option>8.5x14</option>
                    <option>11x17</option>                    
                    <option>Custom</option>
                </select>
            </div>
            <div style="width: 79%;float: left;">
                <div style="width:20%;float:left;">
                    <div>
                        <label>Binding Style</label>
                        <select class="order_0_set1_0_binding kdSelect " style="width:150px;" id="binding_main_option_<?php echo $x_initial_value; ?>" name="" onchange="return get_child_option('<?php echo $x_initial_value; ?>');">
                          <!--<option value="N">None</option>-->
                          <option value="1">Wire-O</option>
                          <option value="4">Acco Bind</option>
                          <option value="3">Screw Post</option>
                          <option value="7">Velo Bind</option>                            
                          <option value="6">GBC</option>
                          <option value="8">FastBack</option>
                          <option value="2">Perfect Bind</option>
                          <option value="9">Coil</option>
                          <option value="5">Staple</option>                            
                        </select>
                    </div>
                </div>
                <div style="width: 20%;float: left;margin-left: 40px;">
                    <div>
                        <label>Binding Option</label>
                        <select class="order_0_set1_0_bindingVariation kdSelect " style="width:120px;" id="binding_child_option_<?php echo $x_initial_value; ?>" name="">
                            <option value="10">Black</option>
                            <option value="11">White</option>
                            <option value="12">Silver</option>     
                         </select> 
                    </div>
                </div>
                <div style="width: 20%;float: left;margin-left: 40px;">
                    <div>
                       <label>Cutting</label>
                        <select class="order_0_set1_0_bindingVariation kdSelect " style="width:120px;" id="cutting_option_<?php echo $x_initial_value; ?>" name="cutting_option" onchange="return cutting_spl_inc_dyn('<?php echo $x_initial_value; ?>');" >
                            <option value="0">None</option>
                            <option value="1">Yes</option>
                         </select> 
                    </div>
                </div>
            </div>
            <div style="width: 79%;float: left;margin-top: 10px;">
                 <div style="width: 20%;float: left;">                     
                        <label>Front Cover</label>
                        <select class="" id="front_main_option_<?php echo $x_initial_value; ?>" name="" onchange="return get_child_option_front('<?php echo $x_initial_value; ?>');">
                            <option value="N">None</option>
                            <option class="one_f" value="101">Clear Cover</option>
                            <option class="black_f" style="display: none;" value="10">Black</option>
                            <option class="white_f" style="display: none;" value="11">White</option>
                            <option class="two_f" value="102">Opaque Vinyl</option>
                            <option class="three_f" value="103">Frosted Cover</option>
                            <option class="four_f" value="104">Illustration Board</option>
                            <option class="five_f" value="105">Chipboard</option>
                        </select>
                 </div>
                <div style="width: 20%;float: left;margin-left: 40px;">
                    <div>
                    <label>Front Cover Options</label>
                    <select class="" id="binding_child_option_front_<?php echo $x_initial_value; ?>">
                        <option value="0">None</option>
                        <option value="N/A">N/A</option>
                    </select>
                    </div>
                </div>
                <div style="width: 20%;float: left;margin-left: 40px;">
                    <div>
                        <label>Back Cover</label>
                        <select id="back_main_option_<?php echo $x_initial_value; ?>"  onchange="return get_child_option_back('<?php echo $x_initial_value; ?>');" >
                            <option value="N">None</option>
                            <option class="one_b" value="201">Clear Cover</option>
                            <option class="black_b" style="display: none;" value="10">Black</option>
                            <option class="white_b" style="display: none;" value="11">White</option>
                            <option class="two_b" value="202">Opaque Vinyl</option>
                            <option class="three_b" value="203">Frosted Cover</option>
                            <option class="four_b" value="204">Illustration Board</option>
                            <option class="five_b" value="205">Chipboard</option>
                        </select>  
                    </div>
                </div>
                <div style="width: 20%;float: left;margin-left: 40px;">
                    <div>
                        <label>Back Cover Options</label>
                        <select id="binding_child_option_back_<?php echo $x_initial_value; ?>">
                            <option value="0">None</option>
                            <option value="N/A">N/A</option>
                        </select>  
                    </div>
                </div>
            </div>
            
           
        </div>
        <div id="size_custom_div_<?php echo $x_initial_value; ?>" style="width: 100%;float: left;display: none;border: 1px solid #FF7E00;text-align: center;margin-bottom: 10px;padding: 5px;">
            <label style="font-weight: bold;">Please Specify Custom Details : </label><textarea name="size_custom" id="size_custom" rows="3" cols="18" style="width: 201px;" placeholder="Custom Size"></textarea>
        </div>  


        <div id="cutting_spl_instructions_dynamic_<?php echo $x_initial_value; ?>" class="cutting_spl_instructions_dynamic" style="width: 100%;float:left;border: 1px solid #FF7E00;margin-top: 10px;display: none;">
            <div id="sp_inst" style="margin-top:10px;text-align: center;">
            <label style="font-weight: bold;">
              Cutting Instructions
            </label>
            <br>
            <textarea name="special_instruction_cutting" class="splins" id="special_instruction_cutting" rows="4" cols="60" style="margin-top:-5px;margin-bottom:10px;"></textarea>
          </div>
        </div>
        <?php
    }
}

