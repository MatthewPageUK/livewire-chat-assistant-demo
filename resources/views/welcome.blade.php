@use('App\Enums\ChatAssistantMode')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Matthew Page - Livewire Demo Chat Assistant</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=atma:300,400,500,600,700&display=swap" rel="stylesheet" />
        <link href="https://fonts.bunny.net/css?family=almarai:300,400,700,800&display=swap" rel="stylesheet" />

        @vite('resources/css/app.css')
    </head>
    <body class="font-sans antialiased bg-primary-800 text-primary-100">

        <div class="w-full max-w-7xl mx-auto h-[700px] grid grid-rows-2 gap-4">
            <livewire:chat-assistant />
            <livewire:chat-assistant :mode="ChatAssistantMode::Assistant" />
        </div>

    </body>
</html>
