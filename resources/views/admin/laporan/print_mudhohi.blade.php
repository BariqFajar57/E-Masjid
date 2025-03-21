<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
        integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>

<body>
    <header>
        <div class="row">
            <div class="col-md-3">
                <img src="{{ public_path() . '/assets/img/mosque.png' }}" alt="" srcset=""
                    style="width: 100px; height: 100px">
            </div>
            <div class="col-md-8 text-center">
                <h2>DEWAN KEMAKMURAN MASJID <br>AL-IKHLASH</h2>
                <p>Perumahan Cimareme Indah-Desa Cimareme Bandung Barat 40552</p>
            </div>
        </div>
        <hr style="border: 5px solid black; margin-top: -100px">
        <hr style="border: 1px solid black" class="mt-n2">
    </header>
    <table class="table table-bordered mt-4">
        <thead class="text-center table-success">
            <tr>
                <th class="align-middle">{{ $id_master_hewan == 1 ? 'Sapi' : 'Kambing' }} Ke</th>
                <th class="align-middle">Nama</th>
                <th class="align-middle">Alamat</th>
                <th class="align-middle">Kontak</th>
                <th class="align-middle">Permintaan Daging Qurban</th>
                <th class="align-middle">Tanggal Pendaftaran</th>
            </tr>
        </thead>
        <tbody class="text-center">
            @foreach ($data as $item)
                <tr>
                    <td>{{ $item->qurban->antrian }}</td>
                    <td>{{ $item->atasNama }}</td>
                    <td>{{ $item->user->alamat }}</td>
                    <td>{{ $item->user->kontak }}</td>
                    <td>{{ $item->permintaan_daging }} Bungkus</td>
                    <td>{{ date_format($item->created_at, 'd M Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
