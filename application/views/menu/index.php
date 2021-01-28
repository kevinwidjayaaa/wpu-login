<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <?= form_error('menu','<div class="alert alert-danger" role="alert">','
                </div>');?>
    <?= $this->session->flashdata('message');?>       
    <a href="" class="btn btn-success mb-3" 
        data-toggle="modal" data-target="#newMenuModal">Add New Menu
    </a>
    <table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Menu</th>
      <th scope="col">Action</th>
      
    </tr>
  <tbody>
    <tr>
    <?php $i=1;?>
    <?php foreach($menu as $m):?>
      <th scope="row"><?=$i;?></th>
      <td colspan="2"> <?=$m['menu'];?></td>
      <td>
      <a href=""class="badge badge-info">edit</a>
        <a href=""class="badge badge-danger">delete</a>
      </td>
    </tr>
    <?php $i++; ?>
    <?php endforeach;?>
  </tbody>
</table>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="newMenuModal" tabindex="-1" role="dialog" aria-labelledby="newMenuModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newMenuModalLabel">Add New Menu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?=base_url('menu');?>" method="post">
      <div class="modal-body">
        <div class="form-group">
        <input type="text" class="form-control" id="menu" name="menu" placeholder="Menu name">
    </div>
        
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Add</button>
      </div>
      </form>
    </div>
  </div>
</div>