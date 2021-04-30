<style type="text/css">

  .rating {
    unicode-bidi: bidi-override;
    direction: rtl;
    /*text-align: center;*/
  }

  .rating label {
    display: inline-block;
    width: 24px;
    height: 24px;
    background:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAMAAABg3Am1AAAAyVBMVEXGxsb+/v6zs7O8vLy7u7u6urrCwsL////AwMC5ubm/v7+9vb3Dw8O+vr7ExMS3t7fBwcG4uLi1tbW0tLTFxcW2traysrLg4ODt7e37+/vY2Njn5+fU1NT9/f35+fnr6+v19fXk5OTKysrHx8fi4uLa2trc3Nz39/fv7+/R0dHu7u7Ly8ve3t7Pz8/p6enl5eXT09PNzc38/Pzy8vLJycnZ2dnV1dXj4+Pq6urd3d3b29v09PTm5ubQ0NDIyMjX19fW1tbx8fH///9F+zTWAAAAQ3RSTlP///////////////////////////////////////////////////////////////////////////////////////8AQWIE7wAAAa5JREFUeNqV09dygzAQQNEVanQMGNy7nd57L/r/j0owtpMgiYj7xgyHWRVAqEMToU4HZocNwbHTDPAs6jYCg9i7awROAx83AnEbsusGYBIB4H4DcOEBMLsBICEAJGNjcJDBd2TPGLzjArRCYxD4UGSNDME0gXW0YwhWuAT2whAwBmUpMgK9HDY5MwVAUntkC+w5koLzyKpEfNiGrWp9EGNG2mAWdibFGvgwb4FBIV2MhIDN7wL/5lq3P7vU8/8dC9Pun239yO36cd5Q5RzOYlw3zpN8cFchDXXjkCPlSfct5Vg+nSPN1XhwFGMF6aP+Lo3Alb6PD+ouXzeS5l+JOjCUTpCxWoB9qJb3asB1BlLkpAb0sQxaUANsBnIW0oL9ZLdUau02mC61YPdzesnyCG8f7BstCFubdbpTIdCcllvWTrkGXFnlKp3D8o2TNIAi51wDOnQ9TjYTmz699VjupQYs7GIce1/s4peUAbQjrgQoLca54OJ3nWKs+EwJ7h3wohdR6TkgELwqwbFL2FhI8VPKHBXgST7kQtUyiboKMIgHQtPUHSpApye08ZUEjPsCKj+LDQz5xjYAAAAASUVORK5CYII=) no-repeat 0 0;
    background-size:24px 24px;
    font-size:0;
    cursor: pointer;
  }
  .rating input {
    display:none;
  }

  .rating input:checked + label,
  .rating input:checked ~ input + label {
    background-image:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAMAAABg3Am1AAABgFBMVEXRXzXs0sT//v779fLu2MzSYTT0akL58e326ePqYkLy4tnmxbPqzb3dYTq6XizYpIntZELhYj37bkPcrpW6XCvCXS3esZrNYTHbZjf1bUDoybjJgVvLhmHZYDnKXjLmaDvNXjPGXi/GeVD9+vjBbUHlwa7Pjmv37Ofw3dPqZUDhZTvaqY7MiWXlZT7CcUb+/v3VnX+8YzPeZDnYYza9ZTbftJ7OXjTQkG/XYTfhuqTsaj7UYjTXoYS/aTvUYDe7YTHwaz/kYz7XYjfXYzXWXzj2a0P0aUP8+Pb2akPxZ0O9XCvzaEPyaEPvZUPyZ0PvZkPuZULsY0LwZkPwZ0P4bEP3a0P5bUP6bUP5bEP8b0Pjvan05d2+ZznAaj39cEPIfVXHfFTRlHTt1cjbq5LEdErFd079+/r15+Drz8HgtqDvaUDy39bqZj/lZzzwaUDHXTDYZDXtZ0DfZzj47+nIf1jJYC/yaULuZ0HTmHnUmXrw28+7Xy7VYTb4bkH5bkP///8s9V56AAAAgHRSTlP/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////ADgFS2cAAAIJSURBVHjaldX5V9owAMDxGmBQrtoRUDkqyI2MgUKZ4jyQ6e6NjW2WS0R0p5vTuUPY8q+7duWN1ya1/f7UNPn8kCbvlUL4on2EjwQceYOg3DEGQOHi0hBwzpwxhsCv+bmcEQDav7sRuwHQv+h2Zz0GwNqZIGwuGACxOUEQvDbdIBW5+bfTkm6wOCuC1YBuMNgUwR9o1Qla3jdSlaZO4Dt9LTWf1Ql6q3tSjWFUF0jCxr/2ZhwYsKuqtN2QO0moZyl/8aGiyodX47aVc/CQQrZe5cY9fS13+uIeAANP9Cz/XAla5U0728v3ry3j9vz/Sslvlu/XrK/GzJOfFSzCzI5GXy1Zk+Ic3t2tktcvuX3qgzsPWH48wjeKXeJOGhzCzGNMn6iEiXA1pjqjp6pcw/fku2QNLj1QlM6ltC6fOaIEIx/SAkz1paJb+5ogl36hDCY1gN37TBW1ogE8609UsUENsLD1XJ3bRAQ277QcG4ah8XM4TgQlSl5zpxBP5cYDV4IIAuy0FHXUQiha5rekUXrjmADOYV2M5fJAGq8MQ9ILzk8ATV6crhUdSO7jgBLfhA4IIOuq12m+93bib30QZus0XQRYEHXTtItbA2iy5kaNpr9MYYGDo9eLfqTIPuDpWh4LyiF+34ZUHf/k2A4OgAJkAMIVL0TMGOBsOxGh1hGDAc0kInbbpwAGugICsJ4iKYYBmgAAAABJRU5ErkJggg==);
  }
