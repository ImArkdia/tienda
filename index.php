<html>
<link rel="stylesheet" href="./css/style.css">

<?php
    @$dwes = new mysqli('localhost', 'dwes', 'dwes', 'dwes');
    if ($dwes->connect_errno != null) {
        echo 'Error conectando a la base de datos: ';
        echo $dwes->connect_error;
        exit();
    }
    $actualizado = "";

    if(isset($_GET['actualizado'])){
        $actualizado = 'Se ha actualizado el stock correctamente.';
    }

    $query = "SELECT * FROM producto";
    $resultado = $dwes->query($query, MYSQLI_USE_RESULT);
    if($resultado->num_rows < 0){
        echo 'No hay productos almacenados.';
    }else{
        echo '<h1>Listado de productos</h1><br><br>
            '.$actualizado.'<br><br>';
        echo '<table><tr>
                <th>Código</th>
                <th>Nombre</th>
                <th>PVP</th>
                <th>Família</th>
                <th>Tiendas</th>
                </tr>';
        while($productos = $resultado->fetch_row()){
            echo "<tr><td>".$productos[0]."</td>
                <td>".$productos[2]."</td>
                <td>".$productos[4]."€</td>
                <td>".$productos[5]."</td>
                <td><div><a href='stock.php?cod=".$productos[0]."'>
                <img src='./imgs/tienda.jpg'></div></td></tr>";
        }
    }

    $dwes->close();
?>


</html>

