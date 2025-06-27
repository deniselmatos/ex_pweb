<?php 

require_once('conexao.php');

$sql = "SELECT * FROM produtos";
$result = mysqli_query($conexao, $sql);

if(!$result)
    die("Erro na consulta: " . mysqli_error($conexao));

$total_compra = 0;
$itens_com_desconto = 0;

echo "<!DOCTYPE html>
<html lang='pt-br'>
<head>
    <meta charset='UTF-8'>
    <title>Carrinho de Compras</title>
    <link rel='stylesheet' href='style.css'>
</head>
<body>
    <h1>Carrinho de Compras</h1>
    <table>
        <tr>
            <th>Item</th>
            <th>Quantidade</th>
            <th>Preço Unitário (R$)</th>
            <th>Subtotal (R$)</th>
            <th>Desconto</th>
        </tr>";

while($produto = mysqli_fetch_assoc($result)){
    $subtotal = $produto["quantidade"] * $produto["preco_unitario"];
    $desconto_aplicado = "Não";

    if ($produto["quantidade"] > 1 && $produto["preco_unitario"] > 50){
        $subtotal *= 0.90;
        $itens_com_desconto++;
        $desconto_aplicado = "10%";
    }

    $total_compra += $subtotal;

    echo "<tr>
            <td>{$produto['item']}</td>
            <td>{$produto['quantidade']}</td>
            <td>" . number_format($produto['preco_unitario'], 2, ",", ".") . "</td>
            <td>" . number_format($subtotal, 2, ",", ".") . "</td>
            <td>$desconto_aplicado</td>
         </tr>";
}

if ($itens_com_desconto >= 2){
    $total_compra *= 0.95;
    echo "<tr>
            <td colspan='5'; text-align:center;'>Desconto de 5% aplicado ao total</td>
          </tr>";
}

echo "  <tr>
            <td colspan='5' style='text-align:right; font-weight: bold;'>Total da compra: R$ " . number_format($total_compra, 2, ",", ".") . "</td>
        </tr>
    </table>
</body>
</html>";

?>