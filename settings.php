<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.js"></script>

<h1>Font Changer Settings</h1>
<?php
global $wpdb;
$user_id = get_current_user_id();
if(isset($_POST["submit"])){
    $data["font_changer_font"] = $_POST["font_changer_font"];
    $data["font_changer_exclude"] = $_POST["font_changer_exclude"];
    $data["font_changer_editor"] = $_POST["font_changer_editor"];
    foreach ($data as $key => $value) {
        update_option($key, $value);
    }
}
?>
<form method="post" enctype="multipart/form-data">
    <table class="ui collapsing striped table">
        <tr>
        <td>Select Font</td>
        <td><select  name="font_changer_font" >
                <option value="Noto Nastaliq Urdu">Noto Nastaliq Urdu</option>
                <option value="Tiro Telugu">Tiro Telugu</option>
            </select>
        </td>
        </tr>
        <tr>
            <td>Exclude elements</td>
            <td><input type="text" name="font_changer_exclude" >
            </td>
        </tr>
        <tr>
        	<td>RTL in admin editor</td>
        	<td>
        		<input type="checkbox" name="font_changer_editor" value="yes">
        	</td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" name="submit" value="Save" class="ui blue mini button"></td>
        </tr>
    </table>
</form>
<?php
$data["font_changer_font"] = get_option("font_changer_font");
$data["font_changer_exclude"] = get_option("font_changer_exclude");
if(!$data["font_changer_exclude"]){
	$data["font_changer_exclude"] = 'i,#wpadminbar,span.ab-icon,.fa,.ab-item span,.i,.elementor-icon';
}
$data["font_changer_editor"] = get_option("font_changer_editor");

?>
<script type="text/javascript">
    jQuery('select[name=font_changer_font]').val('<?php echo $data["font_changer_font"]; ?>');
    jQuery('input[name=font_changer_exclude]').val('<?php echo $data["font_changer_exclude"]; ?>');
    <?php 
    if ($data["font_changer_editor"]=='yes') {
			echo "jQuery('input[name=font_changer_editor]').prop('checked',true);";
    } else {
			echo "jQuery('input[name=font_changer_editor]').prop('checked',false);";
    }
		?>
</script>
<script type="text/javascript">
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
<?php
/* Powered By Haysky Code Generator: KEY
[["select","font_changer_direction,Left to Right,Right to Left"],["select","font_changer_font,Noto Nastaliq Urdu,Tiro Telugu"],["text","font_changer_exclude"],["text","font_changer_line_height"],["submit","Settings"]]
*/
?>