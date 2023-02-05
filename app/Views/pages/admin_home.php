<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Dashboard</title>
        <link rel="stylesheet" href= "<?php echo base_url("/public/css/main.css") ?>">
        <link rel="stylesheet" href= "<?php echo base_url("/public/css/datatable.min.css") ?>">

    </head>
    <body data-Base_url="<?php echo base_url() ?>">

        <h1 id="the_id" data-original-title="<?php echo base_url() ?>">Admin Dashboard</h1>

        <div style="width:100%">
            <table id="myTable" class="display stripe hover row-border order-column" >
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>Name</th>
                        <th>email</th>
                        <th>Address</th>
                        <th>Mobile Number</th>
                        <th>Joined Date</th>
                    </tr>
                </thead>
                <tfoot>
                </tfoot>
            </table>
        </div>

        <script src="<?php echo base_url('/public/js/vendor/jquery.min.js') ?>"></script>
        <script src="<?php echo base_url('/public/js/vendor/datatable.min.js') ?>"></script>

    </body>
    <script src="<?php echo base_url('/public/js/main.js') ?>"></script>

</html>
