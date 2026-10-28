<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tailwind CSS v4 Test</title>
</head>
<body class="min-h-screen bg-background text-foreground">

    <div class="max-w-md mx-auto p-6">
        <h1 class="text-3xl font-bold mb-4">Tailwind CSS v4 Working!</h1>
        
        <p class="text-muted">This is a test paragraph with theme variables.</p>
        
        <button class="btn-primary">Primary Button</button>
        <button class="btn-secondary mr-2">Secondary Button</button>
        
        <div class="card my-6">
            <p class="text-lg">This is a card with Tailwind v4 styling.</p>
        </div>
    </div>

    <!-- Dark mode test -->
    <div class="dark:bg-dark dark:text-dark-foreground">
        <p class="bg-background p-4">Test dark mode area</p>
    </div>

</body>
</html>