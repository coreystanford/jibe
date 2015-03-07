<?php 

function displayList($name, $array, $type = ""){
    
    $result = '';

    if($type == 'checkbox'){

        foreach ($array as $key => $value){
        if (isset($_POST[$name]) && in_array($value, $_POST[$name])) {
                $result .= '<input type="checkbox" name="' . $name . '[]' . '" value="' . $value . '" checked />' . $value;
            }
            else {
                $result .= '<input type="checkbox" name="' . $name . '[]' . '" value="' . $value . '"  />' . $value;
            }
        }
        return $result;

    } else if($type == 'checkboxlist'){

        $result .= '<ul>';

            foreach ($array as $key => $value){
            if (isset($_POST[$name]) && in_array($value, $_POST[$name])) {
                    $result .= '<li><input type="checkbox" name="' . $name . '[]' . '" value="' . $value . '" checked />' . $value . '</li>';
                }
                else {
                    $result .= '<li><input type="checkbox" name="' . $name . '[]' . '" value="' . $value . '"  />' . $value . '</li>';
                }
            }

        $result .= '</ul>';

        return $result;

    } else if($type == 'radio'){

        foreach ($array as $key => $value){
        if (isset($_POST[$name]) && $_POST[$name] == $value) {
                $result .= '<input type="radio" name="' . $name . '" value="' . $value . '" checked  />' . $value;
            } else {
                $result .= '<input type="radio" name="' . $name . '" value="' . $value . '"  />' . $value;
            }
        }
        echo $result;

    } else if($type == 'radiolist'){

        $result .= '<ul>';

            foreach ($array as $key => $value){
            if (isset($_POST[$name]) && $_POST[$name] == $value) {
                    $result .= '<li><input type="radio" name="' . $name . '" value="' . $value . '" checked  />' . $value . '</li>';
                } else {
                    $result .= '<li><input type="radio" name="' . $name . '" value="' . $value . '"  />' . $value . '</li>';
                }
            }

        $result .= '<ul>';

        return $result;

    } else if($type == 'multiple'){

        $result .= "<select ".$type." name='".$name."[]'>";

            foreach ($array as $key => $value){   
            if (isset($_POST[$name]) && in_array($value, $_POST[$name])) {
                    $result .= '<option value="' . $value . '" selected>' . $value . '</option>';
                }
                else {
                    $result .= "<option value='".$value."'>".$value."</option>";
                }
            }

        $result .= "</select>";

        return $result;

    } else {

        array_unshift($array, 'Select');

        $result .= "<select name='".$name."'>";

            foreach ($array as $key => $value){
                if (isset($_POST[$name]) && $_POST[$name] == $value) {
                    $result .= "<option value='".$value."' selected>".$value."</option>";
                } else {
                    $result .= "<option value='".$value."'>".$value."</option>";
                }
            }
            
        $result .= "</select>";

        return $result;

    }

}

?>