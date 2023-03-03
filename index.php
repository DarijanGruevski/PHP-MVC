<?php 
    require('model/database.php');
    require('model/flights_db.php');
    require('model/company_db.php');

    $flight_id = filter_input(INPUT_POST,'flight_id',FILTER_VALIDATE_INT);
    $origin = filter_input(INPUT_POST,'origin',FILTER_SANITIZE_STRING);
    $destination = filter_input(INPUT_POST,'destination',FILTER_SANITIZE_STRING);
    $company_name = filter_input(INPUT_POST,'company_name',FILTER_SANITIZE_STRING);
    $country = filter_input(INPUT_POST,'country',FILTER_SANITIZE_STRING);

    $companyID = filter_input(INPUT_POST,'companyID',FILTER_VALIDATE_INT);
    if(!$companyID){
        $companyID = filter_input(INPUT_GET,'companyID',FILTER_VALIDATE_INT);
    }

    $action = filter_input(INPUT_POST,'action',FILTER_SANITIZE_STRING);

    if(!$action){
        $action = filter_input(INPUT_GET,'action',FILTER_SANITIZE_STRING);
        if(!$action){
        $action = 'list_flights';
    }
}


    switch($action){
        case "list_companies":
            $companies=get_companies();
            include('view/company_list.php');
            break;
            
        case "add_company":
            add_company($company_name,$country);
            header("Location: .?action=list_companies");
            break;
        
        case "add_flight":
        if($companyID && $origin && $destination){
            add_flight($companyID,$origin,$destination);
            header("Location: .?companyID=$companyID");
        }
        else{
            $error = "Invalid Flight data. Check all fields and try Again.";
            include('view/error.php');
            exit();
        }
        break;

    case "delete_company" :
        if($companyID){
            try{
                delete_company($companyID);
            } catch(PDOException $e){
                $error = "You cannot delete a company if flights exist for the company";
                include('view/error.php');
                exit();
            }
            header("Location: .?action=list_companies");
        }
        break;
        case "delete_flight" :  
            if($flight_id){
                delete_flights($flight_id);
                header("Location: .?ID=$companyID");
            }
            else{
                $error = "Missing or incorrect flight ID";
                include('view/error.php');
            }
            break;
        default: 
            $company_name = get_company_name($companyID);
            $companies = get_companies();
            $flights = get_flights_by_companies($companyID);
            include('view/flights_list.php');
    }