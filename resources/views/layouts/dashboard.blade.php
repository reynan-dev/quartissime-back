<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard - Quartissime</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">


</head>

<body>

    <nav class="sidebar">
        <ul>
            <li>Gérer Associations</li>
            <li>Gérer Évenements</li>
            <li>Edit Comité</li>
        </ul>
    </nav>

    <div class="content">
        <section class="newRequest">
            <h3>Nouvelles associations à accepter</h3>
        </section>

        <section class="associations">
            <h3>Toutes les associations inscripts</h3>
            @yield('associations')
        </section>

        <section class="events">
            <h3>Les prochaines évenements</h3>
            @yield('events')
        </section>
    </div>

</body>

</html>
