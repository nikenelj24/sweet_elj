<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img class="d-block w-100" src="<?= base_url() ?>assets/slider/bg1.jpg">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="<?= base_url() ?>assets/slider/bg2.jpg">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="<?= base_url() ?>assets/slider/bg4.jpeg">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="<?= base_url() ?>assets/slider/bg3.jpg">
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-custom-icon" aria-hidden="true">
            <i class="fas fa-chevron-left"></i>
        </span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-custom-icon" aria-hidden="true">
            <i class="fas fa-chevron-right"></i>
        </span>
        <span class="sr-only">Next</span>
    </a>
</div>

<div class="row">
    <div class="col-lg-8 col-xs-12">
        <div class="card card-solid mt-2 mb-2">
            <div class="card-body">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-xs-12 ">
        <div class="card card-solid mt-2 mb-2 shadow p-3 rounded" style="border-left: #fe7877 solid 4px">
            <div class="card-body">
                <h4>Filter</h4>
                <form method="GET" action="<?php echo base_url()."home/filter/" ?>">
                    <div class="form-group">
                        <label>Kategori</label>
                        <select name="kategori" class="custom-select">
                            <option value="">All</option>
                            <?php foreach ($filter_kategori as $row): ?>
                                <option value="<?php echo $row->id_kategori ?>"><?php echo ucwords($row->nama_kategori) ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Bahan</label>
                        <select name="bahan" class="custom-select">
                            <option value="">All</option>
                            <?php foreach ($filter_bahan as $row): ?>
                                <option value="<?php echo $row->id_bahan ?>"><?php echo ucwords($row->nama_bahan) ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Range Harga</label>
                        <div class="input-group">
                            <input type="number" name="min" placeholder="Min" class="form-control">
                            <input type="number" name="max" placeholder="Max" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-block" style="background: #fe7877;color: #f1f1f1">Filter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="card card-solid mt-2 mb-2">
    <div class="card-body pb-0">
        <div class="row">
            <?php foreach ($barang as $row => $value) { ?>
                <div class="col-sm-4">
                    <?php
                    echo form_open('belanja/add');
                    echo form_hidden('id', $value->id_barang);
                    echo form_hidden('qty', 1);
                    echo form_hidden('price', $value->harga);
                    echo form_hidden('name', $value->nama_barang);
                    echo form_hidden('redirect_page', str_replace('index.php/', '', current_url()));
                    ?>
                    <div class="card bg-light">
                        <div class="col-12 text-center">
                            <img src="<?= base_url('assets/uploads/' . $value->gambar) ?>" width="300px" height="250px" class="text-center">
                        </div>
                        <div class="card-header text-muted border-bottom-0">
                            <h2 class="lead"><b><?= $value->nama_barang; ?></b></h2>
                        </div>
                        <div class="card-body pt-0">
                            <div class="row">
                                <div class="col-7">

                                    <p class="text-muted text-sm"><b>Kategori : </b> <?= $value->nama_kategori; ?> </p>
                                    <ul class="ml-4 mb-0 fa-ul text-muted">
                                        <li class="medium"><span class="fa-li "><i class="fas fa-wallet"></i></span><span class="badge bg-success bg-m">Rp. <?= number_format($value->harga, 0); ?></span></li>
                                        <li class="medium"><span class="fa-li"><i class="fas fa-layer-group"></i></span><?= $value->nama_bahan; ?></li>
                                        <li>
                                                    <?php 
                                                    $star = round($this->m_rating->getRating($value->id_barang),1);
                                                    if ($star>0) {
                                                        $s=0;
                                                        for ($i = 1; $i <= $star; $i++) {
                                                            echo '<span class="fa fa-star text-warning"></span>';
                                                            $s++;
                                                        }
                                                        if (($star*2)%2==1) {
                                                            echo '<span class="fa fa-star-half-o text-warning"></span>';   
                                                            $s++;
                                                        }
                                                        if ($s < 5) {
                                                            for ($i = 1; $i <= 5 - $s; $i++) {
                                                            echo '<span class="fa fa-star text-secondary"></span>';   
                                                            }
                                                        }
                                                    }else{
                                                        echo 'Not rated yet';
                                                    }
                                                    ?>
                                                </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-right">
                                <a href="<?= base_url('home/detail_brg/' . $value->id_barang); ?>" class="btn btn-sm bg-teal">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <button type="submit" class="btn btn-sm btn-primary swalDefaultSuccess">
                                    <i class="fa fa-cart-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            <?php } ?>

        </div>
    </div>
</div>


<!-- SweetAlert2 -->
<script src="<?= base_url(); ?>template/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Page specific script -->
<script>
    $(function() {
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });

        $('.swalDefaultSuccess').click(function() {
            Toast.fire({
                icon: 'success',
                title: 'Tas Berhasil Ditambahkan ke Keranjang !'
            })
        });
    });
</script>