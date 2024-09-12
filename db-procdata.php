<?php
// Inclua o arquivo de conexão com o banco de dados
include("db-process.php");

// Função para limpar os dados
function sanitize_input($data) {
    return htmlspecialchars(trim($data));
}

// Captura e sanitiza os dados do formulário
$nome = sanitize_input($_POST["nome"]);
$data_nascimento = sanitize_input($_POST["data_nascimento"]);
$email = sanitize_input($_POST["email"]);
$telefone = sanitize_input($_POST["telefone"]);
$cep = sanitize_input($_POST["cep"]);
$rua = sanitize_input($_POST["rua"]);
$numero = sanitize_input($_POST["numero"]);
$bairro = sanitize_input($_POST["bairro"]);
$cidade = sanitize_input($_POST["cidade"]);
$estado = sanitize_input($_POST["estado"]);
$complemento = sanitize_input($_POST["complemento"]);
$assunto = sanitize_input($_POST["assunto"]);
$mensagem = sanitize_input($_POST["mensagem"]);
$senha = sanitize_input($_POST["senha"]);
$cpf = sanitize_input($_POST["cpf"]);
$rg = sanitize_input($_POST["rg"]);

// Validação dos dados
$errors = [];
if (empty($nome)) {
    $errors[] = "O nome é obrigatório.";
}
if (!preg_match("/^\d{4}-\d{2}-\d{2}$/", $data_nascimento)) {
    $errors[] = "Data de nascimento inválida. Use o formato YYYY-MM-DD.";
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "E-mail inválido.";
}
if (!preg_match("/^\d{11}$/", $telefone)) {
    $errors[] = "Telefone inválido. Deve conter 11 dígitos.";
}
if (!preg_match("/^\d{11}$/", $cpf)) {
    $errors[] = "CPF inválido. Deve conter 11 dígitos.";
}
if (!preg_match("/^\d+$/", $rg)) {
    $errors[] = "RG inválido. Deve conter apenas números.";
}
if (strlen($senha) < 6) {
    $errors[] = "A senha deve ter pelo menos 6 caracteres.";
}

if (!empty($errors)) {
    foreach ($errors as $error) {
        echo "<p>$error</p>";
    }
    exit;
}

// Hash da senha
$senha_hash = password_hash($senha, PASSWORD_DEFAULT);

// Prepara a declaração SQL
$sql = "INSERT INTO usuario (nome, data_nascimento, email, telefone, cep, rua, numero, bairro, cidade, estado, complemento, assunto, mensagem, senha, cpf, rg) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die("Erro na preparação da declaração: " . $conn->error);
}

// Bind dos parâmetros
$stmt->bind_param("sssssssssssssss", $nome, $data_nascimento, $email, $telefone, $cep, $rua, $numero, $bairro, $cidade, $estado, $complemento, $assunto, $mensagem, $senha_hash, $cpf, $rg);

// Executa a declaração
if ($stmt->execute()) {
    echo "Cadastro realizado com sucesso!";
} else {
    echo "Erro ao realizar o cadastro: " . $stmt->error;
}

// Fecha a conexão
$stmt->close();
$conn->close();
?>
