<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone-min.js"></script>
    <link href="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone.css" rel="stylesheet" type="text/css" />
</head>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 ">
            {{ __('Pliki') }}
        </h2>
    </x-slot>

    <body style='display:block;'>
        <div class="py-12 d-flex justify-content-center ">
            <div>
                <div class="bg-white shadow-xl sm:rounded-lg">
                    <div class="d-flex justify-content-center">
                        Tutaj są twoje pliki
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-white shadow-xl sm:rounded-lg">
            @php
            $user = auth()->id();
            foreach ($files as $files){
            $path = 'pliki/'.$user.'/'.$files->file_name;
            $exist = Storage::disk('s3')->has($path);
            if ($exist == true){
            $url = Storage::disk('s3')->URL($path);
            echo "<a href='".$url."'>".$files->file_name."</a>";}
        };
            @endphp
        </div>
    </body>
</x-app-layout>