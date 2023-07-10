<!-- modal cetak filter -->          
<div class="modal fade" id="modal-filter">
                      <div class="modal-dialog modal-sm">
                      <div class="modal-content">
                      <div class="modal-header">  

                      <h4 class="modal-title">Cetak Berdasarkan aq<?php echo $_get['cetak_berdasarkan']; ?> </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                      <!-- form start -->
                       <form action="" method="get">
                        <div class="card-body">
                          <div class="form-group">               
                              <label for="barang">Cetak Berdasarkan</label>
                              <select  class="form-control" name="cetak_berdasarkan" aria-label="Default select example" >
                              <option selected>Cetak Berdasarkan</option>
                              <option value="Kode Inventaris">Kode Inventaris</option>
                              <option value="Jenis Barang">Jenis Barang</option>
                              <option value="Nama Barang">Nama Barang</option>
                              <option value="Kode Inventaris">Kode Inventaris</option>
                              <option value="Program">Program</option>
                              <option value="Sub Kegiatan">Sub Kegiatan</option>
                            </select>
                          </div> 
                          </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                         
                          <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-filter<?php echo $_POST['cetak_berdasarkan']; ?>">Simpan</button>
                      </form>
                        </div>                      
                        </div>
                        </div>
                        </div>
                       <!-- end modal cetak filter-->