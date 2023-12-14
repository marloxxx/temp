@extends('layout.main')
@section('title'){{'Berikan Feedback'}} @endsection
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h2>Feedback</h2>
                </div>
                <div class="card-body">
                    <form method="post" action="/pelaporan/feedback/store" id="myForm" enctype="multipart/form-data">
                        @csrf
                        <input type="text" name="pelaporan_id" hidden readonly value="{{ $pelaporanId }}">
                        <input type="text" name="petugas_id" hidden readonly value="{{ $petugasId }}">
                        <div class="mb-3">
                            <label for="hasil_perbaikan" class="form-label">Hasil Perbaikan<span class="text-danger">*</span></label>
                            <div class="mb-3 row">
                                <div class="col">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="hasil_normal" name="hasil_perbaikan" value="normal">
                                        <label class="form-check-label" for="hasil_normal">Normal</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="hasil_kurang_normal" name="hasil_perbaikan" value="kurang_normal">
                                        <label class="form-check-label" for="hasil_kurang_normal">Kurang Normal</label>
                                    </div>
                                </div>
                            </div>
                            @error('hasil_perbaikan')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="uraian_perbaikan" class="form-label">Uraian Perbaikan<span class="text-danger">*</span></label>
                            <textarea name="uraian_perbaikan" class="form-control" id="uraian_perbaikan" placeholder="Masukkan Uraian Perbaikan" rows="4" required>{{ old('uraian_perbaikan') }}</textarea>
                            @error('uraian_perbaikan')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Kirim</button>
                            <a class="btn btn-success" href="#">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    // Menangani klik pada checkbox untuk memastikan hanya satu yang dicentang
    const checkboxes = document.querySelectorAll('input[name="hasil_perbaikan"]');

    checkboxes.forEach((checkbox) => {
        checkbox.addEventListener('change', function() {
            checkboxes.forEach((otherCheckbox) => {
                if (otherCheckbox !== checkbox) {
                    otherCheckbox.checked = false;
                }
            });
        });
    });
</script>
@endsection