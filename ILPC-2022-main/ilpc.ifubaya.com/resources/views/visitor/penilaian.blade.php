@extends('visitor.layouts.app')

@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-body">
                <!-- search header -->
                <section id="faq-search-filter d-flex justify-content-center align-items-center" style="">
                    <div class="card faq-search" style="background-image: url('{{ asset('ilpc2022') }}/home/c1.jpg')">
                        <div class="card-body text-center">
                            <!-- main title -->
                            <div class="row d-flex justify-content-center aling-items-center">
                                <div class="col-10 col-sm-10">
                                    <h1 class="ml6 mt-2">
                                        <span class="text-wrapper">
                                            <span class="letters text-primary"
                                                style="text-shadow: 0 0 20px #7367f0;">Penilaian</span>
                                        </span>
                                    </h1>
                                </div>
                            </div>

                            <!-- subtitle -->
                            <p class="card-text mb-2 text-white">Contoh soal dan cara pengerjaannya</p>
                        </div>
                    </div>
                </section>

                {{-- Card Logika --}}
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h2 class="card-title text-white mb-2">SOAL LOGIKA</h2>
                        <p class="card-text" style="text-align:justify; text-justify:inter-word">Peserta akan diberikan
                            cerita atau deskripsi dari suatu permasalahan.
                            Kemudian peserta diminta untuk membuat program berbasis console (non GUI) untuk menyelesaikan
                            soal tersebut dengan memperhatikan batasan dan kriteria yang berlaku. Untuk menjawab soal
                            pemrograman, peserta bebas menggunakan bahasa C++, Java, atau Pascal. Peserta dapat langsung
                            mengirimkan source code melalui halaman Submit. Tunggu hingga juri melakukan penilaian. Peserta
                            dapat melihat hasil penilaian juri melalui halaman Submission. Kami menyediakan halaman
                            Scoreboard untuk melihat ranking setiap tim pada sesi pemrograman.</p>
                    </div>
                    <div class="card-body mt-2">
                        <h3 class="card-text mb-2"><strong>Contoh Soal Logika:</strong></h3>
                        <p class="card-text" style="text-align:justify; text-justify:inter-word">Seorang desainer
                            berencana membuat 5 buah baju untuk diproduksi. Desainer
                            tersebut kebingungan memilih model baju mana yang akan digunakan dari 7 model yang ada, yaitu:
                            G, H, I, J, K, L, dan M. Desainer telah membuat kesepakatan dengan pihak penjahit sebagai
                            berikut:
                            Tidak boleh ada satu model pun yang diproduksi lebih dari satu kali.
                            Salah satu model J atau M harus dibuat, namun tidak boleh membuat keduanya sekaligus.
                            Jika model L dipilih, maka model I juga harus dipilih.
                            Jika model H dipilih, maka J tidak dapat dipilih.
                            Jika model M adalah salah satu model yang tidak terpilih untuk dibuat, maka model mana lagi yang
                            juga tidak akan diproduksi?</p>
                        <p class="card-text px-1">a. G</p>
                        <p class="card-text px-1">b. H</p>
                        <p class="card-text px-1">c. I</p>
                        <p class="card-text px-1">d. J</p>
                        <p class="card-text px-1">e. K</p>
                        <h3 class="card-text mb-2"><strong>Tingkat Keyakinan:</strong></h3>
                        <p class="card-text px-1">a. Yakin</p>
                        <p class="card-text px-1">b. Tidak yakin</p>
                    </div>
                </div>
                {{-- END OF Card Logika --}}

                {{-- Card Pemrograman --}}
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h2 class="card-title text-white mb-2">SOAL PEMROGRAMAN</h2>
                        <p class="card-text" style="text-align:justify; text-justify:inter-word">Peserta akan diberikan
                            cerita atau deskripsi dari suatu permasalahan.
                            Kemudian peserta diminta untuk membuat program berbasis console (non GUI) untuk menyelesaikan
                            soal tersebut dengan memperhatikan batasan dan kriteria yang berlaku. Untuk menjawab soal
                            pemrograman, peserta bebas menggunakan bahasa C++, Java, atau Pascal. Peserta dapat langsung
                            mengirimkan source code melalui halaman Submit. Tunggu hingga juri melakukan penilaian. Peserta
                            dapat melihat hasil penilaian juri melalui halaman Submission. Kami menyediakan halaman
                            Scoreboard untuk melihat ranking setiap tim pada sesi pemrograman.</p>
                    </div>
                    <div class="card-body">

                        {{-- Struktur Soal --}}
                        <div class="my-3">
                            <h3 class="card-text mb-2"><strong>Struktur Soal</strong></h3>
                            <p class="card-text" style="font-weight:bold">1. Deskripsi</p>
                            <p class="px-1" style="text-align:justify; text-justify:inter-word">Berisi penjelasan
                                permasalahan yang harus diselesaikan oleh peserta.</p>

                            <p class="card-text" style="font-weight:bold">2. Time Limit</p>
                            <p class="px-1" style="text-align:justify; text-justify:inter-word">Time Limit
                                merupakan batasan waktu bagi program anda untuk memproses seluruh inputan yang diujikan
                                menjadi output yang diminta pada server ILPC. Apabila program anda berjalan melebihi Time
                                Limit , hasil yang muncul pada halaman Submission adalah Time Limit Exceeded.</p>

                            <p class="card-text" style="font-weight:bold">3. Memory Limit</p>
                            <p class="px-1" style="text-align:justify; text-justify:inter-word">Memory Limit
                                merupakan batasan penggunaan memori ketika memproses seluruh inputan yang diujikan menjadi
                                output tertentu pada server ILPC. Apabila program anda memakan memori melebihi Memory Limit
                                , hasil yang muncul pada halaman Submission adalah Memory Limit Exceeded.</p>

                            <p class="card-text" style="font-weight:bold">4. Format Input dan Output</p>
                            <p class="px-1" style="text-align:justify; text-justify:inter-word">Format Input
                                merupakan deskripsi bagaimana inputan akan diberikan juri kepada program peserta saat
                                dijalankan. Sedangkan Format Output adalah bagaimana seharusnya output jawaban peserta
                                ditampilkan. Apabila peserta tidak mengikuti format input dan output, jawaban peserta
                                dinilai salah (Wrong Answer)
                                <br><span class="text-danger">* Peserta tidak perlu mengecek validitas inputan, karena
                                    inputan yang diberikan juri pasti sesuai dengan kriteria yang tertera pada soal.</span>
                            </p>

                            <p class="card-text" style="font-weight:bold">5. Contoh Input dan Output</p>
                            <p class="px-1" style="text-align:justify; text-justify:inter-word">Merupakan contoh
                                input yang diberikan juri beserta hasil output yang benar berdasarkan input tersebut.
                                Apabila program peserta menghasilkan output yang sama dengan contoh output, jawaban peserta
                                belum tentu 100% benar. Bisa saja solusi peserta salah ketika diberikan kasus uji lain. Data
                                Uji/Inputan selain yang disebutkan pada Contoh Input bersifat RAHASIA.</p>
                        </div>
                        {{-- END OF Struktur Soal --}}

                        {{-- Contoh Soal --}}
                        <div class="mb-2">
                            <h3 class="card-text"><strong>Contoh Soal</strong></h3>
                            <button class="btn btn-primary mb-2 me-1 waves-effect waves-float waves-light collapsed"
                                type="button" data-bs-toggle="collapse" data-bs-target="#contohSoal" aria-expanded="false"
                                aria-controls="contohSoal">
                                Show/Hide Soal
                            </button>
                            {{-- Soal --}}
                            <div class="collapse" id="contohSoal" style="">
                                {{-- Card Header --}}
                                <div class="text-center">
                                    <h4 class="mt-2">BASKETBALL TEAM</h4>
                                    <p class="mt-2">Time Limit: 1 s.</p>
                                    <p class="mt-1">Memory Limit: 64MB.</p>
                                </div>
                                {{-- Body Soal --}}
                                <p style="text-align:justify; text-justify:inter-word">Seorang pelatih basket memiliki
                                    kebiasaan yang ane>Seorang pelatih basket memiliki kebiasaan yang aneh dalam melatih
                                    timnya. Menurut sang pelatih, pemain yang “beruntung” adalah pemain dengan nomor ganjil,
                                    sementara pemain dengan nomor genap dianggap “kurang beruntung”. Sebuah tim dianggap
                                    “siap bertanding” jika jumlah pemain yang “beruntung” lebih banyak daripada jumlah
                                    pemain yang “kurang beruntung”. Tentukan apakah sebuah tim “siap bertanding” atau “tidak
                                    siap”.</p>

                                <h5>Format Input:</h5>
                                <p style="text-align:justify; text-justify:inter-word">Baris pertama berisi bilangan bulat
                                    positif T, jumlah kasus uji.
                                    Untuk setiap kasus uji, input berupa:
                                    <br>Sebuah baris berisi bilangan bulat positif n, jumlah pemain.
                                    <br>Baris berikutnya berisi bilangan A1, A2, ... An di mana Ai menyatakan nomor pemain
                                    ke-i.
                                </p>

                                <h5>Format Output:</h5>
                                <p>Untuk setiap kasus uji, output berupa (tanpa tanda kutip):
                                    <br>“SIAP BERTANDING” jika kondisi pemain memenuhi persyaratan, atau “TIDAK SIAP” jika
                                    kondisi pemain tidak memenuhi persyaratan.
                                </p>

                                <h5>Constraints</h5>
                                <p>1 ≤ T ≤ 100 1 ≤ Ai ≤ 50</p>

                                <h5>Contoh Input:</h5>
                                <p>
                                    3
                                    <br>3
                                    <br>12 23 4
                                    <br>4
                                    <br>2 33 19 11
                                    <br>1
                                    <br>5
                                </p>

                                <h5>Contoh Output:</h5>
                                <p class="mb-4">TIDAK SIAP
                                    <br>SIAP BERTANDING
                                    <br>SIAP BERTANDING
                                </p>

                            </div>
                            {{-- END OF Soal --}}
                        </div>
                        {{-- END OF Contoh Soal --}}

                        {{-- Contoh Jawaban Benar --}}
                        <div class="mb-2">
                            <h3 class="card-text"><strong>Contoh Jawaban Benar</strong></h3>
                            <button class="btn btn-primary mb-2 me-1 waves-effect waves-float waves-light collapsed"
                                type="button" data-bs-toggle="collapse" data-bs-target="#contohJawabanBenar"
                                aria-expanded="false" aria-controls="contohJawabanBenar">
                                Contoh Jawaban Benar
                            </button>
                            <div class="collapse" id="contohJawabanBenar" style="">
                                <pre class='code java-code'><label>JAVA</label>
