<style>
    .form_delete {
        display: inline-block;
        width: 400px;
        height: 50px !important;
        position: absolute;
        z-index: 9;
        left: 30%;
        text-align: center;
        vertical-align: middle;
        padding-top: 200px;


    }
</style>

<?php

if (isset($_POST['confirm'])) {
    if ($_POST['confirm'] == 'Yes') {
        echo $_SESSION['id-to-delete'];
        $id  = $_SESSION['id-to-delete'];
        $query = $connection->query("DELETE FROM `Users` WHERE id='$id'");
        header("Location: users.php");
    } else if ($_POST['confirm'] == 'No') {
        header("Location: users.php");
    }
}
?> <div>
    <form method="post">
        <div class='form_delete'>
            <div style="background-color: white; border:black 2px solid; height:100px;">
                <p style="color: black;"> Are you sure you want to delete this user? </p>

                <input type="submit" name="confirm" value="Yes">
                <input type="submit" name="confirm" value="No">
            </div>
        </div>
    </form>
</div>