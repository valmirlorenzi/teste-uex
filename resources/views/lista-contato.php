<?php
    $i = 0;
    foreach($contatos as $contato) {
?>
        <div style="cursor: pointer; background-color:<?=$i % 2 == 0 ? '#ffffff': '#dddddd'?>" onclick="mostrarContato(<?= $contato["id"]?>);">
            <div style="font-size:1.2em; font-weight: bold;"><?=$contato["nome"] . " - " . $contato["id"]?></div>
            <div style="font-size:0.9em;">CPF: <?=$contato["cpf"]?></div>
            <div style="font-size:0.8em;">Telefone: <?=$contato["telefone"]?></div>
            <div style="font-size:0.8em;"><?=$contato["endereco"] . ", " . $contato["numero"] . ($contato["complemento"] != "" ? " - " . $contato["complemento"] : "")?></div>
            <div style="font-size:0.8em;"><?=$contato["cep"] . " - " . $contato["nome_bairro"] ?></div>
            <div style="font-size:0.8em;"><?=$contato["nome_cidade"] . " - " . $contato["uf"] ?></div>
            <div style="font-size:0.8em;"><?=$contato["lat_long"]?></div>
<?php
        if($tipo == "lista") {
?>    
              <div><a style="color:blue;font-size:1.1em" href="javascript:editarContato(<?=$contato["id"]?>)">Editar</a></div>
              <div><a style="color:red;" href="javascript:excluirContato(<?=$contato["id"]?>, '<?=$contato["nome"]?>')">Excluir</a></div>
<?php
        }
?>        
            <script>marcas.push({latlng: '<?=$contato["lat_long"]?>', descr: '<?=$contato["nome"] . " - " . $contato["endereco"] . ", " . $contato["numero"] . " - " . $contato["nome_bairro"]?>' });</script>
        </div>
<?php
        $i++;
    }
?>    