<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Document</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>
<body class="dark:bg-slate-800 text-slate-300">
    <script>
        function confirmDelete(event) {
            event.preventDefault();
            if (confirm('Are you sure you want to delete this task?')) {
                event.target.submit();
            } else {
                return false;
            }
        }
    </script>
    <div class="flex justify-center">
        <div class="flex flex-col justify-center items-center mt-40 max-w-4xl gap-1">
            {{$slot}}
        </div>
    </div>
</body>
</html>
