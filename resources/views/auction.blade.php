<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Auction</title>
    <script src="{{ asset('https://telegram.org/js/telegram-web-app.js') }}"></script>
    <script>
        const tg = window.Telegram.WebApp;
        tg.ready();
        tg.expand();
    </script>
</head>
<body>
<div class="wrapper bg-color text-color" id="app"></div>
@vite('resources/js/auction.jsx')
<script>

</script>
</body>
</html>
