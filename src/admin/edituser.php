<style>
    .switch {
        position: relative;
        display: inline-block;
        width: 55px;
        height: 28px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 20px;
        width: 20px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked+.slider {
        background-color: #2196F3;
    }

    input:focus+.slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked+.slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }
</style>

<!-- <form class="form-horizontal" action="" method="post">
                    <div class="card">
						<div class="card-header">
							<h3 class="card-title">Edit User</h3>
						</div>
				        <div class="card-body">
                               <div class="form-group">
											<label class="control-label">Username: </label>
											<div class="col-sm-12">
												<input type="text" name="username" class="form-control" value="<?php
                                                                                                                echo $row['username'];
                                                                                                                ?>" required>
											</div>
										</div>
                                        <hr>
                                        <div class="form-group">
											<label class="control-label">New Password: </label>
											<div class="col-sm-12">
												<input type="text" name="password" class="form-control">
											</div>
										</div>
                                        <i>Fill this field only if you want to change the password.</i>
                        </div>
                        <div class="card-footer">
							<button class="btn btn-flat btn-success" name="edit" type="submit">Save</button>
							<button type="reset" class="btn btn-flat btn-default">Reset</button>
				        </div>
				     </div>
</form>
<!-- <?php
        if (isset($_POST['edit'])) {
            $table    = $prefix . 'users';
            @$username = addslashes($_POST['username']);
            @$password = $_POST['password'];

            $query = $mysqli->query("UPDATE `$table` SET username='$username' WHERE id='$id'");
            if ($password != null) {
                $password = hash('sha256', $_POST['password']);
                $query = $mysqli->query("UPDATE `$table` SET username='$username', password='$password' WHERE id='$id'");
            }
            echo '<meta http-equiv="refresh" content="0;url=users.php">';
        }

        ?> -->
<script>
    function show(elementId,buttonId) {
        // var htmlS
        document.getElementById(elementId).style.display = "block";
        var button = document.getElementById(buttonId); // Assumes element with id='button'

        button.onclick = function() {
            var elementToShow = document.getElementById(elementId);
            if (elementToShow.style.display !== 'none') {
                elementToShow.style.display = 'none';
            } else {
                elementToShow.style.display = 'block';
            }
        };
    }

    function showPass() {
        // var htmlS
        document.getElementById("passwordEditId").style.display = "block";
    }
</script>
<table id="tblEditUser">
    <tr>
        <td><label> Change Username </label></td>
        <td>

            <label class="switch">
                <input id="isCheckedUsernameChangeBtn" type="checkbox" onclick="show('usernameEditId',this.id); <?php $_SESSION['on'] = 'on' ?>">
                <span class="slider round"></span>
            </label>

        </td>


    </tr>

    <tr id="usernameEditId" style="display:none">
        <td><label>Username: </label></td>
        <td>
            <!-- <input type="text" name="username" class="form-control" required> -->
            <input type="text" name="username" placeholder="" class="" value="username">
        </td>

    </tr>

    <tr>
        <td><label> Change Password </label></td>
        <td>

            <label class="switch">
                <input id="isCheckedPasswordchangeBtn" type="checkbox" onclick="show('passwordEditId',this.id);">
                <span class="slider round"></span>
            </label>

        </td>


    </tr>

    <tr id="passwordEditId" style="display:none">
        <td><label>Password* </label></td>
        <td>
            <!-- <input type="text" name="username" class="form-control" required> -->
            <input type="password" name="username" placeholder="" class="">
        </td>

        <td><label>Password Confirmation* </label></td>
        <td>
            <!-- <input type="text" name="username" class="form-control" required> -->
            <input type="password" name="username" placeholder="" class="">
        </td>

    </tr>
    <td>
        <label>User type:</label>
        <input class="input-usertype" type="radio" id="admin" name="usertype" value="admin">
        <label class="label-usertype" for="admin">Admin</label>
        <input class="input-usertype" type="radio" id="user" name="usertype" value="user">
        <label class="label-usertype" for="user">User</label><br>
    </td>
</table>

