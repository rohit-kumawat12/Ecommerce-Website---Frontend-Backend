<?php
    require('top.inc.php');

    $sql = "SELECT * FROM categories  WHERE deleted='NO' order by categories DESC";
    $res = mysqli_query($con,$sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    <title>Document</title>
</head>
<body>


<table id="table_id" class="display">
    <thead>
        <tr>
            <th>SR.</th>
            <th>Id</th>
            <th>CATEGORY</th>
            <th>STATUS</th>
        </tr>
    </thead>
    <tbody>
    <?php
    $i=1;
while($row=mysqli_fetch_assoc($res)) {?>
        <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['categories']; ?></td>
            <td><?php echo $row['status']; ?></td>
        </tr>
<?php } ?>
    </tbody>
</table>

<script>
    $(document).ready( function () {
    $('#table_id').DataTable();
} );
</script>
</body>
</html>