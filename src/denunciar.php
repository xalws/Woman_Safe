<?php
include("../db/conection.php");
// Obtener las denuncias del ultimo mes
$query_denuncias = "SELECT * FROM denuncias WHERE fecha_denuncia >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)";
$result = mysqli_query($conn, $query_denuncias);

// Total de denuncias
$query_total = 'SELECT COUNT(*) FROM denuncias';
$result_total = $conn->query($query_total);

// Recuperar el total 
$cantidad = $result_total->fetch_row()[0];

// Colonias repetidas
$query_repetidos = "SELECT id_col, COUNT(*) as conteo 
                   FROM denuncias 
                   GROUP BY id_col 
                   HAVING COUNT(*) > 5";
$result_repetidos = mysqli_query($conn, $query_repetidos);

while ($row_repetido = mysqli_fetch_assoc($result_repetidos)) {
    $id_col = $row_repetido['id_col'];
    $query_mapa = "INSERT INTO mapa (lat, longitude, nombre, id_col) 
               SELECT  c.lat, c.longitude, c.nombre, c.id
               FROM colonias c 
               WHERE (id) = '$id_col'
               AND NOT EXISTS (SELECT 1 FROM mapa WHERE id_col = '$id_col')";

    mysqli_query($conn, $query_mapa);
}

// Fecha
date_default_timezone_set('America/Chihuahua');
$fecha = date('Y-m-d');

?>

<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Denunciar</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/estilo.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Required meta tags  -->
    <meta charset="utf-8" />
    <link rel="shortcut icon" href="/assets/img/woman.svg" type="image/x-icon">
</head>

