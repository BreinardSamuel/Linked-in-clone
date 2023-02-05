<?= $this->extend('pages/homeview') ?>

<?= $this->section('content') ?>


<!--==================================home look============================================-->

<nav class="navbar navbar-dark bg-dark fixed-top shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Welcome &nbsp;<span class="display-5"> <?php print_r($details[0]->name); ?></span></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end text-bg-dark text-center" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
            <div class="offcanvas-header m-auto">
                <h5 class="offcanvas-title display-4" id="offcanvasDarkNavbarLabel">Menu</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                    <li class="nav-item">
                        <a class="nav-link active display-6" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link display-6" href="#">News Feed</a>
                    </li>
                </ul>
                <form class="d-flex mt-3" role="search">
                    <button type="button" class="btn btn-danger mt-5 mb-3 col-3  m-auto" data-Base_url="<?php echo base_url() ?>"
                            id="logout_btn">LOGOUT</button>
                </form>
            </div>
        </div>
    </div>
</nav>


<!--===========================================================================-->


<!-------------------------------Profile card ------------------------->



<main class="container">
    <div class="mt-profile-card shadow-lg mb-5 bg-body rounded">
        <div class="p-4 p-md-5 mb-4 rounded text-bg-dark">
            <div class="col px-0 row">

                <!--column for image-->
                <div class="col">
                    <img src="<?php echo ($details[0]->image) ?>" alt="" srcset="" height="400" width="400">
                </div>

                <!--column for edit and personal details-->
                <div class="col float-right">
                    <h1 class="display-5">My Details</h1>

                    <p>Name : <?php echo ($details[0]->name) ?></p>
                    <p>Email : <?php echo ($details[0]->email) ?></p>
                    <p>Mobile Number : <?php echo ($details[0]->mobile_number) ?></p>
                    <p>Address : <?php echo ($details[0]->address) ?></p>
                    <!-- Button trigger modal -->
                    <button type="button" id="edit_profile_btn" class="btn btn-lg btn-block btn-light" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">
                        Edit Profile
                    </button>
                </div>

            </div>
        </div>
    </div>

    <!--Modal to crop profile image upload-->

    <div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Edit Profile</h5>
                    <button type="button" class="btn-close" id="close_icon" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row text-center">
                            <div class="col">

                                <form id="profile_form" runat="server">
                                    <input type='file' id="imgInp" data-Base_url="<?php echo base_url() ?>" accept="image/*"  class="btn btn-lg"/>
                                    <img id="my-image" src="#"/>
                                </form>

                                <button id="use" class="btn btn-outline-success" data-Base_url="<?php echo base_url() ?>" id="cover_upload_btn" data-bs-dismiss='modal' >Upload</button>
                                <img id="result" src="">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn btn-danger" id="cancel_upload" data-bs-dismiss="modal">Cancel upload</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!---------for view---------->

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content view-width">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">View Post</h1>
                        <button type="button" class="btn-close" id="close_view_icon" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="view_load_data">
                        
                    </div>
<!--                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" id="cancel_view" data-bs-dismiss="modal">Close</button>
                    </div>-->
                </div>
            </div>
        </div>


    <!------------------------------------My posts ------------------------------------------>



    <div class="row g-5">
        <div class="col-md-8 text-center">
            <h3 class="pb-4 mb-4 display-4 border-bottom">
                My Posts
            </h3>


            <!--upload mypost-->

            <div class="card mb-5 shadow-lg p-3">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    Upload Post
                </button>
            </div>


            <!--uploaded images (mypost)-->



            <?php // foreach ($details as $detail): ?>
            <!--                <div class="card mb-5 shadow-sm p-3 bg-dark text-white rounded">
                                <img src="<?php // echo $detail->post;   ?>" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Description</h5>
                                    <p class="card-text"><?php // echo $detail->desc;   ?></p>
                                </div>
                            </div>-->
            <?php // endforeach; ?>

            <div id="load_data">

            </div>

            <button id="load_more" class="btn btn-dark">Load More <i class="bi bi-arrow-clockwise"></i></button>

            <div id='load_data_message'>
            </div>
        </div>

        <div class="col-md-4">
            <div class="position-sticky sticky-from-top" style="top: 2rem;">
                <div class="p-4 mb-3 bg-light rounded shadow-lg p-3 mb-5 bg-dark text-white">
                    <h4 class="fst-bold">About</h4>
                    </button>
                    <p class="mb-0">Customize this section to tell your visitors a little bit about your publication, writers, content, or something else entirely. Totally up to you.</p>
                </div>

                <div class="shadow-lg p-3 mb-5 rounded bg-dark text-white">
                    <h4 class="fst-bold">Archives</h4>
                    <ol class="list-unstyled mb-0">
                        <li><a class="text-white" href="#">March 2021</a></li>
                        <li><a class="text-white" href="#">February 2021</a></li>
                        <li><a class="text-white" href="#">January 2021</a></li>
                        <li><a class="text-white" href="#">December 2020</a></li>
                        <li><a class="text-white" href="#">November 2020</a></li>
                        <li><a class="text-white" href="#">October 2020</a></li>
                        <li><a class="text-white" href="#">September 2020</a></li>
                        <li><a class="text-white" href="#">August 2020</a></li>
                        <li><a class="text-white" href="#">July 2020</a></li>
                        <li><a class="text-white" href="#">June 2020</a></li>
                        <li><a class="text-white" href="#">May 2020</a></li>
                        <li><a class="text-white" href="#">April 2020</a></li>
                    </ol>
                </div>

                <div class="p-4 shadow-lg p-3 bg-dark text-white">
                    <h4 class="fst-italic">Elsewhere</h4>
                    <ol class="list-unstyled">
                        <li><a class="text-white" href="#">GitHub</a></li>
                        <li><a class="text-white" href="#">Twitter</a></li>
                        <li><a class="text-white" href="#">Facebook</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
                    <button type="button" class="btn-close" id="close_post_icon" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row text-center">
                            <div class="row text-center">
                                <div class="col">

                                    <form id="mypost_form" runat="server">
                                        <input type='file' id="postImgInp" data-Base_url="<?php echo base_url() ?>" accept="image/*"  class="btn btn-lg"/>
                                        <img id="my-post-image" src="#"/>
                                    </form>
                                    <label>Description</label>
                                    <textarea id="desc" name="desc" rows="5" cols="10"></textarea>
                                    <button id="use-post" class="btn btn-outline-success" data-Base_url="<?php echo base_url() ?>" id="cover_upload_btn" data-bs-dismiss='modal' >Upload</button>
                                    <!--<img id="result" src="">-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn btn-danger" id="cancel_post_upload" data-bs-dismiss="modal">Cancel upload</button>
                    </div>
                </div>
            </div>
        </div>



</main>


<?= $this->endSection() ?>
