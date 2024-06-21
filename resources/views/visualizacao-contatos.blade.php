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
    <div>
        <div class="bg-white" style="width:40%; float: left;">
            @php($i = 0)
            @foreach($contatos as $contato)
                <div style="background-color:{{$i % 2 == 0 ? '#ffffff': '#dddddd'}}">
                    <div style="font-size:1.2em; font-weight: bold;">{{$contato["nome"] . " - " . $contato["id"]}}</div>
                    <div style="font-size:0.9em;">CPF: {{$contato["cpf"]}}</div>
                    <div style="font-size:0.8em;">Telefone: {{$contato["telefone"]}}</div>
                    <div style="font-size:0.8em;">{{$contato["endereco"] . ", " . $contato["numero"] . ($contato["complemento"] != "" ? " - " . $contato["complemento"] : "")}}</div>
                    <div style="font-size:0.8em;">{{$contato["cep"] . " - " . $contato["nome_bairro"] }}</div>
                    <div style="font-size:0.8em;">{{$contato["nome_cidade"] . " - " . $contato["uf"] }}</div>
                    <div style="font-size:0.8em;">{{$contato["lat_long"]}}</div>
                    <script>marcas.push('{{$contato["lat_long"]}}');</script>
                </div>
                @php($i++)
            @endforeach
        </div>
        <div class="bg-gray" style="float:right; width:55%; height: 600px;background-color: #005cbf;">
            <div id="map" style="width:100%;height:100%;"></div> 
        </div>
    </div>
     <script>
         (g=>{var h,a,k,p="The Google Maps JavaScript API",c="google",l="importLibrary",q="__ib__",m=document,b=window;b=b[c]||(b[c]={});var d=b.maps||(b.maps={}),r=new Set,e=new URLSearchParams,u=()=>h||(h=new Promise(async(f,n)=>{await (a=m.createElement("script"));e.set("libraries",[...r]+"");for(k in g)e.set(k.replace(/[A-Z]/g,t=>"_"+t[0].toLowerCase()),g[k]);e.set("callback",c+".maps."+q);a.src=`https://maps.${c}apis.com/maps/api/js?`+e;d[q]=f;a.onerror=()=>h=n(Error(p+" could not load."));a.nonce=m.querySelector("script[nonce]")?.nonce||"";m.head.append(a)}));d[l]?console.warn(p+" only loads once. Ignoring:",g):d[l]=(f,...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})
        ({key: "AIzaSyAfrS7Amt09uV6fA8F6-KZUWbC4rmdZ5-A", v: "weekly"});
        
        async function initMap() {
          const { Map } = await google.maps.importLibrary("maps");

          map = new Map(document.getElementById("map"), {
            center: { lat: -25.4284, lng: -49.2733 },
            zoom: 16,
          });
          for(var i = 0; i < marcas.length; i++) {
              if(marcas[i] != null && marcas[i] != "") {
                    var marker = new google.maps.Marker({
                            map: map,
                            position: new google.maps.LatLng(marcas[i])
                    });
              }
          }
        }
        
        let map;
        initMap();        
        
    </script>
</x-app-layout>