<body class="body">
    <header>
        <!-- Nabvar -->
        <nav class="navbar navbar-expand-lg bg-white sticky-top">
            <div class="container">
                <a class="navbar-brand" href="../index.php">MujerSegura</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="mapas_denuncias.php">Mapa</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="ayuda.php">Ayuda</a>

                        </li>
                    </ul>
                    <a href="#" class="btn btn-brand ms-lg-3">Denunciar</a>
                    </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Content -->
    <div class="container mt-4">
        <div class="row">
            <!-- Agregar historia -->
            <div class="col-lg-8">
                <form action="../db/insertar.php" method="post">
                    <div class="feed-header">
                        <div class="">
                            <p class="labels">Descripción</p>
                            <textarea type="text" for="historia" id="historia" name="historia" class="form-control" placeholder="Cuentanos tu historia"></textarea>
                            <hr>
                            <p class="labels">Colonia</p>
                            <select class="form-select" id="" name="id_col">
                                <option value="749">Otra</option>
                                <option value="2">12 de Julio</option>
                                <option value="3">15 de Enero</option>
                                <option value="4">15 de Mayo</option>
                                <option value="5">16 de Septiembre</option>
                                <option value="6">1 de Mayo</option>
                                <option value="7">1 de Septiembre</option>
                                <option value="8">1 de Septiembre Ampliacion</option>
                                <option value="9">2da. Burocrata</option>
                                <option value="10">3 Jacales</option>
                                <option value="11">3ra. Burocrata</option>
                                <option value="12">5 de Mayo</option>
                                <option value="13">6 de Enero</option>
                                <option value="14">6 de Mayo</option>
                                <option value="15">9 de Septiembre (CDP)</option>
                                <option value="16">Acacias</option>
                                <option value="17">Acequias del Sur</option>
                                <option value="18">Adolfo Lopez Mateos</option>
                                <option value="19">Adriana</option>
                                <option value="20">Aeropuerto</option>
                                <option value="21">Aeropuerto Ampliacion</option>
                                <option value="22">Agricola Emiliano Zapata</option>
                                <option value="23">Aguilas</option>
                                <option value="24">Aguilas de Zaragoza</option>
                                <option value="25">Aguilas de Zaragoza (IVIECH)</option>
                                <option value="26">Agustin Melgar</option>
                                <option value="27">Alameda</option>
                                <option value="28">Alamos de San Lorenzo</option>
                                <option value="29">Alamos de Senecu</option>
                                <option value="30">Alcazar I (Capri)</option>
                                <option value="31">Alcazar II (Capri)</option>
                                <option value="32">Alfa</option>
                                <option value="33">Alondra</option>
                                <option value="34">Altamira</option>
                                <option value="35">Altavista</option>
                                <option value="36">Alvaro Obregon</option>
                                <option value="37">Amanda</option>
                                <option value="38">Americano</option>
                                <option value="39">Americas</option>
                                <option value="40">Anahuac</option>
                                <option value="41">Andrea</option>
                                <option value="42">Andres Figueroa</option>
                                <option value="43">Anglia Residencial</option>
                                <option value="44">Anita</option>
                                <option value="45">Antares</option>
                                <option value="46">Anzures</option>
                                <option value="47">Arboleda</option>
                                <option value="48">Arboleda San Fernando</option>
                                <option value="49">Arboledas de Senecu</option>
                                <option value="50">Arciniega</option>
                                <option value="51">Arcoiris</option>
                                <option value="52">Arecco</option>
                                <option value="53">Arroyo Colorado</option>
                                <option value="54">Arroyo del Paraiso</option>
                                <option value="55">Arturo Gamiz</option>
                                <option value="56">Asturias</option>
                                <option value="57">Atenas</option>
                                <option value="58">Atenas II</option>
                                <option value="59">Aurora</option>
                                <option value="60">Avinon</option>
                                <option value="61">Azteca</option>
                                <option value="62">Banus 360</option>
                                <option value="63">Barrio Alto</option>
                                <option value="64">Barrio Azul</option>
                                <option value="65">Barrio Hierro</option>
                                <option value="66">Barrio Nuevo</option>
                                <option value="67">Bella Provincia</option>
                                <option value="68">Bella Vista</option>
                                <option value="69">Bello Horizonte</option>
                                <option value="70">Benito Juarez</option>
                                <option value="71">Bilbao</option>
                                <option value="72">Boca del Rio</option>
                                <option value="73">Bonanza Residencial</option>
                                <option value="74">Bosque Bonito</option>
                                <option value="75">Bosques del Sol</option>
                                <option value="76">Bosques del Valle</option>
                                <option value="77">Bosques de Maple</option>
                                <option value="78">Bosques de Salvarcar</option>
                                <option value="79">Bosques de San Jose</option>
                                <option value="80">Bosques de Santa Fe</option>
                                <option value="81">Bosques de Senecu</option>
                                <option value="82">Bosques de Sicomoro</option>
                                <option value="83">Bosques de Waterfill</option>
                                <option value="84">Bosques Residencial</option>
                                <option value="85">Britania</option>
                                <option value="86">Buendia</option>
                                <option value="87">Buenos Aires</option>
                                <option value="88">Bugambilias</option>
                                <option value="89">Burocrata</option>
                                <option value="90">Burocrata Municipal</option>
                                <option value="91">Calzada del Sol</option>
                                <option value="92">Camino Real</option>
                                <option value="93">Campestre</option>
                                <option value="94">Campestre Ampliacion</option>
                                <option value="95">Campestre Arboleda</option>
                                <option value="96">Campestre las Palmas</option>
                                <option value="97">Campestre Maria Isabel</option>
                                <option value="98">Campestre San Marcos</option>
                                <option value="99">Campestre Sur</option>
                                <option value="100">Campestre Virreyes</option>
                                <option value="101">Campos Eliseos</option>
                                <option value="102">Canto de Calabria</option>
                                <option value="103">Canto de Catania</option>
                                <option value="104">Canto de Murano</option>
                                <option value="105">Canto de Toscana</option>
                                <option value="106">Capistrano</option>
                                <option value="107">Carlos Castillo Peraza</option>
                                <option value="108">Carlos Chavira Becerra</option>
                                <option value="109">Casitas de Satelite</option>
                                <option value="110">Catalan</option>
                                <option value="111">Cazadores Juarenses</option>
                                <option value="112">Centro</option>
                                <option value="113">Centro Industrial Juarez</option>
                                <option value="114">CERESO y Ciudad Militar</option>
                                <option value="115">Cerrada Abedul</option>
                                <option value="116">Cerrada Andaluz</option>
                                <option value="117">Cerrada Arboledas</option>
                                <option value="118">Cerrada Basalto</option>
                                <option value="119">Cerrada de los Cipreses</option>
                                <option value="120">Cerrada del Sol</option>
                                <option value="121">Cerrada del Valle</option>
                                <option value="122">Cerrada de Tarso</option>
                                <option value="123">Cerrada los Olivos</option>
                                <option value="124">Cerradas de Oriente I</option>
                                <option value="125">Cerradas de Oriente II</option>
                                <option value="126">Cerrada Vinedos</option>
                                <option value="127">Chamizal</option>
                                <option value="128">Chavena</option>
                                <option value="129">Chavez-Vargas</option>
                                <option value="130">Che Guevara</option>
                                <option value="131">Chihuahua</option>
                                <option value="132">Cibeles</option>
                                <option value="133">Cielo Vista</option>
                                <option value="134">Ciudad Juarez (Abraham Gonzalez)</option>
                                <option value="135">Ciudad Moderna</option>
                                <option value="136">Ciudad Rio Bravo</option>
                                <option value="137">Colegio</option>
                                <option value="138">Colinas de Juarez</option>
                                <option value="139">Colinas del Desierto</option>
                                <option value="140">Colinas del Norte</option>
                                <option value="141">Colinas del Sol</option>
                                <option value="142">Colinas del Sur</option>
                                <option value="143">Colonial</option>
                                <option value="144">Del Agua</option>
                                <option value="145">Del Bravo</option>
                                <option value="146">Del Carmen</option>
                                <option value="147">Del Encino</option>
                                <option value="148">Del Futuro</option>
                                <option value="149">Del Maestro</option>
                                <option value="150">Del Maestro (Deportiva)</option>
                                <option value="151">Del Marquez</option>
                                <option value="152">Del Norte</option>
                                <option value="153">De los Mecanicos</option>
                                <option value="154">Del Palmar</option>
                                <option value="155">Del Real</option>
                                <option value="156">Del Safari 1</option>
                                <option value="157">Del Solar</option>
                                <option value="158">Del Valle</option>
                                <option value="159">Demetrio Flores</option>
                                <option value="160">Desarrollo Salvacar</option>
                                <option value="161">Dinamarca</option>
                                <option value="162">Distrito Soho</option>
                                <option value="163">Division del Norte</option>
                                <option value="164">Don Julio</option>
                                <option value="165">Dunas Residencial</option>
                                <option value="166">Durango</option>
                                <option value="167">Eco 2000</option>
                                <option value="168">Edificio Cartagena</option>
                                <option value="169">Educacion</option>
                                <option value="170">Ejido Sauzal</option>
                                <option value="171">El Barreal</option>
                                <option value="172">El Campanario</option>
                                <option value="173">El Campanario 4 Siglos</option>
                                <option value="174">El Cid</option>
                                <option value="175">El Dorado</option>
                                <option value="176">Electricistas</option>
                                <option value="177">El Fortin</option>
                                <option value="178">El Granjero (Pie de Casa)</option>
                                <option value="179">El Marmol</option>
                                <option value="180">El Mezquital</option>
                                <option value="181">El Millon</option>
                                <option value="182">El Papalote</option>
                                <option value="183">El Paraiso</option>
                                <option value="184">El Paseo</option>
                                <option value="185">El Pensamiento</option>
                                <option value="186">El Portal</option>
                                <option value="187">El Roble</option>
                                <option value="188">El Sauzal</option>
                                <option value="189">El Vergel</option>
                                <option value="190">Emiliano Zapata</option>
                                <option value="191">Era del Valle</option>
                                <option value="192">Era de San Lorenzo</option>
                                <option value="193">Erendira</option>
                                <option value="194">Estacion Mendez</option>
                                <option value="195">Estrella del Poniente</option>
                                <option value="196">Excelencia</option>
                                <option value="197">Ex Hipodromo</option>
                                <option value="198">Felipe Angeles</option>
                                <option value="199">Felipe Angeles Ampliacion</option>
                                <option value="200">Fernando Baeza M.</option>
                                <option value="201">Fidel Avila</option>
                                <option value="202">Florecillas</option>
                                <option value="203">Florencia</option>
                                <option value="204">Floresta</option>
                                <option value="205">Floresta de San Jose</option>
                                <option value="206">Fovissste Chamizal</option>
                                <option value="207">FOVISSSTE Sur</option>
                                <option value="208">Foxconn</option>
                                <option value="209">Francisco I. Madero</option>
                                <option value="210">Francisco Sarabia</option>
                                <option value="211">Francisco Villa</option>
                                <option value="212">Franja del Rio</option>
                                <option value="213">Fray Garcia de San Francisco</option>
                                <option value="214">Frida Khalo</option>
                                <option value="215">Frontera</option>
                                <option value="216">Fronteriza</option>
                                <option value="217">Fronteriza Ampliacion</option>
                                <option value="218">Fuentes Copilco</option>
                                <option value="219">Fuentes de los Nogales</option>
                                <option value="220">Fuentes del Seminario</option>
                                <option value="221">Fuentes del Valle</option>
                                <option value="222">Fundidora</option>
                                <option value="223">Gaby</option>
                                <option value="224">Gardeno</option>
                                <option value="225">Genova</option>
                                <option value="226">Girasoles</option>
                                <option value="227">Granada</option>
                                <option value="228">Granjas de Chapultepec</option>
                                <option value="229">Granjas del Desierto</option>
                                <option value="230">Granjas de San Rafael</option>
                                <option value="231">Granjas El Progreso</option>
                                <option value="232">Granjas los Alcaldes</option>
                                <option value="233">Granjas Polo Gamboa</option>
                                <option value="234">Granjas San Rafael</option>
                                <option value="235">Granjas Santa Elena</option>
                                <option value="236">Granjas Unidas</option>
                                <option value="237">Granjero</option>
                                <option value="238">Gregorio M. Solis</option>
                                <option value="239">Guadalajara</option>
                                <option value="240">Gustavo Diaz Ordaz</option>
                                <option value="241">Habitad del Rio</option>
                                <option value="242">Hacienda</option>
                                <option value="243">Hacienda de Aragon</option>
                                <option value="244">Hacienda de La Paloma</option>
                                <option value="245">Hacienda de las Torres</option>
                                <option value="246">Hacienda de las Torres Universidad</option>
                                <option value="247">Hacienda de las Torres XII - XIII</option>
                                <option value="248">Hacienda de los Nogales</option>
                                <option value="249">Hacienda del Rosario</option>
                                <option value="250">Hacienda del Sauz</option>
                                <option value="251">Hacienda del Sol</option>
                                <option value="252">Hacienda de San Francisco</option>
                                <option value="253">Hacienda de San Pedro</option>
                                <option value="254">Hacienda Giralda</option>
                                <option value="255">Hacienda La Cantera</option>
                                <option value="256">Hacienda las Lajas</option>
                                <option value="257">Hacienda Residencial</option>
                                <option value="258">Hacienda San Antonio</option>
                                <option value="259">Hacienda San Jose</option>
                                <option value="260">Hacienda San Juan</option>
                                <option value="261">Hacienda San Paulo</option>
                                <option value="262">Hacienda Santa Fe</option>
                                <option value="263">Haciendas del Campanario</option>
                                <option value="264">Hacienda Senecu</option>
                                <option value="265">Harmoni</option>
                                <option value="266">Hermenegildo Galeana</option>
                                <option value="267">Hermila</option>
                                <option value="268">Heroes de La Revolucion</option>
                                <option value="269">Heroes de Mexico</option>
                                <option value="270">Hidalgo</option>
                                <option value="271">Holanda</option>
                                <option value="272">Horizontes del Sur</option>
                                <option value="273">Ignacio Aldama</option>
                                <option value="274">Ignacio Allende</option>
                                <option value="275">Independencia II</option>
                                <option value="276">Independencia Sur</option>
                                <option value="277">Industrial</option>
                                <option value="278">INFONAVIT Ampliacion Aeropuerto</option>
                                <option value="279">INFONAVIT Angel Trias</option>
                                <option value="280">INFONAVIT Casas Grandes</option>
                                <option value="281">INFONAVIT El Jarudo</option>
                                <option value="282">INFONAVIT Fidel Velazquez</option>
                                <option value="283">INFONAVIT Juarez Nuevo</option>
                                <option value="284">INFONAVIT Mil Cumbres</option>
                                <option value="285">INFONAVIT Oasis</option>
                                <option value="286">INFONAVIT Parques Industriales</option>
                                <option value="287">INFONAVIT Salvarcar</option>
                                <option value="288">INFONAVIT San Lorenzo</option>
                                <option value="289">INFONAVIT Solidaridad</option>
                                <option value="290">INFONAVIT Tecnologico</option>
                                <option value="291">Ingeniero Portillo</option>
                                <option value="292">Instituto de Ciencias Biomedicas (ICB)</option>
                                <option value="293">Instituto de Ingenieria y Arquitectura (IIT/IADA)</option>
                                <option value="294">Insurgentes</option>
                                <option value="295">Isla del Encanto</option>
                                <option value="296">Ixtapa</option>
                                <option value="297">Jardin</option>
                                <option value="298">Jardin de las Moras</option>
                                <option value="299">Jardin de Senecu</option>
                                <option value="300">Jardines Campestre</option>
                                <option value="301">Jardines de Aragon</option>
                                <option value="302">Jardines de Coyoacan</option>
                                <option value="303">Jardines del Aeropuerto</option>
                                <option value="304">Jardines del Bosque</option>
                                <option value="305">Jardines del Lago</option>
                                <option value="306">Jardines del Seminario</option>
                                <option value="307">Jardines del Valle</option>
                                <option value="308">Jardines del Valle I</option>
                                <option value="309">Jardines del Valle II</option>
                                <option value="310">Jardines del Valle III</option>
                                <option value="311">Jardines de Roma</option>
                                <option value="312">Jardines de San Carlos</option>
                                <option value="313">Jardines de San Francisco</option>
                                <option value="314">Jardines de San Jose</option>
                                <option value="315">Jardines de San Marcos</option>
                                <option value="316">Jardines de San Miguel</option>
                                <option value="317">Jardines de San Pablo</option>
                                <option value="318">Jardines de San Patricio</option>
                                <option value="319">Jardines de Santa Clara</option>
                                <option value="320">Jardines de Santa Monica</option>
                                <option value="321">Jardines de Satelite</option>
                                <option value="322">Jardines Residencial</option>
                                <option value="323">Jardines Senecu</option>
                                <option value="324">Jarudo</option>
                                <option value="325">Jasso</option>
                                <option value="326">Jazmines</option>
                                <option value="327">Jesus Carranza (La Colorada)</option>
                                <option value="328">Josefa Ortiz de Dominguez</option>
                                <option value="329">Jose Maria Pino Suarez</option>
                                <option value="330">Jose Marti</option>
                                <option value="331">Juarez</option>
                                <option value="332">Kilometro 20</option>
                                <option value="333">Kilometro 20 Jose Maria</option>
                                <option value="334">Kilometro 27</option>
                                <option value="335">Kilometro 28</option>
                                <option value="336">Kilometro 29</option>
                                <option value="337">Kilometro 5</option>
                                <option value="338">La Campesina</option>
                                <option value="339">La Canada</option>
                                <option value="340">La Cementera</option>
                                <option value="341">La Conquista</option>
                                <option value="342">La Cuesta</option>
                                <option value="343">La Cuesta II</option>
                                <option value="344">Ladrillera Juarez</option>
                                <option value="345">Ladrillera Juarez Ampliacion</option>
                                <option value="346">Ladrilleros y Caleros</option>
                                <option value="347">La Florida</option>
                                <option value="348">La Fortuna</option>
                                <option value="349">La Fuente</option>
                                <option value="350">La Galeanita</option>
                                <option value="351">La Gaviota</option>
                                <option value="352">La Gran Manzana</option>
                                <option value="353">La Hacienda</option>
                                <option value="354">La Herradura</option>
                                <option value="355">La Joya</option>
                                <option value="356">La Mesita</option>
                                <option value="357">La Moraleja</option>
                                <option value="358">La Muralla</option>
                                <option value="359">La Nueva Rosita</option>
                                <option value="360">La Paloma</option>
                                <option value="361">La Parcela</option>
                                <option value="362">La Parroquia</option>
                                <option value="363">La Perla</option>
                                <option value="364">La Playa</option>
                                <option value="365">La Presa</option>
                                <option value="366">La Raza</option>
                                <option value="367">La Rivera</option>
                                <option value="368">La Rosaleda</option>
                                <option value="369">La Rosita</option>
                                <option value="370">Las Acequias</option>
                                <option value="371">Las Aldabas</option>
                                <option value="372">Las Almeras</option>
                                <option value="373">Las Arcadas</option>
                                <option value="374">Las Arenas</option>
                                <option value="375">Las Arenas 2</option>
                                <option value="376">La Sarzana</option>
                                <option value="377">Las Dunas</option>
                                <option value="378">Las Flores</option>
                                <option value="379">Las Garzas</option>
                                <option value="380">Las Gladiolas</option>
                                <option value="381">Las Haciendas</option>
                                <option value="382">Las Haciendas Oriente</option>
                                <option value="383">Las Hadas</option>
                                <option value="384">Las Lomas</option>
                                <option value="385">Las Lunas</option>
                                <option value="386">Las Montanas</option>
                                <option value="387">Las Nueces</option>
                                <option value="388">Las Palmas</option>
                                <option value="389">Las Palomas</option>
                                <option value="390">Las Placitas I</option>
                                <option value="391">Las Placitas II</option>
                                <option value="392">Las Quintas</option>
                                <option value="393">Las Torres I y II</option>
                                <option value="394">Lausane</option>
                                <option value="395">Lazaro Cardenas</option>
                                <option value="396">Lexmark</option>
                                <option value="397">Leyes de Reforma</option>
                                <option value="398">Libertad</option>
                                <option value="399">Lince</option>
                                <option value="400">Linda Vista</option>
                                <option value="401">Lisboa</option>
                                <option value="402">Loma Blanca</option>
                                <option value="403">Loma Linda</option>
                                <option value="404">Lomas del Desierto I</option>
                                <option value="405">Lomas del Desierto II</option>
                                <option value="406">Lomas del Desierto III</option>
                                <option value="407">Lomas del Poleo</option>
                                <option value="408">Lomas del Rey</option>
                                <option value="409">Lomas del Valle</option>
                                <option value="410">Lomas de Morelos</option>
                                <option value="411">Lomas de San Jose</option>
                                <option value="412">Los Agaves</option>
                                <option value="413">Los Alamos</option>
                                <option value="414">Los Alcaldes Ampliacion</option>
                                <option value="415">Los Alpes</option>
                                <option value="416">Los Angeles</option>
                                <option value="417">Los Arcos</option>
                                <option value="418">Los Bosques</option>
                                <option value="419">Los Cardenales</option>
                                <option value="420">Los Cedros</option>
                                <option value="421">Los Cipreses</option>
                                <option value="422">Los Cisnes</option>
                                <option value="423">Los Colorines</option>
                                <option value="424">Los Frayles</option>
                                <option value="425">Los Fresnos</option>
                                <option value="426">Los Girasoles</option>
                                <option value="427">Los Jardines</option>
                                <option value="428">Los Lagos</option>
                                <option value="429">Los Laureles</option>
                                <option value="430">Los Manantiales</option>
                                <option value="431">Los Mezquites</option>
                                <option value="432">Los Mirlos</option>
                                <option value="433">Los Naranjos</option>
                                <option value="434">Los Nogales</option>
                                <option value="435">Los Olivos</option>
                                <option value="436">Los Olmos</option>
                                <option value="437">Los Olmos TEC</option>
                                <option value="438">Los Parques</option>
                                <option value="439">Los Pinos</option>
                                <option value="440">Los Portales</option>
                                <option value="441">Los Romerales</option>
                                <option value="442">Los Sauces</option>
                                <option value="443">Los Saucos</option>
                                <option value="444">Los Tulipanes</option>
                                <option value="445">Los Virreyes</option>
                                <option value="446">Los Volcanes</option>
                                <option value="447">Lucio Blanco</option>
                                <option value="448">Lucio Blanco II</option>
                                <option value="449">Lucio Cabanas</option>
                                <option value="450">Luis Donaldo Colosio</option>
                                <option value="451">Luis Echeverria</option>
                                <option value="452">Luis Olague</option>
                                <option value="453">Maestros Estatales y Federales</option>
                                <option value="454">Magisterial</option>
                                <option value="455">Magnolia</option>
                                <option value="456">Malaga</option>
                                <option value="457">Manuel Gomez Morin</option>
                                <option value="458">Manuel J. Clouthier</option>
                                <option value="459">Manuel Valdez</option>
                                <option value="460">Maquila Thomson</option>
                                <option value="461">Margaritas</option>
                                <option value="462">Maria Isabel</option>
                                <option value="463">Mariano Escobedo</option>
                                <option value="464">Marquis</option>
                                <option value="465">Marruecos</option>
                                <option value="466">Mascarenas</option>
                                <option value="467">Mayas Sur</option>
                                <option value="468">Mayorga</option>
                                <option value="469">Medanos</option>
                                <option value="470">Melchor Ocampo</option>
                                <option value="471">Mexico</option>
                                <option value="472">Mexico 68</option>
                                <option value="473">Miguel Auza</option>
                                <option value="474">Miguel Enriquez Guzman</option>
                                <option value="475">Milan</option>
                                <option value="476">Mil Cumbres</option>
                                <option value="477">Minerva</option>
                                <option value="478">Mirador</option>
                                <option value="479">Mision de los Lagos</option>
                                <option value="480">Mision del Sol</option>
                                <option value="481">Mision de San Miguel</option>
                                <option value="482">Misiones</option>
                                <option value="483">Misiones de Creel</option>
                                <option value="484">Misiones del Emir</option>
                                <option value="485">Misiones del Portal</option>
                                <option value="486">Misiones del Real</option>
                                <option value="487">Misiones del Sur Residencial</option>
                                <option value="488">Ramos Aviles</option>
                                <option value="489">Rancho Anapra</option>
                                <option value="490">Raul Garcia</option>
                                <option value="491">Real de Guadalupe</option>
                                <option value="492">Real de las Torres</option>
                                <option value="493">Real del Desierto</option>
                                <option value="494">Real del Desierto II</option>
                                <option value="495">Real del Sol</option>
                                <option value="496">Real del Sol II</option>
                                <option value="497">Real de San Jose</option>
                                <option value="498">Real Waterfill</option>
                                <option value="499">Reforma</option>
                                <option value="500">Reginaldo Kluche</option>
                                <option value="501">Renovacion 92</option>
                                <option value="502">Reserva del Valle</option>
                                <option value="503">Residencial Alamedas</option>
                                <option value="504">Residencial Almendros</option>
                                <option value="505">Residencial Andalucia</option>
                                <option value="506">Residencial Bugambilias</option>
                                <option value="507">Residencial Campestre Senecu</option>
                                <option value="508">Residencial Coloso</option>
                                <option value="509">Residencial el Papalote</option>
                                <option value="510">Residencial Florencia</option>
                                <option value="511">Residencial Galgodromo</option>
                                <option value="512">Residencial Hacienda</option>
                                <option value="513">Residencial Insurgentes</option>
                                <option value="514">Residencial Ixtapa</option>
                                <option value="515">Residencial las Cumbres</option>
                                <option value="516">Residencial las Fuentes</option>
                                <option value="517">Residencial las Villas</option>
                                <option value="518">Residencial Lausane</option>
                                <option value="519">Residencial La Villa</option>
                                <option value="520">Residencial Maria Isabel</option>
                                <option value="521">Residencial Montecarlo</option>
                                <option value="522">Residencial Pueblo del Sol</option>
                                <option value="523">Residencial San Francisco</option>
                                <option value="524">Residencial San Jeronimo</option>
                                <option value="525">Residencial Sendas</option>
                                <option value="526">Residencial Victoria</option>
                                <option value="527">Residencial Villa Jardin</option>
                                <option value="528">Residencial Villas del Bravos</option>
                                <option value="529">Residencial Villas Loreto</option>
                                <option value="530">Revolucion Mexicana</option>
                                <option value="531">Reyna Fabiola</option>
                                <option value="532">Ricardo Flores Magon</option>
                                <option value="533">Ricardo Montoya</option>
                                <option value="534">Rinconada de las Flores</option>
                                <option value="535">Rinconada de las Torres</option>
                                <option value="536">Rinconada de las Torres IV</option>
                                <option value="537">Rinconada del Rio</option>
                                <option value="538">Rinconada de San Marcos</option>
                                <option value="539">Rinconada los Nogales</option>
                                <option value="540">Rincon del Amanecer</option>
                                <option value="541">Rincon de La Mesa</option>
                                <option value="542">Rincon de las Flores</option>
                                <option value="543">Rincon de las Flores II</option>
                                <option value="544">Rincon del Cielo</option>
                                <option value="545">Rincon del Portal</option>
                                <option value="546">Rincon del Rio</option>
                                <option value="547">Rincon del Rio II</option>
                                <option value="548">Rincon del Seminario</option>
                                <option value="549">Rincon del Sol</option>
                                <option value="550">Rincon del Solar</option>
                                <option value="551">Rincon del Solar II</option>
                                <option value="552">Rincon del Sur</option>
                                <option value="553">Rincon del Valle</option>
                                <option value="554">Rincon de Waterfill</option>
                                <option value="555">Rincones de Cartagena</option>
                                <option value="556">Rincones del Campanario</option>
                                <option value="557">Rincones del Campestre</option>
                                <option value="558">Rincones del Valle</option>
                                <option value="559">Rincones de Oriente</option>
                                <option value="560">Rincones de Salvarcar</option>
                                <option value="561">Rincones de Salvarcar II</option>
                                <option value="562">Rincones de San Marcos</option>
                                <option value="563">Rincones de Santa Fe</option>
                                <option value="564">Rincones de Santa Rita</option>
                                <option value="565">Rio Grande</option>
                                <option value="566">Rio Grande I - XXV</option>
                                <option value="567">Riveras del Bravo</option>
                                <option value="568">Riveras del Bravo IX</option>
                                <option value="569">Rodas</option>
                                <option value="570">Rodriguez Borunda</option>
                                <option value="571">Roma</option>
                                <option value="572">Roma Poniente</option>
                                <option value="573">Ruisenor</option>
                                <option value="574">Salvarcar</option>
                                <option value="575">Samalayuca</option>
                                <option value="576">San Agustin</option>
                                <option value="577">San Angel</option>
                                <option value="578">San Antonio</option>
                                <option value="579">San Antonio Senecu</option>
                                <option value="580">San Borja</option>
                                <option value="581">Sandra Lucia</option>
                                <option value="582">San Felipe el Real</option>
                                <option value="583">San Fernando</option>
                                <option value="584">San Isidro Rio Grande</option>
                                <option value="585">San Jeronimo</option>
                                <option value="586">San Jose</option>
                                <option value="587">San Lorenzo</option>
                                <option value="588">San Marcos</option>
                                <option value="589">San Miguel de Allende</option>
                                <option value="590">San Pablo</option>
                                <option value="591">San Patricio</option>
                                <option value="592">San Pedro</option>
                                <option value="593">San Pedro del Real</option>
                                <option value="594">San Rafael</option>
                                <option value="595">Santa Catalina</option>
                                <option value="596">Santa Cecilia</option>
                                <option value="597">Santa Engracia</option>
                                <option value="598">Santa Fe</option>
                                <option value="599">Santa Lucia</option>
                                <option value="600">Santa Maria</option>
                                <option value="601">Santa Martha</option>
                                <option value="602">Santa Monica</option>
                                <option value="603">Santa Rosa</option>
                                <option value="604">Santa Rosalia</option>
                                <option value="605">Santa Teresa</option>
                                <option value="606">San Valentin</option>
                                <option value="607">Sara Lugo</option>
                                <option value="608">Satelite</option>
                                <option value="609">Senderos del Sol</option>
                                <option value="610">Senderos de Oriente</option>
                                <option value="611">Senderos de San Isidro</option>
                                <option value="612">Senecu I</option>
                                <option value="613">Senecu II</option>
                                <option value="614">Senorial</option>
                                <option value="615">Servet</option>
                                <option value="616">Sevilla</option>
                                <option value="617">Sicomoros</option>
                                <option value="618">Sierra Grande</option>
                                <option value="619">Sierra Vista</option>
                                <option value="620">Siglo XXI</option>
                                <option value="621">Silvias</option>
                                <option value="622">Simon Rodriguez</option>
                                <option value="623">SOCOCEMA</option>
                                <option value="624">Sol de Mayo</option>
                                <option value="625">Solidaridad</option>
                                <option value="626">Sor Juana Ines de La Cruz</option>
                                <option value="627">Stockmeyer</option>
                                <option value="628">Suecia</option>
                                <option value="629">Suterm</option>
                                <option value="630">Tabachines</option>
                                <option value="631">Tarahumaras</option>
                                <option value="632">Tarragona</option>
                                <option value="633">TEC de Monterrey</option>
                                <option value="634">Tecnologico</option>
                                <option value="635">Telegrafistas</option>
                                <option value="636">Terranova</option>
                                <option value="637">Terranova Sur</option>
                                <option value="638">Terrazas del Valle</option>
                                <option value="639">Terrenos Nacionales Sur</option>
                                <option value="640">Tierra Nueva I Etapa</option>
                                <option value="641">Tierra Nueva II Etapa</option>
                                <option value="642">Tierra y Libertad</option>
                                <option value="643">Tiradores del Norte</option>
                                <option value="644">Tita</option>
                                <option value="645">Toledo</option>
                                <option value="646">Toribio Ortega</option>
                                <option value="647">Torreon</option>
                                <option value="648">Torres del PRI</option>
                                <option value="649">Torres del Sur</option>
                                <option value="650">Trebol Norte</option>
                                <option value="651">Trebol Sur</option>
                                <option value="652">Tres Fresnos</option>
                                <option value="653">Tres Hermanos Arecco</option>
                                <option value="654">Tres Torres</option>
                                <option value="655">U.H. Benito Juarez</option>
                                <option value="656">U.H. Emiliano Zapata</option>
                                <option value="657">U.H. Paso del Norte</option>
                                <option value="658">U.H. Reforma</option>
                                <option value="659">Uranga-Unzueta</option>
                                <option value="660">Urbi Alameda Versalles</option>
                                <option value="661">Urbiquinta Granada</option>
                                <option value="662">Urbi Quinta Montecarlo</option>
                                <option value="663">Urbivilla Bonita</option>
                                <option value="664">Urbivilla del Campo</option>
                                <option value="665">Urbivilla del Cedro</option>
                                <option value="666">Urbivilla del Prado</option>
                                <option value="667">Urbivilla del Prado I</option>
                                <option value="668">Valladolid</option>
                                <option value="669">Vallarta</option>
                                <option value="670">Valle Alto</option>
                                <option value="671">Valle de Allende</option>
                                <option value="672">Valle del Bravo</option>
                                <option value="673">Valle del Marques</option>
                                <option value="674">Valle de los Cantaros</option>
                                <option value="675">Valle del Sol</option>
                                <option value="676">Valle de Olivos</option>
                                <option value="677">Valle de Santiago</option>
                                <option value="678">Valle Diamante</option>
                                <option value="679">Valle Dorado</option>
                                <option value="680">Valle Dorado I</option>
                                <option value="681">Valle Dorado II</option>
                                <option value="682">Valle Dorado III</option>
                                <option value="683">Valle Fundadores</option>
                                <option value="684">Valle Oriente</option>
                                <option value="685">Valles de America</option>
                                <option value="686">Valle Sur</option>
                                <option value="687">Valle Verde</option>
                                <option value="688">Venecia</option>
                                <option value="689">Veneciano</option>
                                <option value="690">Veredas del Sol</option>
                                <option value="691">Vergel Satelite I y II</option>
                                <option value="692">Versalles</option>
                                <option value="693">Vicente Guerrero</option>
                                <option value="694">Villa Alegre</option>
                                <option value="695">Villa Alegre I, II, III</option>
                                <option value="696">Villa Bonita</option>
                                <option value="697">Villa Colonial</option>
                                <option value="698">Villa de La Arboleda</option>
                                <option value="699">Villa del Lago</option>
                                <option value="700">Villa del Norte</option>
                                <option value="701">Villa Esperanza</option>
                                <option value="702">Villahermosa</option>
                                <option value="703">Villa Jacarandas</option>
                                <option value="704">Villa Jardin</option>
                                <option value="705">Villa Manzanares</option>
                                <option value="706">Villa Marcela</option>
                                <option value="707">Villa Mexicana</option>
                                <option value="708">Villa Residencial del Real</option>
                                <option value="709">Villas Adlin</option>
                                <option value="710">Villas Anitas</option>
                                <option value="711">Villa San Pablo</option>
                                <option value="712">Villas Cerezmy</option>
                                <option value="713">Villas Conifer</option>
                                <option value="714">Villas de Alcala</option>
                                <option value="715">Villas del Bravo I</option>
                                <option value="716">Villas del Granero</option>
                                <option value="717">Villas del Lobo</option>
                                <option value="718">Villas del Rio</option>
                                <option value="719">Villas del Solar</option>
                                <option value="720">Villas del Sur</option>
                                <option value="721">Villas del Valle</option>
                                <option value="722">Villas de Pradera Dorada</option>
                                <option value="723">Villas de Salvarcar</option>
                                <option value="724">Villas de Senecu</option>
                                <option value="725">Villas Primavera</option>
                                <option value="726">Villas San Angel A y B</option>
                                <option value="727">Villas San Jose</option>
                                <option value="728">Villas San Marcos</option>
                                <option value="729">Villas San Rafael</option>
                                <option value="730">Villas Santa Fe</option>
                                <option value="731">Villas Santa Teresa</option>
                                <option value="732">Villas Solares</option>
                                <option value="733">Villas Vista del Sol</option>
                                <option value="734">Vista de la Cumbre I, II, III</option>
                                <option value="735">Vista del Norte</option>
                                <option value="736">Vista del Sol</option>
                                <option value="737">Vista del Valle</option>
                                <option value="738">Vista Hermosa</option>
                                <option value="739">Vistas de la Aurora</option>
                                <option value="740">Vistas del Bravo I</option>
                                <option value="741">Vistas del Bravo II</option>
                                <option value="742">Vistas del Bravo III</option>
                                <option value="743">Vistas de Zaragoza</option>
                                <option value="744">Waterfill Rio Bravo</option>
                                <option value="745">Yolanda</option>
                                <option value="746">Zacatecas</option>
                                <option value="747">Zaragoza</option>
                                <option value="748">Zuri</option>
                            </select>
                            <hr>
                            <p class="labels">Fecha</p>
                            <input type="date" name="fecha" id="fecha" class="form-control" max="<?php echo $fecha ?>" min="2010-01-01">
                            <hr>
                            <p class="labels">Categoría</p>
                            <select class="form-select" id="" name="categoria">
                                <option value="Acoso u hostigamiento">Acoso u hostigamiento</option>
                                <option value="Violencia psicológica">Violencia psicológica</option>
                                <option value="Amenaza">Amenaza</option>
                                <option value="Violencia física">Violencia física</option>
                                <option value="Violencia doméstica">Violencia doméstica</option>
                                <option value="Violencia sexual">Violencia sexual</option>
                                <option value="Violencia laboral">Violencia laboral</option>
                                <option value="Violencia obstétrica">Violencia obstétrica</option>
                                <option value="Violencia familiar">Violencia familiar</option>
                                <option value="Otra">Otra</option>
                            </select>
                            <br>
                            <button type="submit" class="btn btn-custom btn-add">Agregar</button>
                        </div>
                    </div>
                </form>
                <br>

                <?php
                // Mostrar denuncias
                $a = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                    $a = $a + 1;
                }
                ?>

            </div>

            <!-- Estadisticas -->
            <div class="col-lg-4">
                <div class="stats-section">
                    <h5>Estadísticas</h5>
                    <p>Denuncias recibidas este año: <?php echo $a; ?></p>
                    <canvas id="myChart" width="400" height="200"></canvas>
                    <p>Denuncias totales: <?php echo $cantidad ?></p>
                </div>
                <div class="stats-section">
                    <h5 class="text-danger">
                        Atención
                    </h5>
                    <p>Esta NO es una denuncia oficial, recuerda denunciar ante las autoridades.
                    Tu denuncia servirá para apoyar a otras mujeres y hacer notar que la violencia no es algo de segundo plano.
                    </p>
                </div>

            </div>
        </div>
    </div>

    <script>
        const ctx = document.getElementById('myChart').getContext('2d');
        const chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Sep', 'Oct'],
                datasets: [{
                    label: 'Denuncias',
                    data: [1, 8],
                    backgroundColor: 'rgba(255, 99, 132, 0.2)'
                }]
            },
            options: {}
        });
    </script>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>

</body>

</html>