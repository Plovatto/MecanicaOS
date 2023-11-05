<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil do Usuário</title>
</head>
<body>
    <h1>Perfil do Usuário</h1>

    <table>

<tr><label>Codigo</label>
    <p><?=esc($perfil->id)?></p>
    <label>Nome</label>
    <p><?=esc($perfil->nome_completo)?></p>
    <label>Email</label>
    <p><?=esc($perfil->email)?></p>
    <label>Endereço</label>
    <p><?=esc($perfil->endereco)?></p>
    <label>Cpf</label>
    <p><?=esc($perfil->cpf)?></p>
    <label>Tipo</label>
    <p><?=esc($perfil->tipo)?></p>
    <label>Status :</label>
    <p><?=esc($perfil->status)?></p>
    <label>Especialidade</label>
    <p><?=esc($perfil->especialidade_nome)?></p>


</tr>


    </table>



    <a href="/logout">Logout</a>
<button><a href="/orders">home</a></button>
</body>
</html>
