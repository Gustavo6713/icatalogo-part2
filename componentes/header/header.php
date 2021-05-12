<?php
session_start();
?>

<link href="/Web-backend/icatalogo-part2/componentes/header/header.css" rel="stylesheet"/>
<header class="header">
    <figure>
        <img src="/Web-backend/icatalogo-part2/imgs/logo.png"/>
    </figure>
    <input type="search" placeholder="Pesquisar" />
    <?php
    if (!isset($_SESSION["usuarioId"])) {
    ?>
        <nav>
            <ul>
                <a id="menu-admin">Administrador</a>
            </ul>
        </nav>
        <div id="container-login" class="container-login">
            <h1>Fazer Login</h1>
            <form method="POST" action="/Web-backend/icatalogo-part2/componentes/header/acoesLogin.php">
                <input type="hidden" name="acao" value="login" />
                <input type="text" name="usuario" placeholder="Usuário" />
                <input type="password" name="senha" placeholder="Senha" />
                <button>Entrar</button>
            </form>
        </div>
    <?php
    } else {
    ?>
        <nav>
            <ul>
                <a id="menu-admin" onclick="logout()">Sair</a>
            </ul>
        </nav>
        <form id="form-logout" style="display: none" method="POST" action="/Web-backend/icatalogo-part2/componentes/header/acoesLogin.php">
            <input type="hidden" name="acao" value="logout"/>
        </form>
    <?php
    }
    ?>
</header>
<script lang="javascript">
    function logout(){
        document.querySelector("#form-logout").submit();
    }

    document.querySelector("#menu-admin").addEventListener("click", toggleLogin);

    function toggleLogin() {
        let containerLogin = document.querySelector("#container-login");
        let formContainer = document.querySelector("#container-login > form");
        let h1Container = document.querySelector("#container-login > h1");
        //quando oculto 
        if (containerLogin.style.opacity == 0) {
            formContainer.style.display = "flex";
            h1Container.style.display = "block";
            containerLogin.style.opacity = 1;
            containerLogin.style.height = "200px";
        } else {
            formContainer.style.display = "none";
            h1Container.style.display = "none";
            containerLogin.style.opacity = 0;
            containerLogin.style.height = "0px";
        }
    }
</script>