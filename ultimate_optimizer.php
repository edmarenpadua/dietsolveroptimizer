<?php
  header( 'Cache-Control: no-store, no-cache, must-revalidate' ); 
  header( 'Cache-Control: post-check=0, pre-check=0', false ); 
  header( 'Pragma: no-cache' );
?>

<?php
    /*
    * Creates systems of linear equations from constraints
    * @params: equation to be "standardized"
    * returns the "standardized" eqaution
    */
    function parse_equation($equation){
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
            //     $rgx = "/([0-9]*[\.]?[0-9]*)([a-zA-Z]*[0-9]*)/";
            //     if (preg_match($rgx, $exploded[1])){
            //         $first = "+";
            //         $first .= $exploded[1];
            //         $exploded[1] = $first;
            //     }

            //     $exploded[1] = preg_replace('/\+/', "**", $exploded[1]);
            //     $exploded[1] = preg_replace('/\-/', "##", $exploded[1]);
            //     $exploded[1] = preg_replace('/\*\*/', "-", $exploded[1]);
            //     $exploded[1] = preg_replace('/\#\#/', "+", $exploded[1]);


            //     $LHS .= $exploded[1];
            //     $RHS = 0;

                $temp = $exploded[0];
                $LHS = $exploded[1];  
                $RHS = $temp;           
                $arr = array($LHS, $RHS);
                $eq_arr[$key] = implode("=", $arr);
            }
        }

        return $eq_arr;
    }

    /*
    * gets the variables from equation
    * @params: the equation where variables will be taken
    * @params: array where variables wil be placed
    * returns thea array of variables
    */
    function get_variables($equation_array, $variable_array){
        $regex = "/([\+\-]?[0-9]*[\.]?[0-9]*)([a-zA-Z]*[0-9]*)/";

        //find the LHS of the equation
        foreach ($equation_array as $key => $value) {
            preg_match_all($regex, $value, $output_array);
            //remove signs in evry term
            foreach ($output_array[2] as $key2 => $value2) {
                $value2 = preg_replace('/\+/', "", $value2);
                $value2 = preg_replace('/\-/', "", $value2);

                //if variable is not yet part of the variable array
                //and variable length > 0, push it to variable array
                if (!in_array($value2, $variable_array)&&strlen($value2)>0)
                    array_push($variable_array, $value2);
            }       
        }
        return $variable_array;
    }

    /*
    * gets the coefficient of a term
    * @params: the equation where variables will be taken
    * @params: array of variables used
    * returns a row vector of coefficients
    */
    function get_coeff($equation, $variable_array){
        $regex = "/([\+\-]?[0-9]*[\.]?[0-9]*)([a-zA-Z]*[0-9]*)/";
        $value = 1;
        $index = "";
        $coeff = [];
        $row_vector = [];
        
        preg_match_all($regex, $equation, $output_array);
        
        foreach ($output_array[0] as $key => $term) {
            //removes leading "plus" signs
            $term = preg_replace('/\+/', "", $term);
            
            //if number is found(decimal or whole number)
            //identify of there is a negative sign; if yes, negate the coeff
            //retain of positive
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

            //sets the index of the coeff bases from its literal
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

        //puts variables to a row vector
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

    /*
    * returns an aasoc array of basic solution of an eqaution
    * @params: the eqaution and the array of variables usd
    */
    function get_basic_solution($eq_arr, $variable_array){
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

        return $basic;
    }

    /*
    * returns 1 if there is still a negative element, else 0
    * @params: row vector
    */
    function is_negative($equation){
        foreach ($equation as $key => $value) {
            if($key == sizeof($equation)-1)
                return 0;

            if ($value < 0)
                return 1;
        }
    }

    /*
    * performs gauss jrdan on matrix
    * @params: the matrix of eqautions
    * retuns a pivoted matrix
    */
    function pivot($eq_arr){
        $max = 0;
        $idx = 0;

        //searches for the PIVOT COL from the obj function
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

        //searches for the PIVOT ROW
        foreach ($eq_arr as $k => $v) {
            foreach ($eq_arr[$k] as $key => $value) {
                if ($key == $idx && $k != sizeof($eq_arr)-1) {
                    $ans = $eq_arr[$k][sizeof($eq_arr[0])-1];
                   
                    if ($value > 0) {
                        if ($ans/$value < $min_ratio) {
                            $min_ratio = $ans/$value;
                            $ratio_indx = $k;
                       }
                    }
                }
            }
        }

        $pivot_col = $idx;
        $pivot_row = $ratio_indx;

       
        $denumer = $eq_arr[$pivot_row][$pivot_col];

        if ($denumer <= 0) {
            return 0;
        }

        foreach ($eq_arr[$pivot_row] as $key => $value) {
            //normalizes the pivot row
            $eq_arr[$pivot_row][$key] = $value/$denumer;
        }
        //var_dump($eq_arr);

        //implement pivoting
        //curr_row_elem = curr_row_elem - (pivot_col_elem * pivot_row_elem);
        foreach ($eq_arr as $k => $v) {
            $pivot_element = $eq_arr[$k][$pivot_col];
            foreach ($eq_arr[$k] as $key => $value) {
                if ($k != $pivot_row) {
                   $eq_arr[$k][$key] = $value-($pivot_element*$eq_arr[$pivot_row][$key]);
                    $num = $pivot_element;
                }
            }
        }

        return $eq_arr;
        
    }



    if($_SERVER["REQUEST_METHOD"]=="POST"){
        //get form POST
        $obj_function = $_POST["obj_function"];

        $constraints = $_POST["constraints"];
        $optimize = $_POST["optimize"];
        
        //standardize functions
        $parsed_objFunc = parse_equation($obj_function);
        $parsed_const = parse_equation($constraints);

        //array for holding variables to be used for simplex
        $variable_array = [];
    
        //get variables from functions
        $variable_array = get_variables($parsed_const, $variable_array);
        $variable_array = get_variables($parsed_objFunc, $variable_array);
        array_push($variable_array, "answer");

        //matrix for  tableau
        $eq_arr = [];
         foreach ($parsed_const as $a => $b) {
            $eq_arr[$a] = get_coeff($parsed_const[$a], $variable_array);
        }
        $eq_arr[sizeof($parsed_const)]=get_coeff($parsed_objFunc[0], $variable_array);

        //negate objective function in the tableau
        if ($optimize == 0)
            foreach ($eq_arr[sizeof($parsed_const)] as $last => $val) {
                if ($last != sizeof($variable_array)-2) {
                    $eq_arr[sizeof($parsed_const)][$last] = $val*-1;
                }
            }

        //get initial tableau and basic solution
        $init_tableau = $eq_arr;
        $bs = get_basic_solution($eq_arr, $variable_array);

        $tableau = [];
        $basic_sol = [];
        $count = 0;


        //get tableau and basic sol for other rows
       while(is_negative($eq_arr[sizeof($eq_arr)-1])){
            $eq_arr = pivot($eq_arr);
            $tableau[$count] =  $eq_arr;
            $basic_sol[$count] = get_basic_solution($eq_arr, $variable_array);
            $count++;
       }

    }//end of $_SERVER["REQUEST_METHOD"]=="POST"
?>

