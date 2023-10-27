@extends('services.layouts.index')

@section('container')
    <div>
        <div class="border rounded p-4 mt-3" id="form-group-${formCount}">
            <h3>Mata Kuliah 1</h3>
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="location">Lokasi Penelitian<sup>*</sup></label>
                        <select name="location${formCount}" id="location" class="form-control" required>
                        </select>
                        <small class="form-text text-muted">example: Kebun Raya</small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="personnel">Jumlah Mahasiswa<sup>*</sup></label>
                        <input type="number" name="personnel${formCount}" class="form-control" id="personnel"
                            placeholder="Jumlah Mahasiswa" required>
                        <small class="form-text text-muted">example: 12</small>
                        <span id="personnel_error"
                            class="text-danger fst-italic fw-lighter error-text personnel${formCount}_error"></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="practicum_supervisor">Dosen Penanggung Jawab Praktikum<sup>*</sup></label>
                        <input type="text" class="form-control" id="practicum_supervisor"
                            name="practicum_supervisor${formCount}" placeholder="Dosen Penanggung Jawab Praktikum" required>
                        <small class="form-text text-muted">example: Andre Febrianto, S.Kom., M.Eng.</small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="assistant">Nama Asisten<sup>*</sup></label>
                        <input type="text" class="form-control" id="assistant" name="assistant${formCount}1"
                            placeholder="Nama Asisten" required>
                        <small class="form-text text-muted">example: Ahmad Agung</small>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="subject">Mata Kuliah<sup>*</sup></label>
                        <input type="text" class="form-control" id="subject" name="subject${formCount}1"
                            placeholder="Nama Mata Kuliah" required>
                        <small class="form-text text-muted">example: Biologi Dasar</small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="class_supervisor">Penanggung Jawab Kelas</label>
                        <input type="text" class="form-control" id="class_supervisor" name="class_supervisor${formCount}"
                            placeholder="Nama Penanggung Jawab Kelas (Jika Ada)" required>
                        <small class="form-text text-muted">example: Agung Muhammad</small>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="facility">Fasilitas yang Digunakan<sup>*</sup></label>
                        <input type="text" class="form-control" id="facility" name="facility${formCount}"
                            placeholder="Fasilitas" required>
                        <small class="form-text text-muted">example: Rumah Kaca</small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="start_time">Waktu Mulai<sup>*</sup></label>
                            <input type="time" name="start_time${formCount}" class="form-control" id="start_time"
                                placeholder="Waktu Pelaksanaan" required>
                            <small class="form-text text-muted">example: 14:00</small>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="end_time">Waktu Berakhir<sup>*</sup></label>
                            <input type="time" name="end_time${formCount}" class="form-control" id="end_time"
                                placeholder="Waktu Pelaksanaan" required>
                            <small class="form-text text-muted">example: 15:30</small>
                            <span id="end_time_error"
                                class="text-danger fst-italic fw-lighter error-text end_time${formCount}_error"></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="date">Tanggal Pelaksanaan<sup>*</sup></label>
                            <input type="date" name="date${formCount}" class="form-control" id="date"
                                placeholder="Waktu Pelaksanaan" required>
                            <small class="form-text text-muted">example: 25/12/2023</small>
                            <span id="date_error"
                                class="text-danger fst-italic fw-lighter error-text date${formCount}_error"></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="date">Hari</label>
                            <select name="days" id="days" class="form-control">
                                <option value="Senin">Senin</option>
                                <option value="Selasa">Selasa</option>
                                <option value="Rabu">Rabu</option>
                                <option value="Senin">Kamis</option>
                                <option value="Senin">Jumat</option>
                                <option value="Senin">Sabtu</option>
                                <option value="Senin">Minggu</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
