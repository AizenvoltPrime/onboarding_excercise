<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Document</title>
</head>
<body class="dark:bg-slate-800 text-slate-300">
    <div class="flex justify-center">
        <div class="flex flex-col justify-center items-center mt-40 max-w-4xl gap-1">
            {{$slot}}
        </div>
    </div>
</body>
</html>
