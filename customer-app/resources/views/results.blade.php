<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Street Group CSV Test </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5 text-center">
    <table>
    <tr>
    <th>Title</th><th>First Name</th><th>Initial</th><th>Last Name</th>
    
    <?php foreach($results as $result){ ?>
        <tr>
            <td><?php echo $result['title'] ?></td> 
            <td><?php echo $result['first_name'] ?></td>
            <td><?php echo $result['initial'] ?></td>
            <td><?php echo $result['last_name'] ?></td>
            </tr>
    <?php } ?>
    </table>
    </div>
</body>

</html>