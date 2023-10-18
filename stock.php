<html>
<link rel="stylesheet" href="./css/style.css">
<?php
    @$dwes = new mysqli('localhost', 'dwes', 'dwes', 'dwes');
    if ($dwes->connect_errno != null) {
        echo 'Error conectando a la base de datos: ';
        echo $dwes->connect_error;
        exit();
    }

    $query = "SELECT * FROM stock WHERE producto='".$_GET['cod']."'";
    $stock = $dwes->query($query, MYSQLI_STORE_RESULT);
    if($stock->num_rows < 0){
        echo 'Ninguna tienda tiene ese producto.';
    }else{
        echo '<h1>Tiendas con el producto: '.$_GET['cod'].' </h1><br><br>';
        echo '<table><tr>
                <th>Código</th>
                <th>Nombre</th>
                <th>Teléfono</th>
                <th>Stock</th>
                </tr>';
        while($infoStock = $stock->fetch_row()){
            $query2 = "SELECT * FROM tienda WHERE cod=".$infoStock[1];
            $tienda = $dwes->query($query2, MYSQLI_STORE_RESULT);
            if($tienda->num_rows > 0){
                $infoTienda = $tienda->fetch_row();
                echo "<tr><td>".$infoTienda[0]."</td>
                <td>".$infoTienda[1]."</td>
                <td>".$infoTienda[2]."</td>
                <td>".$infoStock[2]."</td>";
            }
        }
    }

    $dwes->close();
?>
</html>

