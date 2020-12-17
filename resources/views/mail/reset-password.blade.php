<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nova senha</title>
</head>

<style>
    body {
        margin: 0;
    }
    main {
        font-family: roboto;
        font-size: 16px;
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

    input, button {
        border: 0;
        outline: none;
        border-radius: 5px;
        box-sizing: border-box;
        cursor: pointer;
        font-size: 14px;
        font-weight: bold;
        padding: 12px 25px;
        text-decoration: none;
        text-transform: capitalize; 
    }

    input {
        background: #fff;
        color: #666;
    }

    button {
        background: #db3445;
        color: #fff;
        margin: 10px 0;
    }
</style>

<body>
    <main>
        <div>
            <h2>Preencha com sua nova senha</h2>
            <form method="POST" action="{{ route('resetpassword') }}">
                <input type="hidden" name="email" value="{{$email}}">
                <input type="password" name="password" required>

                <button type="submit">
                    Enviar
                </button>
            </form>

            
        </div>
    </main>
</body>
</html>