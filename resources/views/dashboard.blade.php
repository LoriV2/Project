<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone-min.js"></script>
    <link href="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone.css" rel="stylesheet" type="text/css" />
</head>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 ">
            {{ __('Przesyłanie') }}
        </h2>
    </x-slot>

    <body style='display:block;'>
        <div class="py-12 d-flex justify-content-center ">
            <div>
                <div class="bg-white shadow-xl sm:rounded-lg">
                    <div class="d-flex justify-content-center">
                        Wrzuć tutaj swoje pliki
                    </div>

                    <p class="card-text">
                    <form method='POST'>
                        <input class='mt-6 py-6' style='width:80%px; height:80%; border:solid 1px black;' type="file" name="file" />
                        <div class="d-flex justify-content-center">

                            <button style='color:black; margin-top:10px;' class='btn btn-secondary' type="submit">Prześlij plik</button>
                        </div>
                    </form>
                    </p>


                </div>

            </div>

        </div>
    </body>
</x-app-layout>