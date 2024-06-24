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
                    {{ __("Bem-vindo, " . Auth::user()->name . "! Veja seus contatos.") }}
                </div>
            </div>
        </div>
    </div>
    <div style="display:flex;">
        <div style="width: 40%;  background-color: #ffffdd;">
            <div style="margin-top:30px; margin-bottom: 30px;">
                <div style="width:100%">
                    <label for="filtro-tipo-contato">Tipo de contato:</label>
                    <select id="filtro-tipo-contato">
                        <option>Todos</option>
                    </select>
                </div>
                <div style="width:100%">
                    <label for="filtro">Pesquisa:</label>
                    <input type="text" id="filtro" style="" onkeydown="pesquisarContatos(event);"/>
                </div>
            </div>
            <div id="lista-contatos" class="bg-white">
                @php
                    $tipo = "visualizacao";
                    require('../resources/views/lista-contato.php');
                @endphp
            </div>
        </div>
        <div class="bg-gray" style="width:55%; height: 600px;background-color: #005cbf;">
            <div id="map" style="width:100%;height:100%;"></div> 
        </div>
    </div>
     <script>
         (g=>{var h,a,k,p="The Google Maps JavaScript API",c="google",l="importLibrary",q="__ib__",m=document,b=window;b=b[c]||(b[c]={});var d=b.maps||(b.maps={}),r=new Set,e=new URLSearchParams,u=()=>h||(h=new Promise(async(f,n)=>{await (a=m.createElement("script"));e.set("libraries",[...r]+"");for(k in g)e.set(k.replace(/[A-Z]/g,t=>"_"+t[0].toLowerCase()),g[k]);e.set("callback",c+".maps."+q);a.src=`https://maps.${c}apis.com/maps/api/js?`+e;d[q]=f;a.onerror=()=>h=n(Error(p+" could not load."));a.nonce=m.querySelector("script[nonce]")?.nonce||"";m.head.append(a)}));d[l]?console.warn(p+" only loads once. Ignoring:",g):d[l]=(f,...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})
        ({key: "AIzaSyAfrS7Amt09uV6fA8F6-KZUWbC4rmdZ5-A", v: "weekly"});
        
        async function initMap() {
          const { Map } = await google.maps.importLibrary("maps");
          const { AdvancedMarkerElement, PinElement } = await google.maps.importLibrary("marker");
          
          map = new google.maps.Map(document.getElementById("map"), {
            center: { lat: -25.4284, lng: -49.2733 },
            zoom: 13,
            mapId: 'contatos'
          });
          for(var i = 0; i < marcas.length; i++) {
              if(marcas[i].latlng != null && marcas[i].latlng != "") {
                    var str = marcas[i].latlng.replace("(", "").replace(")", ""); // tirar os parênteses
                    var arr = str.split(","); // separar as coordenadas que estão separadas por vírgula;
                    var lat = parseFloat(arr.length > 0 ? arr[0] : "");
                    var lng = parseFloat(arr.length > 1 ? arr[1] : "");
                   var marker = new google.maps.marker.AdvancedMarkerElement({
                            map: map,
                            title: marcas[i].descr,
                            position: new google.maps.LatLng({lat: lat, lng: lng})
                    });
              }
          }
        }
        
        let map;
        initMap();        
        
        function pesquisarContatos(evt) {
            var texto = document.getElementById("filtro").value;
            if(evt.keyCode == 8 && texto.length > 1) { // backspace
                texto = texto.substr(0, texto.length - 1);
            }
            var tipoContato = document.getElementById("filtro-tipo-contato").value;
            filtrarContatos(tipoContato, texto + (evt.keyCode > 32 ? evt.key : ""));
        }
        
        function filtrarContatos(tipoContato, texto) {
            tipoContato = tipoContato != null && tipoContato != undefined && tipoContato != "" ? tipoContato : "Todos";
            texto = texto != null && texto != undefined ? texto : "";
            fetch("api/contatos/" + tipoContato + "/" + texto, {method : "GET"})
                .then(data => { return data.text(); })
                .then(html => {
                    document.getElementById("lista-contatos").innerHTML = html;
                });
        }
        
        function mostrarContato(id) {
            fetch("api/contato/" + id, {method : "GET"})
                .then(data => { return data.json(); })
                .then(contato => {
                    var str = contato.lat_long.replace("(", "").replace(")", ""); // tirar os parênteses
                    var arr = str.split(","); // separar as coordenadas que estão separadas por vírgula;
                    var lat = parseFloat(arr.length > 0 ? arr[0] : "");
                    var lng = parseFloat(arr.length > 1 ? arr[1] : "");
                    map.setCenter(new google.maps.LatLng({lat: lat, lng: lng}));
                });
        }
        
    </script>
</x-app-layout>
