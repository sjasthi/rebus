<?PHP
require('session_validation.php');
include('admin_manage_users_helper.php')
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="styles/main_style.css" type="text/css">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="styles/custom_nav.css" type="text/css">
        <title>Rebus Users</title>
    </head>
    <body>
    <?PHP echo getTopNav(); ?>

    <div id="wrap">

    <div class="container">
    <a href='create_user.php'><button style="height: 50px; width: 100px;;">Create User</button></a>

        <h3>User List</h3>

        <div>
        Toggle column: 
        <a class="toggle-vis" data-column="0">First Name</a> - 
        <a class="toggle-vis" data-column="1">Last Name</a> - 
        <a class="toggle-vis" data-column="2">Username</a> - 
        <a class="toggle-vis" data-column="3">Email</a> - 
        <a class="toggle-vis" data-column="4">ID Verified</a> - 
        <a class="toggle-vis" data-column="5">Activation Token</a> -
        <a class="toggle-vis" data-column="6">Date Created</a> - 
        <a class="toggle-vis" data-column="7">Last Login</a> 
        </div>


        <table id="usersTable" cellpadding="0" cellspacing="0" border="0" class="datatable table table-striped table-bordered"
               width="100%">

            <thead>

            <tr>

                <th>First Name</th>

                <th>Last Name</th>

                <th>Username</th>

                <th>Email</th>

                <th>ID Verified</th>

                <th>Activation Token</th>

                <th>Date Created</th>

                <th>Last Login</th>


            </tr>

            </thead>

            <tbody>


            <?php

            require_once('db_configuration.php');


            $sql = "SELECT * FROM users";

            $result = run_sql($sql);


            if ($result->num_rows > 0) {

                // output data of each

                while ($row = $result->fetch_assoc()) {

                    $first_name = $row["first_name"];
                    $last_name = $row["last_name"];
                    $username = $row["username"];
                    $email = $row["user_email"];
                    $ID_verification = $row["id_verified"];
                    $activation_token = $row["activation_token"];
                    $date_created = $row["date_created"];
                    $last_login = $row["last_login"];

                    $_SESSION['role'] = "Admin";
                    if(isset($_SESSION['role'])) {
?>
                <tr>
                    <td><div contenteditable="true" onBlur="updateValue(this,'first_name','<?php echo $email; ?>')"><?php echo $first_name; ?></td>
                    <td><div contenteditable="true" onBlur="updateValue(this,'last_name','<?php echo $email; ?>')"><?php echo $last_name; ?></div></span> </td>
                    <td><div contenteditable="true" onBlur="updateValue(this,'username','<?php echo $email; ?>')"><?php echo $username; ?></div></span> </td>
                    <td><div contenteditable="true" onBlur="updateValue(this,'user_email','<?php echo $email; ?>')"><?php echo $email; ?></div></span> </td>
                    <td><div contenteditable="true" onBlur="updateValue(this,'id_verified','<?php echo $email; ?>')"><?php echo $ID_verification; ?></div></span> </td>
                    <td><div contenteditable="true" onBlur="updateValue(this,'activation_token','<?php echo $email; ?>')"><?php echo $activation_token; ?></div></span> </td>
                    <td><div><?php echo $date_created; ?></div></span> </td>
                    <td><div><?php echo $last_login; ?></div></span> </td>
                </tr>
                 <?php  
                    }else{ 
                    echo '<tr>
                        <td>' . $row["first_name"] . "</td>
                
                        <td>" . $row["last_name"] . "</td>
                
                        <td>" . $row["username"] . "</td>
                
                        <td>" . $row["user_email"] . "</td>
                        
                        <td>" . $row["Id_verified"] . "</td>
                        <td>" . $row["activation_token"] . "</td>
                        <td>" . $row["date_created"] . "</td>
                        <td>" . $row["last_login"] . "</td>
                        
                        </tr>";
                }
            }
            } else {
                echo "0 results";
            }

            $result->close();

            // *** delete button functionality ***
            if (isset($_GET['user_email'])) {
                if ($_GET['button'] == 'delete') {
                    $email = $_GET['user_email'];

                    $sql = 'DELETE FROM users WHERE user_email=' . $email . ';';
                    $result = $db->query($sql);

                    echo ' <script> alert(\'Record has been successfully deleted!!\'); window.location.replace("admin_manage_users.php"); </script>';
                }
            }

            ?>

            </tbody>

            <tfoot>

            <tr>

            <th>First Name</th>

            <th>Last Name</th>

            <th>Username</th>

            <th>Email</th>

            <th>ID Verified</th>

            <th>Activation Token</th>

            <th>Date Created</th>

            <th>Last Login</th>

            </tr>

            </tfoot>

        </table>

    </div>

</div>

<!--JQuery-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 

<script type="text/javascript" charset="utf8"
        src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

<!--Data Table-->
<script type="text/javascript" charset="utf8"
        src="https://editor.datatables.net/extensions/Editor/js/dataTables.editor.min.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/fixedheader/3.1.5/js/dataTables.fixedHeader.min.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>


    <script type="text/javascript" language="javascript">
    $(document).ready( function () {
        
        $('#usersTable').DataTable( {
            dom: 'lBfrtip',
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
            paging: true,
            pagingType: "full_numbers",
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
            ] }
        );

        $('#usersTable thead tr').clone(true).appendTo( '#usersTable thead' );
        $('#usersTable thead tr:eq(1) th').each( function (i) {
            var title = $(this).text();
            $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    
            $( 'input', this ).on( 'keyup change', function () {
                if ( table.column(i).search() !== this.value ) {
                    table
                        .column(i)
                        .search( this.value )
                        .draw();
                }
            } );
        } );
    
        var table = $('#usersTable').DataTable( {
            orderCellsTop: true,
            fixedHeader: true,
            retrieve: true
        } );
        
    } );

    $(document).ready(function() {
        
    var table = $('#usersTable').DataTable( {
        retrieve: true,
        "scrollY": "200px",
        "paging": false
    } );
 
    $('a.toggle-vis').on( 'click', function (e) {
        e.preventDefault();
 
        // Get the column API object
        var column = table.column( $(this).attr('data-column') );
 
        // Toggle the visibility
        column.visible( ! column.visible() );
    } );
} );

function updateValue(element,column,id){
        var value = element.innerText
        $.ajax({
            url:'editable_list.php',
            type: 'post',
            data:{
                value: value,
                column: column,
                id: id
            },
            success:function(php_result){
				console.log(php_result);
				
            }
            
        })
    }
</script>

    </body>
</html>