<code>import java.util.Scanner;
import java.util.Map;
import java.util.HashMap;

class Main {
    public static void main(String[] args){
        Scanner sc = new Scanner(System.in);
        int total = sc.nextInt();
        for(int t = 0;t < total;t++){
            int max = sc.nextInt();
            int[] players = new int[max];
            for(int count = 0;count < max;count++){
                players[count] = sc.nextInt();
            }
            int ganjil = 0, genap = 0;
            for(int i:players){
                if(i%2 == 0)
                    genap++;
                else
                    ganjil++;
            }
            
            if(ganjil > genap)
                System.out.println("SIAP BERTANDING");
            else
                System.out.println("TIDAK SIAP");
        }
    }
}</code>
                                    </pre>
                            </div>
                        </div>
                        {{-- END OF Contoh Jawaban Benar --}}

                        {{-- Contoh Jawaban Salah --}}
                        <div class="mb-2">
                            <h3 class="card-text"><strong>Contoh Jawaban Salah</strong></h3>
                            <button class="btn btn-primary mb-2 me-1 waves-effect waves-float waves-light collapsed"
                                type="button" data-bs-toggle="collapse" data-bs-target="#contohJawabanSalah"
                                aria-expanded="false" aria-controls="contohJawabanSalah">
                                Contoh Jawaban Salah
                            </button>
                            <div class="collapse" id="contohJawabanSalah" style="">
                                <pre class='code java-code'><label>JAVA</label>
