<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard - Quartissime</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

    <script src="https://kit.fontawesome.com/be8a57ad27.js" crossorigin="anonymous"></script>

</head>

<body>

    <nav class="sidebar">
        <ul>
            <li><a href="">Gérer Associations</a></li>
            <li><a href="">Gérer Évenements</a></li>
            <li><a href="">Edit Comité</a></li>
        </ul>
    </nav>

    <div class="content">
        <section class="newRequest">
            <div class="head">
                <h3>Nouvelles associations à accepter</h3>
                <a href="">
                    <button class="accept">
                        <i class="fa-solid fa-check"></i> Accepté toute les associations
                    </button>
                </a>
            </div>

            <ul>
                @yield('newAssociations')
            </ul>
        </section>

        <section class="associations">
            <div class="head">
                <h3>Les associations enregistrées</h3>
                <a href="">
                    <button class="create">
                        <i class="fa-solid fa-plus"></i> Nouvelle Association
                    </button></a>
            </div>

            <ul>
                @yield('associations')
            </ul>
        </section>

        <section class="events">
            <div class="head">
                <h3>Les prochaines évenements</h3>
                <a href="{{ route('events.create')}}">
                    <button class="create">
                        <i class="fa-solid fa-plus"></i> Nouveau Évenement
                    </button>
                </a>
            </div>
            <ul>
                @yield('events')
            </ul>
        </section>
    </div>

</body>

</html>
