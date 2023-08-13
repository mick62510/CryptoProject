@dd($cookieConsentConfig)
@if(!isset($cookieConsentConfig) || !$cookieConsentConfig['enabled'])
    @include('cookie-consent::dialogContents')
    <script>
        window.laravelCookieConsent = (function () {
            function consentWithCookies() {
                hideCookieDialog();
                $.ajax({
                    url: '{{ route('cookie-consent') }}',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': {{csrf_token()}},
                    },
                    success: function (data) {
                        // Succès de la requête
                        console.log('Requête réussie');
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        // Gestion des erreurs
                        console.error('Erreur lors de la requête : ' + errorThrown);
                    }
                });
            }

            function hideCookieDialog() {
                const dialogs = document.getElementsByClassName('cookie-consent');

                for (let i = 0; i < dialogs.length; ++i) {
                    dialogs[i].style.display = 'none';
                }
            }

            const buttons = document.getElementsByClassName('cookie-consent-agree');

            for (let i = 0; i < buttons.length; ++i) {
                buttons[i].addEventListener('click', consentWithCookies);
            }
            return {
                consentWithCookies: consentWithCookies,
                hideCookieDialog: hideCookieDialog
            };
        })();
    </script>

@endif

