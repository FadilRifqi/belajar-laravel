@extends('layouts.main')

@section('content')
<div class="container mt-3">
    <div class="row g-5">
        <div class="col-8 card-container">
            <div class="p-3">
                <h5 class="d-flex justify-content-center">{{strtoupper("Filosofi Logo INFEST (Informatics Festival)")}}</h5>
                <h5>ELEMEN:</h5>
                <p>TERDAPAT 3 ELEMEN PADA LOGO TERSEBUT, DI ANTARANYA: <br>
                    • ELEMEN API: MELAMBATKAN SEMANGAT, KEKUATAN, DAN TEKAD YANG MEMBARA, MERESETASI SEMANGAT KITA DALAM MENYONGSONG MASA DEPAN. <br>
                    • ELEMEN TANGAN YANG MENGGENGAM: MELAMBATKAN KEHANGATAN DALAM RANGKULAN YANG MENGAYOMI, MEWAKILI ASAS KEKELUARGAAN. <br>
                    • ELEMEN TANDUK: MELAMBATKAN PERTUMBUHAN ILMU PENGETAHUAN DALAM PIKIRAN, MENJADI ALAT BERKOMPETISI DI ERA SEKARANG.
                </p>
                <h5>WARNA:</h5>
                <p>TERDAPAT 2 WARNA PADA LOGO TERSEBUT, DI ANTARANYA: <br>
                    • UNGU : WARNA UNGU MELAMBATKAN KREATIVITAS, IMAGINASI, DAN KEBIJAKSANAAN. WARNA
                    INI JUGA DAPAT MEWAKILI KEMEWAHAN, AMBISI, DAN KEKUATAN. <br>
                    • BIRU : WARNA BIRU MELAMBATKAN KEPERCAYAAN, KETENANGAN, DAN STABILITAS. WARNA
                    INI JUGA DAPAT MEWAKILI KEAMANAN, LOYALITAS, DAN PROFESIONALISME. SELAIN ITU, BIRU
                    ADALAH WARNA YANG DIPILIH TEKNIK INFORMATIKA ITERA MENJADI WARNA DARI LOGONYA.
                </p>
                <h5>BENTUK:</h5>
                <p>PADA LOGO INI MENGGUNAKAN BENTUK GEOMETRI SEBAGAI BENTUK DASAR DARI ELEMEN YANG ADA
                    YANG TERDIRI ATAS SEGITIGA DAN TRAPESIUM. HAL INI MENGGAMBAR INOVASI, MODERNITAS, DAN
                    FUTURISTIK YANG SANGAT SESUAI DENGAN TEKNIK INFORMATIKA SEBAGAI PENGGARAK TEKNOLOGI.
                </p>
                <h5>KESIMPULAN:</h5>
                <p>LOGO INI MELAMBATKAN SEMANGAT, KEKUATAN, TEKAD, KEKELUARGAAN, DAN ILMU PENGETAHUAN
                    SERTA MENGGAMBAR TEMA KEGIATAN. WARNA YANG DIPILIH MEMBERIKAN KESAN MEWAH DAN
                    LOYAL YANG DI DALAMNYA TERDAPAT MAKNA YANG MENDALAM. PEMILIHAN BENTUK MEMBERIKAN
                    KESAN MODERN DAN FUTURISTIK. DIHARAPKAN MAKNA DARI LOGO INI DAPAT MENJADI DOA BAIK BAGI
                    SELURUH ORANG YANG BERADA DALAM LINGKUP TEKNIK INFORMATIKA INSTITUT TEKNOLOGI SUMATERA.
                </p>
            </div>
        </div>
        <div class="col-4">
            <div class="p-3 card-container d-flex justify-content-center">
                <div class="img-container d-flex align-items-center">
                    <img src="{{asset("images/logo.png")}}" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection