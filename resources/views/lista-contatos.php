<?php
    $i = 0;
    foreach($contatos as $contato) {
?>
                <div style="background-color:<?=$i % 2 == 0 ? '#ffffff': '#dddddd'?>">
                    <div style="font-size:1.2em; font-weight: bold;"><?=$contato["nome"] . " - " . $contato["id"]?></div>
                    <div style="font-size:0.9em;">CPF: <?=$contato["cpf"]?></div>
                    <div style="font-size:0.8em;">Telefone: <?=$contato["telefone"]?></div>
                    <div style="font-size:0.8em;"><?=$contato["endereco"] . ", " . $contato["numero"] . ($contato["complemento"] != "" ? " - " . $contato["complemento"] : "")?></div>
                    <div style="font-size:0.8em;"><?=$contato["cep"] . " - " . $contato["nome_bairro"] ?></div>
                    <div style="font-size:0.8em;"><?=$contato["nome_cidade"] . " - " . $contato["uf"] ?></div>
                    <div style="font-size:0.8em;"><?=$contato["lat_long"]?></div>
                    <script>marcas.push('<?=$contato["lat_long"]?>');</script>
                </div>

<?php
        $i++;
    }
?>    
