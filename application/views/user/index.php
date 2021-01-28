<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="card" style="width: 13rem;">
        <img class="card-img-top" src="<?= base_url('assets/img/profile/') . $user['image']; ?>" alt="Card image cap">
        <div class="card-body">
            <p class="card-text">
                <?= $user['email']; ?>test
            </p>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->