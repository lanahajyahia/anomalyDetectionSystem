<!-- <div id="">
    <table id="tblEditUser">
        <tr>
            <td><label> Change Username </label></td>
            <td>

                <label class="switch">
                    <input id="isCheckedUsernameChangeBtn" type="checkbox" onclick="show('usernameEditId',this.id); ">
                    <span class="slider round"></span>
                </label>

            </td>


        </tr>

        <tr id="usernameEditId" style="display:none">
            <td><label>Username: </label></td>
            <td>
                <!-- <input type="text" name="username" class="form-control" required> -->
                <input type="text" name="username" placeholder="" class="" value=" <?php echo $_SESSION['username-to-edit'] ?>">
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

        <tr id="passwordEditId" style="display:none !important">

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
        <tr>
            <td> <label>User type:</label>
                <input class="input-usertype" type="radio" id="admin" name="usertype" value="admin">
                <label class="label-usertype" for="admin">Admin</label>
                <input class="input-usertype" type="radio" id="user" name="usertype" value="user">
                <label class="label-usertype" for="user">User</label><br>
            </td>
        </tr>

        <td>
            <div class="panel-heading">
                <a href="?cancel" class="btn btn-success pull-right btn-danger" title="cancel"><i class="fas fa-trash"></i> Cancel</a>

                <a href="?save-edit" class="btn btn-success pull-right">Save</a>
            </div>
        </td>
    </table>
</div> -->