<code>import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.util.ArrayList;
import java.util.List;
import java.util.Scanner;

class Main {

    public static void main(String[] args) {
        Scanner scanner = new Scanner(System.in);
        int howMuch = scanner.nextInt();
        int count = 0;

        List res = new ArrayList<>();

        while (count < howMuch) {
            int ganjilCount = 0;
            int genapCount = 0;

            int pemainCount = scanner.nextInt();
            String input = scanner.nextLine();
            input = scanner.nextLine();
            if (input.contains(" ")) {
                String[] arr = input.split(" ");
                for (int i = 0; i < args.length; i++) {
                    String s = arr[i];
                    int toInt = Integer.parseInt(s);
                    if ((toInt % 2) == 0) {
                        // Genap
                        genapCount++;
                    } else {
                        // Ganjil
                        ganjilCount++;
                    }
                }

                if (ganjilCount > genapCount) {
                    res.add("SIAP BERTANDING");
                } else {
                    res.add("TIDAK SIAP");
                }
            } else {
                input = input.replace(" ", "");
                int noSpace = Integer.valueOf(input);
                if ((noSpace % 2) == 0) {
                    // Genap
                    res.add("TIDAK SIAP");
                } else {
                    // Ganjil
                    res.add("SIAP BERTANDING");
                }
            }
            count++;
        }

        for (int i = 0; i < res.size(); i++) {
            System.out.println(res.get(i));
        }
    }
}</code>
                                    </pre>
                            </div>
                        </div>
                        {{-- END OF Contoh Jawaban Salah --}}

                    </div>
                </div>
                {{-- END OF Card Pemrograman --}}
                {{-- Card Program --}}
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h2 class="card-title text-white mb-2">PROGRAM</h2>
                        <p class="card-text" style="text-align:justify; text-justify:inter-word">Dibawah ini adalah list dari compiler dan software yang dapat digunakan di ILPC 2022. Agar perlombaan dapat berjalan dengan lancar, Harap gunakan minimal salah satu dari compiler dan software dibawah ini.</p>
                    </div>
                    <div class="card-body mt-2">

                        {{-- Compiler --}}
                        <h3 class="card-text mb-2"><strong>Compiler</strong></h3>
                        <p class="card-text px-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle">
                                <circle cx="6" cy="8" r="6"></circle>
                            </svg> 
                            C++ : clang version 10.0.0
                        </p>
                        <p class="card-text px-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle">
                                <circle cx="6" cy="8" r="6"></circle>
                            </svg>
                            Java : Java 17.0.1
                        </p>
                        <p class="card-text px-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle">
                                <circle cx="6" cy="8" r="6"></circle>
                            </svg> 
                            Pascal : Free Pascal Compiler version 3.0.4
                        </p>
                        <p class="card-text px-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle">
                                <circle cx="6" cy="8" r="6"></circle>
                            </svg> 
                            Python : Python 3.8.10
                        </p>

                        {{-- Software --}}
                        <h3 class="card-text mb-2"><strong>Software</strong></h3>
                        <p class="card-text px-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle">
                                <circle cx="6" cy="8" r="6"></circle>
                            </svg>
                            Netbeans 8.0.2 (Java dan C++)
                            <br><small class='text-secondary'>Khusus Java, untuk file yang dikumpulkan mohon nama class tidak berisi kata public. <br>cth benar : 'class Main {...}'. Dan tidak ada 'package ...' di awal code file</small>
                        </p>
                        <p class="card-text px-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle">
                                <circle cx="6" cy="8" r="6"></circle>
                            </svg> 
                            Codeblocks (C++)
                        </p>
                        <p class="card-text px-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle">
                                <circle cx="6" cy="8" r="6"></circle>
                            </svg>
                            Free Pascal IDE 3.0.4 (Pascal)
                        </p>
                        <p class="card-text px-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle">
                                <circle cx="6" cy="8" r="6"></circle>
                            </svg>
                            Lazarus 2.0.10 (Pascal)
                        </p>
                        <p class="card-text px-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle">
                                <circle cx="6" cy="8" r="6"></circle>
                            </svg>
                            Jupyter Notebook / Google Colab (Python)
                        </p>
                    </div>
                </div>
                {{-- END OF Card Program --}}
                {{-- Card Penilaian --}}
                <div class="card">
                    <div class="card-header bg-primary text-white mb-2">
                        <h2 class="card-title text-white mb-2">PENILAIAN</h2>
                        <p class="card-text" style="text-align:justify; text-justify:inter-word">Untuk memahami bagaimana juri melakukan penilaian beserta tips untuk menghindari error, Panitia ILPC 2022 telah menyiapkan Modul Penilaian ILPC 2022. Silakan mendownload Modul Penilaian ILPC 2022 melalui tombol berikut:</p>
                    </div>
                    <div class="card-body">
                        <a href="{{ asset('/') }}ilpc2022/files/MODUL_PENILAIAN_ILPC_2022.pdf" download="Modul Penilaian ILPC 2022" class="btn btn-outline-primary waves-effect">Download modul disini</a>
                    </div>
                </div>
                {{-- END OF Card Penilian --}}
            </div>
        </div>
    </div>

