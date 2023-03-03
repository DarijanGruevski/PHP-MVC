<?php include('header.php')?>


<section id="list" class="list">

<header class="list__row list_header">
    <h1>Flights</h1>
    <form action="." method="get" id="list_header_select" class="list_header_select">
        <input type="hidden" name="action" value="list_flights">
        <select name="companyID" required> 
            <option value="0">View All</option>
            <?php foreach ($companies as $company) : ?>
                <?php if($companyID == $company['ID']) { ?>
                    <option value="<?= $company['ID'] ?>" selected>
              
                    <?php } else {   ?>
                <option value="<?= $company['ID'] ?>" >
                    <?php } ?>
                <?= $company['Name'] ?>
                </option>
                <?php endforeach; ?>
        </select>
        <button class="add_button">Go</button>
    </form>
</header>
<?php // $flights=array() ?>
<?php //$companyID = 1?>
 <?php if($flights) { ?>
<?php foreach($flights as $flight) : ?>
    <div class="list_row">
        <div class="list_item">
            <p class="bold"> <?=$flight['Name'] ?></p>
            <p><?= $flight['Origin'] ?></p>
            <p><?=$flight['Destination'] ?></p>
        </div>
        <div class="list_removeItem" >
<form action="." method="post">
<input type="hidden" name="action" value="delete_flight">
<input type="hidden" name="flight_id" value="<?=$flight['FlightID'] ?>">
<button class="remove-button">❌</button>
</form>
</div>
    </div>
    <?php endforeach; ?>
    <?php } else{ ?>
    <br>
    <?php if($companyID){ ?>
    <p> No flights exist for this company yet. </p>
    <?php } else { ?>
        <p> No flights exist </p>
        <?php } ?>
        <br>
        <?php } ?>
</section>

<section id="add" class="add">
        <h2> Add Flight </h2>
        <form action="." method="post" id="add_form" class="add_form">
            <input type="hidden" name="action" value="add_flight">
            <div class="add_inputs">
                <label> Company: </label>
                <select name="companyID" required>
                <option value="">Please select</option>
                <?php foreach($companies as $company) : ?>    
                    <option value="<?= $company['ID']; ?>">
            <?= $company['Name']; ?>
                    </option>
                    <?php endforeach; ?>
            </select>
            <label> Origin: </label>
            <input type="text" name="origin" maxlength="50" placeholder="Origin" required>
            <label> Destination: </label>
            <input type="text" name="destination" maxlength="50" placeholder="Destination" required>    
        </div>
            <div class="add_addItem" >
                <button class="add-button bold">Add</button>
            </div>
                </form>
</section>
<p><a href=".?action=list_companies">View/Edit Companies </a></p>
<?php include('footer.php'); ?>