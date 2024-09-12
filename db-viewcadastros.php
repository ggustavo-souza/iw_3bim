<?php
// Inclua o arquivo de conexão com o banco de dados
include("db-process.php");

// Prepara a consulta SQL para selecionar todos os registros da tabela
$sql = "SELECT id, nome, data_nascimento, email, telefone, cep, rua, numero, bairro, cidade, estado, complemento, assunto, mensagem, cpf, rg FROM usuario";
$result = $conn->query($sql);

if (!$result) {
    die("Erro na consulta: " . $conn->error);
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bs/css/bootstrap.min.css">
    <title>Visualizar Cadastros</title>
</head>
<body>
    <nav class="navbar justify-content-center bg-dark"> <!-- navbar -->
        <p class="fw-bold text-white fs-3 mt-1">Visualizar Cadastros</p>
    </nav>

    <div class="container mt-5">
        <h2 class="mb-4">Lista de Cadastros</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Data de Nascimento</th>
                    <th>E-mail</th>
                    <th>Telefone</th>
                    <th>CEP</th>
                    <th>Rua</th>
                    <th>Número</th>
                    <th>Bairro</th>
                    <th>Cidade</th>
                    <th>Estado</th>
                    <th>Complemento</th>
                    <th>Assunto</th>
                    <th>Mensagem</th>
                    <th>CPF</th>
                    <th>RG</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Verifica se há resultados
                if ($result->num_rows > 0) {
                    // Exibe os dados de cada linha
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['nome']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['data_nascimento']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['telefone']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['cep']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['rua']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['numero']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['bairro']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['cidade']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['estado']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['complemento']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['assunto']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['mensagem']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['cpf']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['rg']) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='16'>Nenhum cadastro encontrado</td></tr>";
                }

                // Fecha a conexão
                $result->free();
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
