<!DOCTYPE html>
<html>
<head>
	<title>ADMIN</title>
	<!--Import Google Icon Font-->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<!--Import materialize.css-->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">	
	<link rel="stylesheet" type="text/css" href="assets/style.css">
	<!--Let browser know website is optimized for mobile-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>

<body>
	<nav>
		<div class="nav-wrapper bg-color">
			<a href="#" class="brand-logo" style="padding-left: 10px;">PAULO AMARAL</a>
		</div>
	</nav>

	<main>
		<div class="container">
			<table>
				<thead>
					<tr>
						<th>Nome</th>
						<th>Email</th>
						<th>Telefone</th>
						<th>Whatsapp</th>
					</tr>
				</thead>

				<tbody>
					<?php
            // Configurações de conexão com o banco de dados
					$servername = "localhost";
					$username = "root";
					$password = "";
					$dbname = "paulo";

					try {
                // Criar conexão PDO
						$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
						$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // Consulta SQL para obter todos os registros da tabela
						$stmt = $conn->query("SELECT * FROM contatos");

                // Loop através dos resultados
						foreach ($stmt as $row) {
							echo "<tr>";
							echo "<td>" . $row['nome'] . "</td>";
							echo "<td>" . $row['email'] . "</td>";
							echo "<td>" . $row['telefone'] . "</td>";
							echo "<td><a style='color:green' href='https://api.whatsapp.com/send?phone=" . $row['telefone'] . "' target='_blank'><span class='material-icons'>
							add_ic_call
							</span></a></td>";
							echo "</tr>";
						}

                // Fechar a conexão com o banco de dados
						$conn = null;
					} catch (PDOException $e) {
						echo "Erro: " . $e->getMessage();
					}
					?>
				</tbody>
			</table>
		</div>
	</main>


	<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
</body>
</html>