<?= $this->extend('pages/homeview') ?>

<?= $this->section('image') ?>

    <div class="container">
        <div class="row text-center">
            <div class="col">
                <form id="form1" runat="server">
                    <input type='file' id="imgInp" />
                    <img id="my-image" src="#" />
                </form>
                <button id="use">Upload</button>
                <img id="result" src="">
            </div>
        </div>
    </div>
    <style>
        .row {
            height: 100vh;
        }

        #my-image,
        #use {
            display: none;
        }
    </style>

    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#my-image').attr('src', e.target.result);
                    var resize = new Croppie($('#my-image')[0], {
                        viewport: {
                            width: 200,
                            height: 200,
                            type: 'circle'
                        },
                        boundary: {
                            width: 300,
                            height: 300
                        },
                        showZoomer: true,
                        // enableResize: true,
                        enableOrientation: true
                    });
                    $('#use').fadeIn();
                    $('#use').on('click', function () {
                        resize.result('base64').then(function (dataImg) {
                            var data = [{ image: dataImg }, { name: 'myimgage.jpg' }];
                            // use ajax to send data to php
                            $('#result').attr('src', dataImg);
                            // $('#imgInp').attr('value', dataImg);
                        })
                    })
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#imgInp").change(function () {
            readURL(this);
        });
    </script>
    <?= $this->endSection() ?>

