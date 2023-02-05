$(document).ready(function () {


//Logout

    $('#logout_btn').click(function () {
        var base_url = $(this).attr("data-Base_url");

        $.ajax({
            url: base_url + "/logout",
            method: 'POST',
            success: function (re) {
//                alert("ok");
                if (re === 'success') {
                    window.location.href = base_url;
                }
            }
        });
    });


//To read the input image and crop it 
    var Cropie;

    function clearInstance(input) {
        if (Cropie != null && Cropie != '') {

            Cropie.destroy();
        }
        readURL(input);
    }

    function readURL(input) {

        if (input.files && input.files[0]) {


            var reader = new FileReader();
            reader.onload = function (e) {

                $('#my-image').attr('src', e.target.result);
                if (reader) {
                }
                Cropie = new Croppie($('#my-image')[0], {
                    viewport: {
                        width: 200,
                        height: 200,
                        type: 'square'
                    },
                    boundary: {
                        width: 300,
                        height: 300
                    },
                    showZoomer: false,
                    // enableResize: true,
//                    enableOrientation: true
                });
                $('#use').fadeIn();
                $('#use').on('click', function () {
                    Cropie.result('base64').then(function (dataImg) {
                        var data = [{image: dataImg}, {name: 'myimgage.jpg'}];
                        var base_url = $('#imgInp').attr('data-Base_url');
                        // use ajax to send data to php

                        $.ajax({
                            url: base_url + "/upload-cover-image-check",
                            method: "POST",
                            data: {
                                'base_url': base_url,
                                'data': data[0].image
                            },
                            success: function (s) {
                                $('#imgInp').val('');
                                Cropie.destroy();
                                window.location.reload();
                            }
                        });
//                        $('#result').attr('src', dataImg);
                        // $('#imgInp').attr('value', dataImg);
//                        $(('#my-image')[0]).Croppie('destroy');

                    });
                });
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#imgInp").change(function () {
        clearInstance(this);
    });


    $('#cancel_upload').on('click', function () {
        Cropie.destroy();
        $('#imgInp').val('');
        window.location.reload();
    });

    $('#close_icon').on('click', function () {
        Cropie.destroy();
        $('#imgInp').val('');
        window.location.reload();
    });

//    mypost



//To read the input image and crop it 
    var Cropiepost;

    function clearPostInstance(input) {
        if (Cropiepost != null && Cropiepost != '') {

            Cropiepost.destroy();
        }
        readURLtwo(input);
    }

    function readURLtwo(input) {

        if (input.files && input.files[0]) {


            var reader = new FileReader();
            reader.onload = function (e) {

                $('#my-post-image').attr('src', e.target.result);
                if (reader) {
                }
                Cropiepost = new Croppie($('#my-post-image')[0], {
                    viewport: {
                        width: 200,
                        height: 200,
                        type: 'square'
                    },
                    boundary: {
                        width: 300,
                        height: 300
                    },
                    showZoomer: false,
                    // enableResize: true,
//                    enableOrientation: true
                });
                $('#use-post').fadeIn();
                $('#use-post').on('click', function () {
                    Cropiepost.result('base64').then(function (dataImg) {
                        var data = [{image: dataImg}, {name: 'myimgage.jpg'}];
                        var base_url = $('#postImgInp').attr('data-Base_url');
                        var desc = $('#desc').val();
                        // use ajax to send data to php

                        $.ajax({
                            url: base_url + "/upload-post-image-check",
                            method: "POST",
                            data: {
                                'base_url': base_url,
                                'desc': desc,
                                'data': data[0].image
                            },
                            success: function (s) {
                                $('#postImgInp').val('');
                                Cropiepost.destroy();
                                window.location.reload();
                            }
                        });
//                        $('#result').attr('src', dataImg);
                        // $('#imgInp').attr('value', dataImg);
//                        $(('#my-image')[0]).Croppie('destroy');

                    });
                });
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
    $('#use-post').css('display', 'none');
    $("#postImgInp").change(function () {
        $('#use-post').css('display', 'block');
        clearPostInstance(this);
    });

    $('#cancel_upload_post').on('click', function () {
        Cropiepost.destroy();
        $('#postImgInp').val('');
        window.location.reload();
    });

    $('#close_post_icon').on('click', function () {
        Cropiepost.destroy();
        $('#postImgInp').val('');
        window.location.reload();
    });

//    ---------------------------------------




//  my post lazy loading


//    function lazzy_loader(limit)
//    {
//        var output = '';
//        for (var count = 0; count < limit; count++)
//        {
//            output += '<div class="post_data">';
//            output += '<p><span class="content-placeholder" style="width:100%; height: 30px;">&nbsp;</span></p>';
//            output += '<p><span class="content-placeholder" style="width:100%; height: 100px;">&nbsp;</span></p>';
//            output += '</div>';
//        }
//        $('#load_data_message').html(output);
//    }
//


//    lazzy_loader(limit);

    var limit = 5;
    var start = 0;
    var action = 'inactive';


    function load_data(limit, start)
    {

        $.ajax({
            url: "/fetch-post",
            method: "POST",
            data: {
                'limit': limit,
                'start': start
            },
            cache: false,
            success: function (data)
            {

                if (data == '')
                {
                    $('#load_more').css('display', 'none');

                    $('#load_data_message').html('<h3>No More Result Found</h3>');
                    action = 'active';
                } else
                {
                    var len = data.length;
                    var posts = '';
                    for (var i = 0; i < len; i++) {

                        var post = data[i]['post'];
                        var desc = data[i]['desc'];
                        var id = data[i]['post_id'];
                        var user_id = data[i]['user_id'];

                        posts += '<div class="card mb-5 shadow-sm p-3 bg-dark text-white rounded">';
                        posts += '<img src="' + post + '" class="card-img-top" alt="...">';
                        posts += '<div class="card-body view_post_id" data-mp ="' + id + '" class="view_card" data-bs-toggle="modal" data-bs-target="#exampleModal">';
//                        posts += '<p class="my_post_id" >meeee</p>';
                        posts += '<p class="my_user_id" hidden>' + user_id + '</p>';
                        posts += ' <h5 class="card-title">Description</h5>';
                        posts += '<p class="card-text">' + desc + '</p>';
                        posts += '</div>';
                        posts += '</div>';

                    }
                    $('#load_data').append(posts);

                    $('#load_data_message').html("");
                    action = 'inactive';



                    //------view the post details----------



                    $(".view_post_id").click(function () {

                        var view_post_id = $(this).attr('data-mp');
                        var view = '';

                        $.ajax({
                            url: '/view-post',
                            method: 'POST',
                            data: {
                                'post_id': view_post_id
                            },
                            success: function (res) {


                                var post = res[0]['post'];
                                var desc = res[0]['desc'];
                                var id = res[0]['post_id'];
                                var user_id = res[0]['user_id'];

                                view += '<div class="card mb-5 shadow-sm p-3 bg-dark text-white rounded">';
                                view += '<img src="' + post + '" class="card-img-top" alt="...">';
                                view += '<div class="card-body view_post_id" data-mp ="' + id + '" class="view_card" >';
                                view += '<p class="my_user_id" hidden>' + user_id + '</p>';
                                view += ' <h5 class="card-title">Description</h5>';
                                view += '<p class="card-text">' + desc + '</p>';
                                view += '</div>';
                                view += '</div>';
                                $('#view_load_data').append(view);


                            }
                        });

                    });


                }
            }
        });
    }

    if (action === 'inactive')
    {
        action = 'active';
        load_data(limit, start);
    }

    $('#load_more').click(function () {
        action = 'active';
        start += limit;
        setTimeout(function () {
            load_data(limit, start);
        }, 1000);
    });

//    $(window).scroll(function () {
//        if ($(window).scrollTop() + $(window).height() > $("#load_data").height() && action === 'inactive')
//        {
//            lazzy_loader(limit);
//            action = 'active';
//            start = start + limit;
//            setTimeout(function () {
//                load_data(limit, start);
//            }, 1000);
//        }
//    });


    $('#cancel_view').on('click', function () {
        $('#view_load_data ').html('');
//        window.location.reload();
    });

    $('#close_view_icon').on('click', function () {
        $('#view_load_data').html('');
//        window.location.reload();
    });

    $('#exampleModal').click(function () {
        $('#view_load_data').html('');
    });

});