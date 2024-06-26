<style>
    #form-contato {background-color: #ffffdd;}
    #form-contato input, #form-contato select {
        width:100%;
        margin-bottom: 15px;
    }
    .erro { border-color: red; }
    .botao { border: solid 1px cornflowerblue }
</style>
<x-app-layout>
    <script>
        var marcas = []; // para armazenas as coordenadas dos contatos cadastrados
    </script>
    
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Contatos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Bem-vindo, " . Auth::user()->name . "! Veja e edite seus contatos.") }}
                </div>
            </div>
        </div>
    </div>
    <div style="display:flex;">
        <div id="lista-contatos" class="bg-white" style="width:40%;">
            @php
                $tipo = "lista";
                require('../resources/views/lista-contato.php');
            @endphp
        </div>
        <div class="bg-gray" style="width:55%;" >
            <h1 style="font-size:1.3em;font-weight: bold;">Edite o contato aqui. Para incluir um novo, clique em 'limpar' e informe os dados.</h1>
            <form id="form-contato" onsubmit="return validarESalvarDadosContato();">
                <input type='hidden' id="id_contato" value=''/>
                <input type='hidden' id="id_usuario" name="id_usuario" value='{{Auth::User()->id}}'/>

                <label for="nome">Nome</label>
                <input type="text" id="nome_contato" required="required" name="nome_contato" />

                <label for="fone">CPF</label>
                <input type="text" id="cpf_contato" name="cpf_contato" required="required" />

                <label for="fone">Telefone</label>
                <input type="text" id="telefone_contato" name="telefone_contato" required="required" />

                <label for="cep">CEP</label>
                <input style="width:90%;" type="text" id="cep_contato" name="cep_contato" required="required" />
                <a href="javascript:void(null)" style="width:10%;" onclick="buscarCep()">Buscar</a>

                <label for="endereco">Endereço</label>
                <input type="text" id="endereco_contato" name="endereco_contato" required="required" />

                <label for="numero">Número</label>
                <input type="text" id="numero_contato" name="numero_contato" required="required" />

                <label for="numero">Complemento</label>
                <input type="text" id="complemento_contato" name="complemento_contato"  />
                
                <label for="uf">UF</label>
                <select id="uf_contato" name="uf_contato" required="required" ></select>

                <label for="cidade">Cidade</label>
                <input type="text" id="cidade_contato" name="cidade_contato" required="required" onkeydown="sugerirCidades(event)"/>
                <ul style="display:none;" id="lista-cidades-contato"></ul>

                <label for="bairro">Bairro</label>
                <input type="text" id="bairro_contato" name="bairro_contato" />
                
                <label for="latlant">Coordenadas</label>
                <input type="text" id="latlong_contato" name="latlong_contato" required="required" />
                
                <input class="botao" type="submit" class="salvar" value="Salvar" />
                <input class="botao" type="submit" class="limpar" onclick="limparDadosForm();" value="Limpar" />
            </form>                        
                
            <button onclick="posicionarMapa()">Marcar endereço no mapa</button>
            <div id="map" style="width:400px;height:200px;"></div> 

        </div>
    </div>
    <script type="text/javascript">
         (g=>{var h,a,k,p="The Google Maps JavaScript API",c="google",l="importLibrary",q="__ib__",m=document,b=window;b=b[c]||(b[c]={});var d=b.maps||(b.maps={}),r=new Set,e=new URLSearchParams,u=()=>h||(h=new Promise(async(f,n)=>{await (a=m.createElement("script"));e.set("libraries",[...r]+"");for(k in g)e.set(k.replace(/[A-Z]/g,t=>"_"+t[0].toLowerCase()),g[k]);e.set("callback",c+".maps."+q);a.src=`https://maps.${c}apis.com/maps/api/js?`+e;d[q]=f;a.onerror=()=>h=n(Error(p+" could not load."));a.nonce=m.querySelector("script[nonce]")?.nonce||"";m.head.append(a)}));d[l]?console.warn(p+" only loads once. Ignoring:",g):d[l]=(f,...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})
        ({key: "AIzaSyAfrS7Amt09uV6fA8F6-KZUWbC4rmdZ5-A", v: "weekly"});
        
        let map;

        async function initMap(endereco) {
          const { Map } = await google.maps.importLibrary("maps");
          const { AdvancedMarkerElement, PinElement } = await google.maps.importLibrary("marker");
            var geocoder = new google.maps.Geocoder();
                geocoder.geocode({
                    'address': endereco
                }, function(results, status) {
                    if(status == google.maps.GeocoderStatus.OK) {
                        document.getElementById("latlong_contato").value = results[0].geometry.location;
                        map.setCenter(results[0].geometry.location);
                        var marker = new google.maps.marker.AdvancedMarkerElement({
                                 map: map,
                                 title: endereco,
                                 position: results[0].geometry.location
                         });
                    }
                });
            
          
            map = new Map(document.getElementById("map"), {
              center: { lat: -25.4284, lng: -49.2733 },
              zoom: 16,
              mapId: 'contatos'
            });
            
        }

        // funçao que trará o usuário selecionado e abrirá um modal para alteração
        buscarUFs();
        
        function mostrarContato(id) {
            editarContato(id);
        }
        
        function editarContato(id) {
            fetch("api/contato/" + id, {method : "GET"})
                .then(data => { return data.json(); })
                .then(contato => { 
                    document.getElementById("id_contato").value = contato.id;
                    document.getElementById("nome_contato").value = contato.nome;
                    document.getElementById("cpf_contato").value = contato.cpf;
                    document.getElementById("telefone_contato").value = contato.telefone;
                    document.getElementById("cep_contato").value = contato.cep;
                    document.getElementById("endereco_contato").value = contato.endereco;
                    document.getElementById("numero_contato").value = contato.numero;
                    document.getElementById("complemento_contato").value = contato.complemento;
                    document.getElementById("bairro_contato").value = contato.nome_bairro;
                    document.getElementById("cidade_contato").value = contato.nome_cidade;
                    document.getElementById("uf_contato").value = contato.uf;
                    document.getElementById("latlong_contato").value = contato.lat_long;
                });
        }
        
        function buscarCep() {
            var cep = document.getElementById("cep_contato").value;
            fetch("api/cep/" + cep, {method : "GET"})
                .then(data => { return data.json(); })
                .then(cep => {
                    document.getElementById("endereco_contato").value = cep.logradouro;
                    document.getElementById("bairro_contato").value = cep.bairro
                    document.getElementById("cidade_contato").value = cep.localidade;
                    document.getElementById("uf_contato").value = cep.uf;
                });
        }
        function buscarUFs() {
            fetch("api/ufs", {method : "GET"})
                .then(data => { return data.json(); })
                .then(ret => {
                    var ufs = document.getElementById("uf_contato");
                    while(ufs.firsChild) {
                        ufs.removeChild(ufs.lastChild);
                    }
                    for(var i = 0; i < ret.length; i++) {
                        var obj = document.createElement("option");
                        obj.value = ret[i];
                        obj.innerHTML = ret[i];
                        ufs.appendChild(obj);
                    }
                });
        }
        
        function sugerirCidades(evt) {
            var texto = document.getElementById("cidade_contato").value;
            if(evt.keyCode == 8) { // backspace
                texto = texto.substr(-1);
            }
            var uf = document.getElementById("uf_contato").value;
            if(uf != null && uf != undefined && uf != '' && texto.lengh > 2) {
                buscarCidades(uf, texto + (evt.keyCode > 32 ? evt.key : ""));
            }
        }
        
        function buscarCidades(uf, texto) {
            fetch("api/cidades/" + uf.toUpperCase() + "/" + texto, {method : "GET"})
                .then(data => { return data.json(); })
                .then(ret => {
                    var listaCidades  = document.getElementById("lista-cidades-contato");
                    while(listaCidades.firsChild) {
                        listaCidades.removeChild(listaCidades.lastChild);
                    }
                    for(var i = 0; i < ret.length; i++) {
                        var obj = document.createElement("li");
                        obj.innerHTML = ret[i].id + " - " + ret[i].nome;
                        obj.addEventListener('click', function() {
                           alert(this.innerHTML); 
                        });
                        listaCidades.appendChild(obj);
                    }
                    listaCidades.style.display = "block";
                });
        }
        
        function excluirContato(id, nome) {
            var senha = prompt('Informe a senha para excluir o usuário ' + nome + ":");
            fetch("api/contato/" + id, {method : "DELETE", body: {senha: senha} })
                .then(data => { return data.json(); })
                .then(ret => {
                    if(ret == 1) {
                        alert("Contato " + nome + " excluido com sucesso");
                        location.reload();
                    }
                    else {
                        alert("ERRO ao excluir o contato " + nome);
                    }
                });
        }
        
        function limparDadosForm() {
            document.getElementById("id_usuario").value = "";
            document.getElementById("id_contato").value = "";
            document.getElementById("nome_contato").value = "";
            document.getElementById("cpf_contato").value = "";
            document.getElementById("telefone_contato").value = "";
            document.getElementById("cep_contato").value = "";
            document.getElementById("endereco_contato").value = "";
            document.getElementById("numero_contato").value = "";
            document.getElementById("complemento_contato").value = "";
            document.getElementById("bairro_contato").value = "";
            document.getElementById("cidade_contato").value = "";
            document.getElementById("latlang_contato").value = "";
            document.getElementById("lista-cidades").value = "";
            document.getElementById("lista-cidades").style.display = "none";
        }
        
        function validarESalvarDadosContato() {
            var id = document.getElementById("id_contato").value;
            var idUsuario = document.getElementById("id_usuario").value;
            var nome = document.getElementById("nome_contato").value;
            var cpf = document.getElementById("cpf_contato").value;
            var telefone = document.getElementById("telefone_contato").value;
            var cep = document.getElementById("cep_contato").value;
            var endereco = document.getElementById("endereco_contato").value;
            var numero = document.getElementById("numero_contato").value;
            var complemento = document.getElementById("complemento_contato").value;
            var bairro = document.getElementById("bairro_contato").value;
            var cidade = document.getElementById("cidade_contato").value;
            var uf = document.getElementById("uf_contato").value;
            var latLong = document.getElementById("latlong_contato").value;
            
            var msg = "";
            if(nome == "") {
                msg += "\nNome não pode ser vazio"; 
                document.getElementById("nome_contato").classList.add("erro");
            }
            else if(nome.length < 5) {
                msg += "\nNome inválido - menos de 5 caracteres"; 
                document.getElementById("nome_contato").classList.add("erro");
            }
            else {
                document.getElementById("nome_contato").classList.remove("erro");
            }
            if(!validaCPF(cpf)) {
                msg += "\nCPF inválido"; 
                document.getElementById("cpf_contato").classList.add("erro");
            }
            else {
                document.getElementById("cpf_contato").classList.remove("erro");
            }
            
            if(msg != "") {
                alert("Há erros que impedem a gravação - por favor verifique\n\n" + msg);
                return false;
            }
            else {
                var params = {'id_usuario': idUsuario, 'nome' : nome, 'cpf' : cpf, 'telefone' : telefone, 'cep' : cep, 'endereco' : endereco, 'numero' : numero, 'complemento' : complemento, 'bairro' : bairro, 'cidade' : cidade, 'uf' : uf, 'latlong' : latLong };
                if(id == null || id == undefined || id == "") { // trata-se de um novo contato
                    fetch("api/contato/", {method : "POST", headers: {"Content-Type": "application/x-www-form-urlencoded"},  body: new URLSearchParams(params).toString()})
                        .then(data => { return data.text(); })
                        .then(html => {
                            document.getElementById("lista-contatos").innerHTML = html;
                        });
                }
                else { // alteração de contato
                    fetch("api/contato/" + id, {method : "PUT", headers: {"Content-Type": "application/x-www-form-urlencoded"},  body: new URLSearchParams(params).toString()})
                        .then(data => { return data.text(); })
                        .then(html => {
                            document.getElementById("lista-contatos").innerHTML = html;
                        });
                }
                limparDadosForm();
                return false;
            }

        }
        
        function posicionarMapa() {
            var cep = document.getElementById("cep_contato").value;
            var endereco = document.getElementById("endereco_contato").value;
            var numero = document.getElementById("numero_contato").value;
            var bairro = document.getElementById("bairro_contato").value;
            var cidade = document.getElementById("cidade_contato").value;
            var uf = document.getElementById("uf_contato").value;
            var enderecoCompleto = endereco;
            if(numero != "") {
                enderecoCompleto += " " + numero;
            }
            enderecoCompleto += " bairro " + bairro;
            enderecoCompleto += " " + cidade;
            enderecoCompleto += " " + uf;
            
            initMap(enderecoCompleto);
        }
        
        function validaCPF(cpf) {
            cpf = cpf.replace(/\D+/g, '');
            if (cpf.length !== 11) return false;

            let soma = 0;
            let resto;
            if (/^(\d)\1{10}$/.test(cpf)) return false; // Verifica sequências iguais

            for (let i = 1; i <= 9; i++) soma += parseInt(cpf.substring(i-1, i)) * (11 - i);
            resto = (soma * 10) % 11;
            if ((resto === 10) || (resto === 11)) resto = 0;
            if (resto !== parseInt(cpf.substring(9, 10))) return false;

            soma = 0;
            for (let i = 1; i <= 10; i++) soma += parseInt(cpf.substring(i-1, i)) * (12 - i);
            resto = (soma * 10) % 11;
            if ((resto === 10) || (resto === 11)) resto = 0;
            if (resto !== parseInt(cpf.substring(10, 11))) return false;

            return true;
        }        
    </script>        
        
</x-app-layout>