</style>
<div class="card card-solid">
  <div class="card-body">
    <div class="row">
      <div class="col-12 col-sm-6">
        <h3 class="d-inline-block d-sm-none"><?= $barang->nama_barang; ?></h3>
        <div class="col-12">
          <img src="<?= base_url('assets/uploads/' . $barang->gambar) ?>" class="product-image" alt="Product Image">
        </div>
        <div class="col-12 product-image-thumbs">
          <div class="product-image-thumb active"><img src="<?= base_url('assets/uploads/' . $barang->gambar) ?>" alt="Product Image"></div>
          <?php foreach ($gambar as $key => $value) { ?>
            <div class="product-image-thumb"><img src="<?= base_url('assets/gmr_brg/' . $value->gambar) ?>" alt="Product Image"></div>
          <?php } ?>
        </div>
      </div>
      <div class="col-12 col-sm-6">
        <h3 class="my-3"><?= $barang->nama_barang; ?></h3>
        <hr>
        <h5>Kategori : <?= $barang->nama_kategori; ?></h5>
        <h5>Bahan : <?= $barang->nama_bahan; ?></h5>
        <h5>Stok : <?= $barang->stok; ?></h5>
        <!-- <p><?= $barang->deskripsi; ?></p> -->
        <hr>
        <div class="bg-gray py-2 px-3 mt-4">
          <h2 class="mb-0">
            Rp. <?= number_format($barang->harga, 0); ?>
          </h2>
        </div>
        <hr>
        <?php
        echo form_open('belanja/add');
        echo form_hidden('id', $barang->id_barang);
        echo form_hidden('price', $barang->harga);
        echo form_hidden('name', $barang->nama_barang);
        echo form_hidden('redirect_page', str_replace('index.php/', '', current_url()));
        ?>
        <div class="mt-4">
          <div class="row">
            <div class="col-sm-2">
              <input type="number" name="qty" class="form-control" value="1" min="1">
            </div>
            <div class="col-sm-8">
              <button type="submit" class="btn btn-primary btn-flat swalDefaultSuccess">
                <i class="fas fa-cart-plus fa-lg mr-2"></i>
                Add to Cart
              </button>
            </div>
          </div>
        </div>

        <?php echo form_close(); ?>

        <div class="mt-4 product-share">
          <a href="#" class="text-gray">
            <i class="fab fa-facebook-square fa-2x"></i>
          </a>
          <a href="#" class="text-gray">
            <i class="fab fa-twitter-square fa-2x"></i>
          </a>
          <a href="#" class="text-gray">
            <i class="fas fa-envelope-square fa-2x"></i>
          </a>
          <a href="#" class="text-gray">
            <i class="fas fa-rss-square fa-2x"></i>
          </a>
        </div>

      </div>
    </div>
    <div class="row mt-4">
      <nav class="w-100">
        <div class="nav nav-tabs" id="product-tab" role="tablist">
          <a class="nav-item nav-link active" id="product-desc-tab" data-toggle="tab" href="#product-desc" role="tab" aria-controls="product-desc" aria-selected="true">Description</a>
          <a class="nav-item nav-link" id="product-rating-tab" data-toggle="tab" href="#product-rating" role="tab" aria-controls="product-rating" aria-selected="false">Rating</a>
        </div>
      </nav>
      <div class="col-lg-12">
        <div class="tab-content p-3" id="nav-tabContent">
          <div class="tab-pane fade show active" id="product-desc" role="tabpanel" aria-labelledby="product-desc-tab"> 
            <?= $barang->deskripsi; ?> 
          </div>
          <div class="tab-pane fade " id="product-rating" role="tabpanel" aria-labelledby="product-rating-tab">
            <div class="col-lg-12 row">

              <div class="col-lg-6 col-xs-12 border-bottom pb-2">
                <?php foreach ($rating as $rate): ?>

                  <strong><?php echo $rate->user ?></strong><br>
                  <?php 
                  for ($i = 1; $i <= 5; $i++) {
                    $checked = $i <= $rate->rating ? "checked":"";
                    echo '<span class="fa fa-star '.$checked.'"></span>';
                  }
                  ?>
                  <br>
                  <p><?php echo $rate->comment ?></p>
                  <hr>
                <?php endforeach ?>
              </div>
              <div class="col-lg-6 col-xs-12 border-bottom pb-2">
                <div class="col-lg-12  p-3" id="komentar">
                  <h3>Komentar</h3>
                  <?php if (strlen($this->session->userdata('nama_pelanggan'))>0){ ?>
                    <form class="row" method="POST" action="<?php echo base_url()."home/comment/".$barang->id_barang ?>">
                      <?php 
                      echo form_hidden('id_barang', $barang->id_barang);
                      ?>
                      <div class="col-md-12 form-group">
                        <label>Rating</label>
                        <div class="rating">
                          <input type="radio" name="rating" value="5" id="sel-rating-5"><label for="sel-rating-5">5</label>
                          <input type="radio" name="rating" value="4" id="sel-rating-4" checked><label for="sel-rating-4">4</label>
                          <input type="radio" name="rating" value="3" id="sel-rating-3"><label for="sel-rating-3">3</label>
                          <input type="radio" name="rating" value="2" id="sel-rating-2"><label for="sel-rating-2">2</label>
                          <input type="radio" name="rating" value="1" id="sel-rating-1"><label for="sel-rating-1">1</label>
                        </div>
                      </div>
                      <div class="col-md-12 form-group">
                        <label>Nama</label>
                        <?php //print_r($this->session->userdata('id_pelanggan'));exit; ?>
                        <input type="text" name="user" placeholder="Komentator" class="form-control" required value="<?php echo @$this->session->userdata('nama_pelanggan') ?>" <?php echo strlen($this->session->userdata('nama_pelanggan'))>0 ? "readonly" : "" ?>>
                      </div>
                      <div class="col-md-12 form-group">
                        <label>Komentar</label>
                        <textarea class="form-control" name="comment" placeholder="Komentar" required></textarea>
                      </div>
                      <div class="col-md-12 form-group">
                        <button type="submit" class="btn btn-primary">Kirim Komentar</button>
                      </div>
                    </form>
                  <?php }else{ ?>
                    <p>Masuk untuk memberikan komentar</p>
                    <a class="nav-link btn btn-primary" href="<?= base_url('pelanggan/login') ?>">
                      <span class="brand-text font-weight-light">Login | Register</span>
                    </a>
                  <?php } ?>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>



<script src="<?= base_url() ?>template/dist/js/demo.js"></script>
<script src="<?= base_url(); ?>template/plugins/sweetalert2/sweetalert2.min.js"></script>
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