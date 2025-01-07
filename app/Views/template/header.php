<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KyZXEJGo+4fZzX39H3phTe9mYxtFOQtU5gjpYwHeaQwETtct7sk9YrZpD0PUlrlp" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-light bg-light container">
        <div class="container-fluid">
            <a class="navbar-brand" href="/auth/logout">
                Log Out
            </a>
        </div>
    </nav>



    <?= $this->renderSection('content') ?>