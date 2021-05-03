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
        /* background-color: white; */
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }

    #editUserDiv {
        position: absolute;
        z-index: 9;
        left: 40%;
        text-align: center;
        vertical-align: middle;
    }

    .card {
        padding: 10px;
        cursor: move;
        z-index: 10;
        /* background-color: #2196F3; */
        /* color: #fff; */
    }

    #wrapper {
        filter: blur(8px);
        -webkit-filter: blur(8px);
    }

    label {
        top: -0.3em;
    }

    * {
        box-sizing: border-box;
    }

    #passwordEditId,
    #usernameEditId {
        display: none;
    }
</style>

<?php


// include("form-events/edituser-func.php");
function console_log($data)
{
    echo '<script>';
    echo 'console.log(' . json_encode($data) . ')';
    echo '</script>';
}

if (isset($_POST['save-edit'])) {
    console_log("here");
    // echo "sd";
}
if (isset($_GET['cancel'])) {
    exit;
}
?>


<div id="editUserDiv" class="col-md-3" style="padding-top: 3.8em;">
    <div class="card">
        <div class="card-header" id="editUserDivHeader">
            <h3 class="card-title">Edit User</h3>
        </div>
        <div class="card-body">
            <form class="form-horizontal" action="form-events/edituser-func.php" method="post">
             <?php echo display_error(); ?>
                <div class="form-group">
              
                    <!-- <label class="control-label">Username: </label> -->
                    <div class="col-sm-12">
                        <!-- <input type="text" name="username" class="form-control" required> -->
                        <label> Change Username </label>


                        <label class="switch">
                            <input id="isCheckedUsernameChangeBtn" type="checkbox" onclick="show('usernameEditId',this.id); ">
                            <span class="slider round"></span>
                        </label>

                    </div>
                    <div id="usernameEditId">
                        <td><label>Username: </label></td>
                        <td>
                            <!-- <input type="text" name="username" class="form-control" required> -->
                            <input type="text" name="username-update" value=" <?php echo $_SESSION['username-to-edit'] ?>">

                        </td>

                    </div>
                </div>

                <div class="form-group">
                    <!-- <label class="control-label">Username: </label> -->
                    <div class="col-sm-12">
                        <label> Change Password </label>


                        <label class="switch">
                            <input id="isCheckedPasswordchangeBtn" type="checkbox" onclick="show('passwordEditId',this.id);">
                            <span class="slider round"></span>
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <!-- <label class="control-label">Email: </label> -->
                    <div class="col-sm-12">
                        <!-- <input type="email" name="email" class="form-control" required> -->
                        <div id="passwordEditId">

                            <label>Password* </label>

                            <!-- <input type="text" name="username" class="form-control" required> -->
                            <input type="password" name="password1">



                            <label>Password Confirmation* </label>

                            <!-- <input type="text" name="username" class="form-control" required> -->
                            <input type="password" name="password2" placeholder="">


                        </div>
                    </div>
                </div>
                <label class="">user type</label>
                <input class="" type="radio" id="admin" name="usertype" value="admin" <?php echo ($_SESSION['type-to-edit'] == 'admin') ?  "checked" : "";  ?>>
                <label class="" for="admin">Admin</label>
                <input class="" type="radio" id="user" name="usertype" value="user" <?php echo ($_SESSION['type-to-edit'] == 'user') ?  "checked" : "";  ?>>
                <label class="" for="user">User</label><br>
                <input type="hidden" name="save-edit" value="true">
                <a href="?cancel" class="btn btn-success pull-right btn-danger" title="cancel"><i class="fas"></i> Cancel</a>
                <input type="submit" value="save" class="btn btn-success pull-right">
            </form>
        </div>
        <div class="card-footer panel-heading">
          

            <!-- <a >Save</a> -->
        </div>
        <!-- <div class="card-footer">
            <button class="btn btn-flat btn-primary" name="add_user" type="submit">Add</button>
            <button type="reset" class="btn btn-flat btn-default">Reset</button>
        </div> -->
    </div>


</div>


<script>
    document.getElementById("isCheckedUsernameChangeBtn").checked = false;

    function show(elementId, buttonId) {
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

    dragElement(document.getElementById("editUserDiv"));

    function dragElement(elmnt) {
        var pos1 = 0,
            pos2 = 0,
            pos3 = 0,
            pos4 = 0;
        if (document.getElementById(elmnt.id + "Header")) {
            // if present, the header is where you move the DIV from:
            document.getElementById(elmnt.id + "Header").onmousedown = dragMouseDown;
        } else {
            // otherwise, move the DIV from anywhere inside the DIV:
            elmnt.onmousedown = dragMouseDown;
        }

        function dragMouseDown(e) {
            e = e || window.event;
            e.preventDefault();
            // get the mouse cursor position at startup:
            pos3 = e.clientX;
            pos4 = e.clientY;
            document.onmouseup = closeDragElement;
            // call a function whenever the cursor moves:
            document.onmousemove = elementDrag;
        }

        function elementDrag(e) {
            e = e || window.event;
            e.preventDefault();
            // calculate the new cursor position:
            pos1 = pos3 - e.clientX;
            pos2 = pos4 - e.clientY;
            pos3 = e.clientX;
            pos4 = e.clientY;
            // set the element's new position:
            elmnt.style.top = (elmnt.offsetTop - pos2) + "px";
            elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";
        }

        function closeDragElement() {
            // stop moving when mouse button is released:
            document.onmouseup = null;
            document.onmousemove = null;
        }
    }
</script>