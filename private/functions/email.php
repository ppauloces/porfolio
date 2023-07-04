<?php 

// Importar as classes 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
// Carregar o autoloader do composer
require '../vendor/autoload.php';
// Instância da classe
$mail = new PHPMailer(true);
try
{
    // Configurações do servidor
    $mail->isSMTP();        //Devine o uso de SMTP no envio
    $mail->SMTPAuth = true; //Habilita a autenticação SMTP
    $mail->Username   = 'ppaulo.developer@gmail.com';
    $mail->Password   = 'iwpeuzfokskkdmnf';
    // Criptografia do envio SSL também é aceito
    $mail->SMTPSecure = 'tls';
    // Informações específicadas pelo Google
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    // Define o remetente
    $mail->SetFrom('ppaulo.developer@gmail.com', 'PAULO AMARAL');
    // Define o destinatário
    $mail->AddAddress($_POST['email'], $_POST['nome']);
    // Conteúdo da mensagem
    $mail->isHTML(true);  // Seta o formato do e-mail para aceitar conteúdo HTML
    $mail->Subject = 'Contato - PAULO AMARAL';
    $mail->Body    = 
    '<h4>Olá ' . $_POST['nome'] . ',</h4>' .

    '<p>Venho agradecer pelo seu interesse em meu trabalho, isso me incentiva a continuar fazendo o que eu amo fazer. Não se preocupe, logo logo entro em contato com você 😉</p>';
    $mail->AltBody = 'Olá' . $_POST['nome'] . ' Venho agradecer pelo seu interesse em meu trabalho, isso me incentiva a continuar fazendo o que eu amo fazer. Não se preocupe, logo logo entro em contato com você 😉';
    // Enviar
    $mail->send();

    if ($mail->Send()) {

    	$mail->ClearAllRecipients();
    	$mail->ClearAttachments();
    	echo "<script>
    	Swal.fire({
    		icon: 'success',
    		title: 'Email enviado! Não se preocupe, entrarei em contato com você',
    		showConfirmButton: false,
    		timer: 2000
    	});</script>";

        // Inserir registro no banco de dados
    	$servername = "localhost";
    	$username = "root";
    	$password = "";
    	$dbname = "paulo";

        // Criar conexão PDO
    	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Preparar a consulta SQL
    	$stmt = $conn->prepare("INSERT INTO contatos (nome, email, telefone) VALUES (:nome, :email, :telefone)");

        // Bind dos parâmetros
    	$stmt->bindParam(':nome', $_POST['nome']);
    	$stmt->bindParam(':email', $_POST['email']);
    	$stmt->bindParam(':telefone', $_POST['telefone']);

        // Executar a consulta
    	$stmt->execute();

        // Fechar a conexão com o banco de dados
    	$conn = null;
    }

    
}
catch (Exception $e)
{
	echo "<script>
	Swal.fire({
		icon: 'error',
		title: 'Oops...',
		text: 'Ocorreu um erro ao enviar sua mensagem. Tente novamente mais tarde.'
		});
		</script>";
		die();
	}


