<?php 

function displayList($name, $array, $type = ""){
    
    switch($type){

        case 'checkbox':
            foreach ($array as $key => $value){
            if (isset($_POST[$name]) && in_array($value, $_POST[$name])) {
                    echo '<input type="checkbox" name="' . $name . '[]' . '" value="' . $value . '" checked />' . $value;
                }
                else {
                    echo '<input type="checkbox" name="' . $name . '[]' . '" value="' . $value . '"  />' . $value;
                }
            }
            break;

        case 'radio':
            foreach ($array as $key => $value){
            if (isset($_POST[$name]) && $_POST[$name] == $value) {
                    echo '<input type="radio" name="' . $name . '" class="' . $name . '" value="' . $value . '" checked  />' . $value;
                } else {
                    echo '<input type="radio" name="' . $name . '" class="' . $name . '" value="' . $value . '"  />' . $value;
                }
            }
            break;

        case 'multiple':
            echo "<select ".$type." name='".$name."[]'>";
            foreach ($array as $key => $value){   
            if (isset($_POST[$name]) && in_array($value, $_POST[$name])) {
                    echo '<option value="' . $value . '" selected>' . $value . '</option>';
                }
                else {
                    echo "<option value='".$value."'>".$value."</option>";
                }
            }
            echo "</select>";
            break;

        default:
            echo "<select name='".$name."'>";
            foreach ($array as $key => $value){
                if (isset($_POST[$name]) && $_POST[$name] == $value) {
                    echo "<option value='".$value."' selected>".$value."</option>";
                } else {
                    echo "<option value='".$value."'>".$value."</option>";
                }
            }
            echo "</select>";
            break;
    }

}

?>