<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
    </style>
</head>
<body>
    <h3>Data Kegiatan</h3>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Deskripsi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($activities as $index => $a)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $a->title }}</td>
                    <td>{{ $a->description }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
