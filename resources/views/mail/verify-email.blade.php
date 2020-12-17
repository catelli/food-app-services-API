<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sucesso</title>
</head>

<style>
    body {
        margin: 0;
    }
    main {
        font-family: roboto;
        font-size: 1rem;
        background: #db3445;
        
        width: 100vw;
        height: 100vh;
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center
    }

    main > div {
        text-align: center;
        color: #db3445;
        background: #eee;
        padding: 20px;
        border-radius: 6px;
        margin: 20px;
    }
</style>

<body>
    <main>
        <div>
            <h1>Pronto, {{ $nome }} :)</h1>
            <p>Faça login para usar o aplicativo</p>
        </div>
    </main>
</body>
</html>