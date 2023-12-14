<!DOCTYPE html>
<html>

<head>
    <title>Dropdown OnChange Laravel</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <form>
        <div class="form-group">
            <label for="kategori">Kategori:</label>
            <select class="form-control" id="kategori" name="kategori">
                <option value="">Pilih Kategori</option>
                @foreach ($kategori as $item)
                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="klasifikasi">Klasifikasi:</label>
            <select class="form-control" id="klasifikasi" name="klasifikasi">
                <option value="">Pilih Klasifikasi</option>
            </select>
        </div>
    </form>

    <script>
        $(document).ready(function() {
            $('#kategori').on('change', function() {
                var kategoriId = $(this).val();
                if (kategoriId) {
                    $.ajax({
                        type: 'GET',
                        url: '/getKlasifikasi',
                        data: {
                            kategori_id: kategoriId
                        },
                        success: function(data) {
                            $('#klasifikasi').empty();
                            $('#klasifikasi').append('<option value="">Pilih Klasifikasi</option>');
                            $.each(data, function(key, value) {
                                $('#klasifikasi').append('<option value="' + key + '">' + value + '</option>');
                            });
                        }
                    });
                } else {
                    $('#klasifikasi').empty();
                    $('#klasifikasi').append('<option value="">Pilih Klasifikasi</option>');
                }
            });
        });
    </script>
</body>

</html>