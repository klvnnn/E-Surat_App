<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Lembar Disposisi - {{ $item->letter_no }}</title>
    <style>
        textarea {
            border: none;
            outline: none;
            resize: none;
        }
    </style>
</head>

<body>
    <section id="main">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h4 class="text-center">Lembar Disposisi</h4>
                    <table class="table">
                        <thead>
                        </thead>
                        <tbody>
                                <tr>
                                    <td>Surat Dari &nbsp; &nbsp; &nbsp;&nbsp;: {{ $item->department }}</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>Diterima Tanggal : </td>
                                </tr>
                                <tr>
                                    <td>No. Surat &nbsp; &nbsp; &nbsp; &nbsp;: {{ $item->letter_no }}</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>No. Agenda &nbsp; &nbsp; &nbsp; &nbsp; : {{ $agenda }}</td>
                                </tr>
                                <tr>
                                    <td>Tanggal Surat : {{ date('d-m-Y', strtotime($item->letter_date)) }}</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>Sifat &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; :
                                        <br>
                                        <input type="checkbox">
                                        <label>Sangat Segera</label>
                                        <br>
                                        <input type="checkbox">
                                        <label>Segera</label>
                                        <br>
                                        <input type="checkbox">
                                        <label>Rahasia</label>
                                    </td>
                                </tr>
                                <br>
                        </tbody>
                    </table>
                    <table class="table">
                        <thead>
                        </thead>
                        <tbody>
                                <tr>
                                    <td>
                                        <textarea name="" id="" cols="90" rows="10">Perihal : {{ $item->regarding }}</textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Diteruskan Kepada : {{ $item->forward }} </td>
                                </tr>
                        </tbody>
                    </table>
                    <table class="table">
                        <thead>
                        </thead>
                        <tbody>
                                <tr>
                                    <td>
                                        <textarea name="" id="" cols="90" rows="10">Catatan :</textarea>
                                    </td>
                                </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <script>
        window.print();
        window.onafterprint = window.close;
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</body>

</html>
