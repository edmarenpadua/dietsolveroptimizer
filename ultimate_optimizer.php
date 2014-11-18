<?php
  header( 'Cache-Control: no-store, no-cache, must-revalidate' ); 
  header( 'Cache-Control: post-check=0, pre-check=0', false ); 
  header( 'Pragma: no-cache' );
?>

<?php
    function parse_equation($equation, $optimize = NULL){
        echo "<br>PARSIINNNGG.. :3<br>";
        //remove all spaces
        $slack = 1;
        $equation = preg_replace('/\s+/', '', $equation);

        $eq_arr = str_getcsv($equation);
        
        //introduce slack variables to equations
        foreach ($eq_arr as $key => $value) {
            $value = preg_replace('/</', "+S{$slack}", $value);
            $value = preg_replace('/>/', "-S{$slack}", $value);
            $slack++;
            
            //explode equation to LHS and RHS
            //and arrange equation to "ax + by = c" format
            $exploded = explode('=',$value);

            if (preg_match("/[\+\-]/", $exploded[0])){
                $eq_arr[$key] = $value;
            }
            else{
                $rgx = "/([0-9]*[\.]?[0-9]*)([a-zA-Z]*[0-9]*)/";
                if (preg_match($rgx, $exploded[1])){
                    $first = "+";
                    $first .= $exploded[1];
                    $exploded[1] = $first;
                }

                $exploded[1] = preg_replace('/\+/', "**", $exploded[1]);
                $exploded[1] = preg_replace('/\-/', "##", $exploded[1]);
                $exploded[1] = preg_replace('/\*\*/', "-", $exploded[1]);
                $exploded[1] = preg_replace('/\#\#/', "+", $exploded[1]);

                $LHS = $exploded[0];
                $LHS .= $exploded[1];
                $RHS = 0;

                $arr = array($LHS, $RHS);
                $eq_arr[$key] = implode("=", $arr);
            }

            // if ($optimize == 1) {
            //     $exploded = explode('=',$value);
            //     $first = "-";
            //     $first .= $exploded[1];
            //     $exploded[1] = $first;

            //     $arr = array($exploded[0], $exploded[1]);
            //     $eq_arr[$key] = implode("=", $arr);
            // }
        }

        var_dump($eq_arr);
        return $eq_arr;
    }

    function get_variables($equation_array, $variable_array){
        $regex = "/([\+\-]?[0-9]*[\.]?[0-9]*)([a-zA-Z]*[0-9]*)/";

        //find the LHS of the equation
        foreach ($equation_array as $key => $value) {
            preg_match_all($regex, $value, $output_array);
            //remove signs in evry term
            foreach ($output_array[2] as $key2 => $value2) {
                $value2 = preg_replace('/\+/', "", $value2);
                $value2 = preg_replace('/\-/', "", $value2);

                if (!in_array($value2, $variable_array)&&strlen($value2)>0)
                    array_push($variable_array, $value2);
            }       
        }
        return $variable_array;
    }

    function get_coeff($equation, $variable_array){
        $regex = "/([\+\-]?[0-9]*[\.]?[0-9]*)([a-zA-Z]*[0-9]*)/";
        $value = 1;
        $index = "";
        $coeff = [];
        $row_vector = [];
        
        preg_match_all($regex, $equation, $output_array);
        
        foreach ($output_array[0] as $key => $term) {
            $term = preg_replace('/\+/', "", $term);
            
            if (preg_match("/[\+\-]?[0-9]*[\.]?[0-9]*/", $term, $match) && strlen($term)>0){
                if (preg_match('/\-/', $match[0], $m)){
                    $match[0] = preg_replace('/\-/', "", $match[0]);
                    $value = -1*$match[0];
                    if (strlen($m[0])==1)
                        $value = -1;
                }   
                else{
                    $value =  1*$match[0];
                    if (strlen($match[0])==0)
                        $value = 1;
                }
            }

            //echo "TERM: ${term} <br/>";
            if (strlen($term)>0){
                if (preg_match("/[a-zA-Z]+[0-9]*/", $term, $match)){
                    $index = $match[0];
                }   
                else{
                    $index = "ans";
                }
            }
            $coeff[$index] = $value;
        }

        $ctr = 0;
        while ($ctr != sizeof($variable_array)) {
            array_push($row_vector, 0);
            $ctr++;
        }

        foreach ($variable_array as $k => $v) {
            foreach ($coeff as $i => $c) {
                if ($v == $i)
                    $row_vector[$k] = $c;
                if ($i == "ans")
                    $row_vector[sizeof($variable_array)-1] = $c;
            }
        }

        return $row_vector;
    }

    function get_basic_solution($eq_arr, $variable_array){
        //var_dump($eq_arr);
        $ctr = 0;
        $basic = [];
        while($ctr != sizeof($variable_array)-1){
            $sum = 0;
            foreach ($eq_arr as $i => $v) {
                $sum += abs($eq_arr[$i][$ctr]);
                if(abs($eq_arr[$i][$ctr])==1){
                    $basic[$ctr] = ($eq_arr[$i][$ctr])*$eq_arr[$i][sizeof($variable_array)-1];
                }
            }
            if ($sum > 1) {
               $basic[$ctr] = 0;
            }
            $ctr++;
        }

        //var_dump($basic);
        return $basic;
    }

    function is_negative($equation){
        foreach ($equation as $key => $value) {
            if($key == sizeof($equation)-1)
                return 0;

            if ($value < 0)
                return 1;
        }
    }

    function pivot($eq_arr){
        //var_dump($eq_arr);
        $max = 0;
        $idx = 0;

        foreach ($eq_arr[sizeof($eq_arr)-1] as $key => $value) {
            if ($value < 0) {
                if (abs($value) > $max) {
                    $max = abs($value);
                    $idx = $key;
               }
            }
        }

        $min_ratio = 1000000000;
        $ratio_indx = 0;
        foreach ($eq_arr as $k => $v) {
            foreach ($eq_arr[$k] as $key => $value) {
                if ($key == $idx) {
                    $ans = $eq_arr[$k][sizeof($eq_arr[0])-1];
                   
                    if ($value > 0) {
                        if ($ans/$value < $min_ratio) {
                            $min_ratio = $ans/$value;
                            $ratio_indx = $k;
                       }
                    }
                }
                //echo "${value} ";
            }
            //echo "<br>";
        }

        $pivot_col = $idx;
        $pivot_row = $ratio_indx;

        //normalize
        $denumer = $eq_arr[$pivot_row][$pivot_col];
        foreach ($eq_arr[$pivot_row] as $key => $value) {
            //echo "numer: ${numer} denumer: ${denumer}<br>";
            $eq_arr[$pivot_row][$key] = $value/$denumer;
        }

        foreach ($eq_arr as $k => $v) {
            $pivot_element = $eq_arr[$k][$pivot_col];
            foreach ($eq_arr[$k] as $key => $value) {
                if ($k != $pivot_row) {
                   $eq_arr[$k][$key] = $value-($pivot_element*$eq_arr[$pivot_row][$key]);
                    $num = $pivot_element;
                }
            }
        }

         //echo "PIVOT COL: ${pivot_col} PIVOT ROW: ${pivot_row}<br>";
         //var_dump($eq_arr);
        return $eq_arr;
    }


    //if($_SERVER["REQUEST_METHOD"]=="POST"){
        $_POST["obj_function"] = "p=x+y+5";
        $_POST["constraints"] = "x+y<=2,3 x + y > = 4, x>=0, y>=0";
        $_POST["optimize"] = "1";
        $obj_function = $_POST["obj_function"];
        $constraints = $_POST["constraints"];
        $optimize = $_POST["optimize"];

        // echo "Maximize {$obj_function} </br> subject to: ";
        // echo "{$constraints}<br>";
        // echo "OPTIMIZE: {$optimize}";
        
        $parsed_objFunc = parse_equation($obj_function, $optimize);
        $parsed_const = parse_equation($constraints);

        var_dump($parsed_objFunc);
        //var_dump($parsed_const);

        $variable_array = [];
    
        $variable_array = get_variables($parsed_const, $variable_array);
        $variable_array = get_variables($parsed_objFunc, $variable_array);
        array_push($variable_array, "answer");

        $eq_arr = [];

         foreach ($parsed_const as $a => $b) {
            $eq_arr[$a] = get_coeff($parsed_const[$a], $variable_array);
        }
        $eq_arr[sizeof($parsed_const)]=get_coeff($parsed_objFunc[0], $variable_array);

        $init_tableau = $eq_arr;

        //var_dump($variable_array);

        $bs = get_basic_solution($eq_arr, $variable_array);

        //var_dump($bs);

        $tableau = [];
        $basic_sol = [];
        $count = 0;

       while(is_negative($eq_arr[sizeof($eq_arr)-1])){
            $eq_arr = pivot($eq_arr);
            $tableau[$count] =  $eq_arr;
            $basic_sol[$count] = get_basic_solution($eq_arr, $variable_array);
            $count++;
       }

       //var_dump($basic_sol);
       //var_dump($tableau);


    //}
?>

