<div class="col-lg-12 p-0 row">
    <div class="col-lg-3 col-xs-12 ">
        <div class="card card-solid mt-2 mb-2 shadow p-3 rounded" style="border-left: #fe7877 solid 4px">
            <div class="card-body">
                <h4>Filter</h4>
                <form method="GET" action="<?php echo base_url()."home/filter/" ?>">
                    <div class="form-group">
                        <label>Kategori</label>
                        <select name="kategori" class="custom-select">
                            <option value="">All</option>
                            <?php foreach ($filter_kategori as $row): ?>
                                <option value="<?php echo $row->id_kategori ?>" <?php echo @$_GET['kategori']==$row->id_kategori ? "selected" : ""; ?>><?php echo ucwords($row->nama_kategori) ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Bahan</label>
                        <select name="bahan" class="custom-select">
                            <option value="">All</option>
                            <?php foreach ($filter_bahan as $row): ?>
                                <option value="<?php echo $row->id_bahan ?>" <?php echo @$_GET['bahan']==$row->id_bahan ? "selected" : ""; ?>><?php echo ucwords($row->nama_bahan) ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Range Harga</label>
                        <div class="input-group">
                            <input type="number" name="min" placeholder="Min" class="form-control" value="<?php echo @$_GET['min'] ?>">
                            <input type="number" name="max" placeholder="Max" class="form-control" value="<?php echo @$_GET['max'] ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-block" style="background: #fe7877;color: #f1f1f1">Filter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-9 col-xs-12">
        <div class="card card-solid mt-2 mb-2">
            <div class="card-body pb-0">
                <div class="row">
                    <?php 
                    $product_shown=array();
                    foreach ($barang as $key => $value) {
                        $product_shown[]=$value->id_barang;
                     ?>
                        <div class="col-sm-6 col-xs-12">
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
        <div class="card  mt-2 mb-2">
            <div class="card-header" id="headingOne">
                <h5 class="mb-0">
                        Collaborative Filtering
                </h5>
            </div>
            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <th>Nama\Rating</th>
                            <?php foreach ($product_shown as $ps => $item): ?>
                                <th class="text-center"><?php echo $this->m_barang->get_data($item)->nama_barang;?></th>
                            <?php endforeach ?>
                        </thead>
                        <tbody>
                                <?php $person = $this->m_rating->getAllUsers();
                                foreach ($person as $cust): ?>
                                <tr>
                                    <td><?php echo ucwords($cust->user) ?></td>
                                    <?php foreach ($product_shown as $item): ?>
                                        <td class="text-center"><?php echo $this->m_rating->getCoordinates($cust->user,$item); ?></td>
                                <?php endforeach; ?>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
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