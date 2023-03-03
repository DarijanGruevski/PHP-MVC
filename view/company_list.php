<?php include('header.php') ?>
<?php //$companies=array(); ?>

<?php if($companies) { ?>
<section id="list" class="list">
<header class="list_row list_header">
    <h1>Company List</h1>
</header>

<?php foreach ($companies as $company) : ?>
    <div class="list_row"> 
        <div class="list_item">
            <p class="bold"><?=$company['Name'] ?> </p>
        </div>
        <div class="list_removeItem">
        <form action="." method="post">
       <input type="hidden" name="action" value="delete_company">
       <input type="hidden" name="companyID" value ="<?=$company['ID'] ?>">
       <button class="remove-button">❌</button>     
</form>
    </div>
</div>
<?php endforeach ?>
</section>
<?php } else { ?>
<p> No companies exist yet.
<?php } ?>

<section id="add" class="add">
    <h2> Add Company </h2>
    <form action="." method="post" id="add_form" class="add_form">
        <input type="hidden" name="action" value="add_company">
        <div class="add_inputs">
            <label>Name: </label>
            <input type="text" name="company_name" maxlength="50" placeholder="Name"
            autofocus required>
            <label>Country: </label>
            <input type="text" name="country" maxlength="50" placeholder="Country" required>
        </div>
            <div class="add_addItem">
                <button class="add-button bold">Add</button>
        </div>
    </form>
</section>
<br>
<p><a href=".">View &amp; Add Flights</a></p>
<?php include('footer.php') ?>