@endsection

@section('javascript')
    <script src=”https://www.jdoodle.com/assets/jdoodle-pym.min.js” type=”text/javascript”></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
    <script>
        var textWrapper = document.querySelector('.ml6 .letters');
        textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>");
        anime.timeline({
                loop: true
            })
            .add({
                targets: '.ml6 .letter',
                translateY: ["1.1em", 0],
                translateZ: 0,
                duration: 1000,
                delay: (el, i) => 50 * i
            })
            .add({
                targets: '.ml6 .letter',
                translateY: [0, -0.1],
                translateZ: 0,
                duration: 100,
                easing: 'linear',
                delay: (el, i) => 50 * i
            })
            .add({
                targets: '.ml6 .letter',
                translateY: [-0.1, 0],
                translateZ: 0,
                duration: 100,
                easing: 'linear',
                delay: (el, i) => 50 * i
            })
            .add({
                targets: '.ml6 .letter',
                translateY: [0, 0],
                duration: 2000,
                easing: 'linear',
                delay: (el, i) => 50 * i
            })
            .add({
                targets: '.ml6 .letter',
                translateY: [0, -0.1],
                translateZ: 0,
                duration: 100,
                easing: 'linear',
                delay: (el, i) => 50 * i
            })
            .add({
                targets: '.ml6 .letter',
                translateY: [-0.1, 0],
                translateZ: 0,
                duration: 100,
                easing: 'linear',
                delay: (el, i) => 50 * i
            })
            .add({
                targets: '.ml6 .letter',
                translateY: [0, 0],
                duration: 2000,
                easing: 'linear',
                delay: (el, i) => 50 * i
            })
            .add({
                targets: '.ml6 .letter',
                translateY: [0, "1.1em"],
                translateZ: 0,
                duration: 1000,
                delay: (el, i) => 50 * i
            });
    </script>
    <script>
        $('i[rel="pre"]').replaceWith(function() {
            return $('<pre><code>' + $(this).html() + '</code></pre>');
        });
        var pres = document.querySelectorAll('pre,kbd,blockquote');
        for (var i = 0; i < pres.length; i++) {
            pres[i].addEventListener("dblclick", function() {
                var selection = getSelection();
                var range = document.createRange();
                range.selectNodeContents(this);
                selection.removeAllRanges();
                selection.addRange(range);
            }, false);
        }
    </script>
