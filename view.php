<?php
    function formatDateTime($date_time)
    {
        list($date, $time) = explode(' ', $date_time);
        list($aaaa, $mm, $dd) = explode('-', $date);
        $formated_date_time = $dd."/".$mm."/".$aaaa." ".$time;

        return $formated_date_time;
    }

    $servername = "localhost";
    $username = "digsa";
    $password = "n73dXwF!fQpV";
    $dbname = "digsa";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	$conn->set_charset("utf8");
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Digsa</title>
        <link href="favicon.png" rel="shortcut icon" />
        <script src="https://code.jquery.com/jquery-latest.min.js"></script>
        <script src="https://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>

        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css"/>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css"/>

        <style>
            *
            {
                font-family: verdana;
                margin: 0;
            }

            h1
            {
                text-align: center;
                font-size: 18px;
                color: #555;
                margin-top: 20px;
                margin-bottom: 20px;
            }

            .c
            {
                margin: 25px;
            }

            table
            {
                font-weight: normal !important;
                font-size: 12px !important;
            }
        </style>
    </head>

    <body>
        <h1>Contactos</h1>
        <div class="c">
            <table id="contacts" class="display" style="text-align: center;">
                <thead>
                    <tr>
                        <th>NOMBRE</th>
                        <th>EMAIL</th>
                        <th>TELÉFONO</th>
                        <th>FECHA</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql = "SELECT * FROM contact ORDER BY id DESC";
                        $result = $conn->query($sql);

                        while($row = $result->fetch_assoc())
                        {
                            echo '<tr>';
                                echo '<th>'.$row["name"].'</th>';
                                echo '<th>'.$row["email"].'</th>';
                                echo '<th>'.$row["phone"].'</th>';
                                echo '<th>'.formatDateTime($row["created_at"]).'</th>';
                            echo '</tr>';
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </body>
    <script>
		$(document).ready( function () {
		    $('#contacts').DataTable({
		    	"language": {
		            "lengthMenu": "Mostrar _MENU_",
		            "zeroRecords": "No hay resultados",
		            "info": "Página _PAGE_ de _PAGES_",
		            "infoEmpty": "No hay resultados disponibles",
		            "infoFiltered": "(Filtrado de _MAX_ records totales)",
		            "search": "Buscar",
		            "oPaginate": {
				        "sFirst":    "Primero",
				        "sLast":     "Último",
				        "sNext":     "Siguiente",
				        "sPrevious": "Anterior"
				    }
		        },
                aLengthMenu: [
                    [25, 50, 100, 200, -1],
                    [25, 50, 100, 200, "All"]
                ],
                iDisplayLength: -1,
                "dom": 'Bfrtip',
                "buttons": [
                    'csv', 'excel'
                ]
            });
            
            $('.dt-buttons').css('padding-top', '15px');
            $('.dt-buttons').css('padding-left', '25px');
            $('.dataTables_info').css('margin-left', '25px');
            $('.dataTables_paginate.paging_simple_numbers').css('margin-right', '25px');
        });
	</script>
</html>