<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contrat No{{$contrat->reference}}</title>
    <!-- Bootstrap 5 CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <p class="text-center">{{ $contrat->titre }}</p>
    <p>
        {!! $contrat->contenu !!}
    </p>
</body>
</html>