@endsection

@section('css')
    <link rel="stylesheet"
        href="//cdn.jsdelivr.net/gh/highlightjs/cdn-release@9.16.2/build/styles/atelier-estuary-dark.min.css">
    <script src="//cdn.jsdelivr.net/gh/highlightjs/cdn-release@9.16.2/build/highlight.min.js"></script>
    <script>
        hljs.initHighlightingOnLoad();
    </script>

    <style>
        .ml6 {
            position: relative;
            font-weight: 900;
            font-size: 3.3em;
            margin: 0;
        }

        .ml6 .text-wrapper {
            position: relative;
            display: inline-block;
            padding-right: 0.05em;
            overflow: hidden;
        }

        .ml6 .letter {
            display: inline-block;
            line-height: 1em;
        }

        pre {
            background: #333;
            white-space: pre;
            word-wrap: break-word;
            overflow: auto;
        }

        pre.code {
            border-radius: 4px;
            border: 1px solid #292929;
            position: relative;
        }

        pre.code label {
            font-family: sans-serif;
            font-weight: bold;
            font-size: 13px;
            color: #ddd;
            position: absolute;
            left: 1px;
            top: 15px;
            text-align: center;
            width: 60px;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            pointer-events: none;
        }

        pre.code code {
            font-family: "Inconsolata", "Monaco", "Consolas", "Andale Mono", "Bitstream Vera Sans Mono", "Courier New", Courier, monospace;
            display: block;
            margin: 0 0 0 60px;
            padding: 15px 16px 14px;
            border-left: 1px solid #555;
            overflow-x: auto;
            font-size: 13px;
            line-height: 19px;
            color: #ddd;
        }

        pre::after {
            content: "double click to select";
            padding: 0;
            width: auto;
            height: auto;
            position: absolute;
            right: 18px;
            top: 14px;
            font-size: 12px;
            color: #ddd;
            line-height: 20px;
            overflow: hidden;
            -webkit-backface-visibility: hidden;
            transition: all 0.3s ease;
        }

        pre:hover::after {
            opacity: 0;
            visibility: visible;
        }

        pre.java-code code {
            color: #FFFFFF;
        }

        .hljs-params {
            color: #FFFFFF;
        }

        .hljs-keyword {
            color: #66d9ef;
        }

        .hljs-title {
            color: #e6db74
        }

        .hljs-string {
            color: #a6e22e
        }

        pre.css-code code {
            color: #ff4242;
        }

        pre.html-code code {
            color: #00ca02;
        }

        pre.javascript-code code {
            color: #ff8000;
        }

        pre.jquery-code code {
            color: #1da1f2;
        }

        @media (max-width: 750px) {
            pre::after {
                content: '';
            }
        }

    </style>
@endsection
