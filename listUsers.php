<?php
require 'inc/header.php';
require 'inc/sidebar.php';
require 'inc/functions.php';


denyAccess();
?>


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Add new users
           
        </h1>
        <!--ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Add Users</a></li>
            <li class="active">Teachers and Parents</li>
        </ol-->
    </section>

    <!-- Main content -->
    <section class="content">
        <section class="content">
            <div class="row">

                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">List Users</h3>
                        
                        <h3 class="text-danger pull-right box-title">Do NOT revoke access for yourself. The sky would fall on your head!</h3>

                        <!--div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                        </div-->
                    </div>



                    <table class="table table-striped table-responsive table-condensed">
                        <tr>
                            <th style="">#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Access Level</th>
                            <th>Gender</th>
                            <th style="">Action</th>
                            <th>Access Status</th>
                        </tr>

                        <?php
                        if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
				$startFrom = ($page-1) * 20;
                        
                        
                        
                        $fetchUsers = "SELECT * FROM users ORDER BY id DESC LIMIT $startFrom, 20";
                        $queryUsers = mysqli_query($conString, $fetchUsers);
                        if (mysqli_num_rows($queryUsers) > 0) {
                            while ($userData = mysqli_fetch_array($queryUsers)) {
                                if ($userData['access'] == 0) {
                                    $access = "Access revoked";
                                }
                                if ($userData['access'] == 1) {
                                    $access = "Has access";
                                }

                                if ($userData['priv'] == 1) {
                                    $priv = "Parent";
                                }
                                if ($userData['priv'] == 2) {
                                    $priv = "Teacher";
                                }
                                if ($userData['priv'] == 3) {
                                    $priv = "Admin";
                                }





                                echo "<tr>";
                                echo "<td>" . $userData['id'] . "</td>";
                                echo "<td>" . $userData['fname'] . " " . $userData['sname'] . "</td>";
                                echo "<td>" . $userData['email'] . "</td>";
                                echo "<td>" . $userData['phonenum'] . "</td>";
                                echo "<td>" . $priv . "</td>";
                                echo "<td>" . $userData['gender'] . "</td>";
                                echo "<td>" . $access . "</td>";
                                echo "<td><a href='process/suspendUser.php?id=" . $userData['id'] . "'><button class='btn bg-maroon'>(Un)Suspend </button></td>";
                            }
                        } else {
                            echo "<h3 class='box-title'>Couldn't fetch any results.</h3>";
                        }
                        ?>


                    </table>              
  <?php
                                   $fetchUsers = "SELECT COUNT(id) FROM users LIMIT 0, 20";
                                   $queryUsers = mysqli_query($conString, $fetchUsers);
                                    $userCountRows = mysqli_fetch_row($queryUsers);
                                    $totalRecords = $userCountRows[0];
                                    $totalPages = ceil($totalRecords / 20);
                                    echo '<ul class="pagination pull-right">';
                                    for ($i = 1; $i <= $totalPages; $i++) {
                                        echo "<li class='paginate_button'><a href='listUsers.php?page=" . $i . "' >" . $i . "</a> </li>";
                                    };
                                       echo "</ul>";


                                    if ($_SERVER['PHP_SELF'] = $totalPages) {
                                        echo "<a href='listUsers.php?page=$totalPages'></a> "; // Goto last page
                                    } else {
                                        //echo "LAST";
                                    }
                                    ?>






                    <div class="box-footer">

                    </div>
                </div>
            </div>

        </section>
</div>

<?php
require 'inc/footer.php';
?>