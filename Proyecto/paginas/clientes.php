<?php
$mysqli = new mysqli('localhost', 'root', '', 'proyecto_arqui', 3306);
if ($mysqli->connect_errno) {
    // La conexión falló. ¿Que vamos a hacer?
    // Se podría contactar con uno mismo (¿email?), registrar el error, mostrar una bonita página, etc.
    // No se debe revelar información delicada

    // Probemos esto:
    echo "Lo sentimos, este sitio web está experimentando problemas.";

    // Algo que no se debería de hacer en un sitio público, aunque este ejemplo lo mostrará
    // de todas formas, es imprimir información relacionada con errores de MySQL -- se podría registrar
    echo "Error: Fallo al conectarse a MySQL debido a: \n";
    echo "Errno: " . $mysqli->connect_errno . "\n";
    echo "Error: " . $mysqli->connect_error . "\n";

    // Podría ser conveniente mostrar algo interesante, aunque nosotros simplemente saldremos
    exit;
}

$sql = "SELECT * FROM clientes";
if (!$resultado = $mysqli->query($sql)) {
    // ¡Oh, no! La consulta falló.
    echo "Lo sentimos, este sitio web está experimentando problemas.";

    // De nuevo, no hacer esto en un sitio público, aunque nosotros mostraremos
    // cómo obtener información del error
    echo "Error: La ejecución de la consulta falló debido a: \n";
    echo "Query: " . $sql . "\n";
    echo "Errno: " . $mysqli->errno . "\n";
    echo "Error: " . $mysqli->error . "\n";
    exit;
}
?>

<div class="content">
  <div class="row">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title"> Simple Table</h4>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table id="tabla_clientes" class="table">
              <thead class=" text-primary">
                <th>
                  Nombre
                </th>
                <th>
                  Apellido
                </th>
                <th>
                  Email
                </th>
                <th>
                  Tarjeta
                </th>
                <th>
                  Telèfono
                </th>
                <th>
                  Acciones
                </th>
              </thead>
              <tbody>
            <?php

            if ($resultado->num_rows === 0) {
                // ¡Oh, no ha filas! Unas veces es lo previsto, pero otras
                // no. Nosotros decidimos. En este caso, ¿podría haber sido
                // actor_id demasiado grande?
                echo "Lo sentimos. No hubo un resultado al ralizar la consulta.";
            } else {
              while ($cliente = $resultado->fetch_assoc()) {
              ?>
                <tr>
                  <td>
                    <?= $cliente["nombre"] ?>
                  </td>
                  <td>
                    <?= $cliente["apellido"] ?>
                  </td>
                  <td>
                    <?= $cliente["email"] ?>
                  </td>
                  <td>
                    <?= $cliente["tarjeta"] ?>
                  </td>
                  <td>
                    <?= $cliente["telefono"] ?>
                  </td>
                  <td>
                    <?php echo
                    '<button class="btn btn-danger btn-fab btn-icon" onclick="confirma_eliminar('.$cliente["id_cliente"].')" data-toggle="tooltip" title="Eliminar">
                      <i class="nc-icon nc-simple-remove"></i>
                    </button>
                    <button class="btn btn-primary btn-fab btn-icon" onclick="preparar_editar('."'".$cliente["nombre"]."'".', '."'".$cliente["apellido"]."'".', '."'".$cliente["email"]."'".', '."'".$cliente["telefono"]."'".', '."'".$cliente["tarjeta"]."'".
                    ')"  data-toggle="tooltip" title="Actualizar">
                      <i class="nc-icon nc-settings"></i>
                    </button>'; ?>
                  </td>
                </tr>

          <?php }
            } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card card-user">
        <div class="card-header">
          <h5 class="card-title">Clientes</h5>
        </div>
        <div class="card-body">
          <form>
            <div class="row">
              <div class="col-md-6 pr-1">
                <div class="form-group">
                  <label>Nombre</label>
                  <input id="campo_nombre" type="text" class="form-control" placeholder="Nombre" value="Nombre">
                </div>
              </div>
              <div class="col-md-6 px-1">
                <div class="form-group">
                  <label>Apellido</label>
                  <input id="campo_apellido" type="text" class="form-control" placeholder="Apellido" value="Apellido">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 pr-1">
                <div class="form-group">
                  <label>Email</label>
                  <input id="campo_email" type="email" class="form-control" placeholder="alguien@correo.com" value="Correo">
                </div>
              </div>
              <div class="col-md-6 px-1">
                <div class="form-group">
                  <label>Telèfono</label>
                  <input id="campo_telefono" type="number" class="form-control" placeholder="88888888">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Tarjeta</label>
                  <input id="campo_tarjeta" type="text" class="form-control" placeholder="XXXX-XXXX-XXXX-XXXX">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="update ml-auto mr-auto">
                <button id="btn_guardar" class="btn btn-primary btn-round">Guardar</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready( function () {
  $('#tabla_clientes').DataTable();
  document.getElementById('btn_guardar').onclick= function(){
    agregar();
  }
} );

function agregar(){
  nombre = document.getElementById("campo_nombre").value;
  apellido = document.getElementById("campo_apellido").value;
  email = document.getElementById("campo_email").value;
  telefono = document.getElementById("campo_telefono").value;
  tarjeta = document.getElementById("campo_tarjeta").value;


  var formData = new FormData(),
  xhr = new XMLHttpRequest();
  xhr.responseType = 'text';


  xhr.onerror = function () {
    menu('paginas/clientes.php',0,3);
  };

  xhr.onload = function() {
  if (this.status == 200) {
    // Note: .response instead of .responseText

    menu('paginas/clientes.php',0,3);
  }
  else{
    menu('paginas/clientes.php',0,3);
  }
};

formData.append('nombre', nombre);
formData.append('apellido', apellido);
formData.append('email', email);
formData.append('telefono', telefono);
formData.append('tarjeta', tarjeta);

xhr.open('POST', 'paginas/ajax/ajax_agregar_cliente.php', true);
xhr.send(formData);
}

function preparar_editar(id_cliente, nombre, apellido, email, telefono, tarjeta){
  document.getElementById("campo_nombre").value = nombre;
  document.getElementById("campo_apellido").value = apellido;
  document.getElementById("campo_email").value = email;
  document.getElementById("campo_telefono").value = telefono;
  document.getElementById("campo_tarjeta").value = tarjeta;
  document.getElementById('btn_guardar').onclick= function(){
    editar(id_cliente);
  }
}

function editar(id_cliente){
  nombre = document.getElementById("campo_nombre").value;
  apellido = document.getElementById("campo_apellido").value;
  email = document.getElementById("campo_email").value;
  telefono = document.getElementById("campo_telefono").value;
  tarjeta = document.getElementById("campo_tarjeta").value;


  var formData = new FormData(),
  xhr = new XMLHttpRequest();
  xhr.responseType = 'text';


  xhr.onerror = function () {
    menu('paginas/clientes.php',0,3);
  };

  xhr.onload = function() {
    if (this.status == 200) {
      // Note: .response instead of .responseText

      menu('paginas/clientes.php',0,3);
    }
    else{
      menu('paginas/clientes.php',0,3);
    }
  };

  formData.append('id_cliente', id_cliente);
  formData.append('nombre', nombre);
  formData.append('apellido', apellido);
  formData.append('email', email);
  formData.append('telefono', telefono);
  formData.append('tarjeta', tarjeta);

  xhr.open('POST', 'paginas/ajax/ajax_actualizar_cliente.php', true);
  xhr.send(formData);
}
</script>

<?php
$resultado->free();
$mysqli->close();
?>
