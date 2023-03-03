<?php 

function get_companies(){
    global $db;
    $query = 'SELECT * FROM company ORDER BY ID';
    $statement = $db ->prepare($query);
    $statement->execute();
    $companies = $statement->fetchAll();
    $statement->closeCursor();
    return $companies;
}

function get_company_name($companyID){
    global $db;
    if(!$companyID){
        return "All Companies";
    }
    $query = 'SELECT * FROM company WHERE ID = :companyId';
    $statement = $db ->prepare($query);
    $statement ->bindValue(':companyId',$companyID);
    $statement->execute();
    $company = $statement->fetch();
    $statement->closeCursor();
    $company_name = $company['Name'];
    return $company_name;
}

    function delete_company($companyID){
        global $db;
        $query = 'DELETE FROM company WHERE ID = :companyId';
        $statement = $db ->prepare($query);
        $statement->bindValue(':companyId', $companyID);
        $statement->execute();
        $statement->closeCursor();
    }

    function add_company($company_name, $country){
        global $db;
        $query = 'INSERT INTO company (Name,Country) VALUES (:company_name,:country)';
        $statement = $db ->prepare($query);
        $statement->bindValue(':company_name', $company_name);
        $statement->bindValue(':country', $country);
        $statement->execute();
        $statement->closeCursor();
    }
    ?>