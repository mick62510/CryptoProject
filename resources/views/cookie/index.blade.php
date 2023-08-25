@extends('layout')
@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{route('home')}}">Home</a>
    </li>
    <li class="breadcrumb-item active">Cookie
@endsection
@section('content')
    <section class="row">
        <div class="col-12">
            <h2 class="h2">Cookie</h2>
            <div class="card">
                <div class="card-content">
                    <div class="card-header">
                        <div class="card-title font-large-1">
                            Politique de Cookies de Trading-Journal
                        </div>
                    </div>
                    <div class="card-body">

                        <p class="font-medium-5">Dernière mise à jour : 25/08/2023</p>
                        <p>
                        La présente Politique de Cookies explique comment Trading-Journal utilise des cookies et des technologies similaires sur notre site web www.trading-journal.com . Cette politique détaille les types de cookies que nous utilisons, pourquoi nous les utilisons, et comment vous pouvez gérer vos préférences en matière de cookies.
                        </p>
                        <p  class="font-medium-5">
                        Qu'est-ce qu'un cookie ?
                        </p>
                        <p>
                        Un cookie est un petit fichier texte placé sur votre ordinateur ou appareil mobile lorsque vous visitez un site web. Les cookies permettent au site web de se souvenir de vos actions et préférences (comme la connexion, la langue, la taille de la police et d'autres préférences d'affichage) sur une période donnée, vous évitant ainsi de devoir les saisir à chaque visite.
                        </p>
                        <p  class="font-medium-5">
                        Comment utilisons-nous les cookies ?
                        </p>
                        <p>
                        Nous utilisons différents types de cookies pour diverses raisons, notamment :
                        </p>
                        <p>
                        Cookies nécessaires : Ces cookies sont essentiels au bon fonctionnement du Site. Ils vous permettent de naviguer sur le Site et d'utiliser ses fonctionnalités, telles que l'accès à des zones sécurisées du Site.
                        </p>
                        <p>
                        Cookies de performance : Ces cookies nous aident à analyser la manière dont les visiteurs interagissent avec le Site en collectant des informations anonymes et agrégées. Cela nous permet d'améliorer continuellement le Site et votre expérience de navigation.
                        </p>
                        <p>
                        Cookies de fonctionnalité : Ces cookies permettent au Site de se souvenir des choix que vous avez faits (comme votre nom d'utilisateur, votre langue ou votre région) et de fournir des fonctionnalités améliorées et personnalisées.
                        </p>
                        <p>
                        Cookies de ciblage ou publicitaires : Ces cookies sont utilisés pour diffuser des publicités plus pertinentes pour vous et vos intérêts. Ils sont également utilisés pour limiter le nombre de fois que vous voyez une publicité et pour mesurer l'efficacité des campagnes publicitaires.
                        </p>
                        <p  class="font-medium-5">
                        Comment gérer les cookies ?
                        </p>
                        <p>
                        En utilisant le Site, vous consentez à l'utilisation des cookies conformément à cette Politique de Cookies. Si vous le souhaitez, vous pouvez modifier les paramètres de votre navigateur pour refuser certains cookies ou pour être informé lorsque des cookies sont envoyés sur votre appareil. Cependant, veuillez noter que certaines parties du Site peuvent ne pas fonctionner correctement si vous désactivez les cookies.
                        </p>
                        <p>
                        Pour en savoir plus sur la manière de gérer les cookies, veuillez consulter les paramètres d'aide de votre navigateur.
                        </p>
                        <p  class="font-medium-5">
                        Contactez-nous
                        </p>
                        <p>
                        Si vous avez des questions concernant notre utilisation des cookies ou si vous avez besoin d'assistance, veuillez nous contacter à site.trading.journal@gmail.com.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </section>

@endsection

@push('js')
    @vite('resources/js/form-file.js')
@endpush
