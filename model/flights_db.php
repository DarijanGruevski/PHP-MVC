<?php 

function get_flights_by_companies($company_id){

    global $db;

    if($company_id){
        $query = 'SELECT F.FlightID, F.Origin, F.Destination, C.Name
        FROM flight as F LEFT JOIN company as C ON F.companyID = C.ID WHERE F.companyID = :company_id ORDER BY F.FlightID';

    } else{
        $query = 'SELECT F.FlightID, F.Origin, F.Destination, C.Name
        FROM flight as F LEFT JOIN company as C ON F.companyID = C.ID  ORDER BY C.ID'; 
    }
    $statement = $db ->prepare($query);
    if($company_id){
    $statement->bindValue(':company_id', $company_id);
    }
    $statement->execute();
    $flights = $statement->fetchAll();
    $statement->closeCursor();
    return $flights;
}

    function delete_flights($flight_id){
        global $db;
        $query = 'DELETE FROM flight where FlightID = :flight_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':flight_id', $flight_id);
        $statement->execute();
        $statement->closeCursor();
    }

    function add_flight($companyID,$origin,$destination){
        global $db;
        $query = 'INSERT INTO flight (companyID,Origin,Destination) VALUES (:companyID,:origin,:destination)';
        $statement = $db->prepare($query);
        $statement->bindValue(':companyID',$companyID);
        $statement->bindValue(':origin', $origin);
        $statement->bindValue(':destination', $destination);
        $statement->execute();
        $statement->closeCursor();
    }
