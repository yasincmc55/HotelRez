<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>KULLANICI YÖNETİMİ</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Yönetim Paneli</a></li>
            <li class="breadcrumb-item active">Kullanıcı Yönetimi</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>


  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">KULLANICILAR</h3>

              <div class="card-tools d-flex">
                <button type="button" class="btn btn-primary mr-2" data-toggle="modal"
                  data-target="#addRoomModal">Kullanıcı Ekle</button>
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                  <div class="input-group-append">
                    <button type="submit" class="btn btn-default">
                      <i class="fas fa-search"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0" style="height: 300px;">
              <table class="table table-head-fixed text-nowrap">
                <thead>
                  <tr>
                    <th>Order</th>
                    <th>Name-Surname</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Role</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($users as $user): ?>
                    <tr>
                    <td>1</td>
                    <td><?=$user['first_name']." ".$user['last_name'] ?></td>
                    <td><?=$user['email']?></td>
                    <td><?=$user['phone']?></td>
                    <td><?=$user['role']?></td>
                    <td>
                      <!-- Edit button triggers a modal -->
                      <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                        data-target="#editUserModal" data-id="<?= $user['id'] ?>">
                        <i class="fas fa-edit"></i> Düzenle
                      </button>
                      <!-- Delete button sends a delete request -->
                      <button type="button" class="btn btn-danger btn-sm" onclick="deleteUser(<?= $user['id'] ?>)">
                        <i class="fas fa-trash"></i> Sil
                      </button>
                    </td>
                  </tr>
                  <?php endforeach; ?>

                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->

      <!-- Oda Ekle Modal -->
      <div class="modal fade" id="addRoomModal" tabindex="-1" aria-labelledby="addRoomModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="addRoomModalLabel"> Ekle</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body">
        <div class="form-group">
            <label for="username">Kullanıcı Adı</label>
            <input type="text" class="form-control" id="username" placeholder="Kullanıcı Adı" required>
        </div>

        <div class="form-group">
            <label for="email">E-posta</label>
            <input type="email" class="form-control" id="email" placeholder="E-posta" required>
        </div>

        <div class="form-group">
            <label for="password">Şifre</label>
            <input type="password" class="form-control" id="password" placeholder="Şifre" required>
        </div>

        <div class="form-group">
            <label for="first_name">Ad</label>
            <input type="text" class="form-control" id="first_name" placeholder="Ad" required>
        </div>

        <div class="form-group">
            <label for="last_name">Soyad</label>
            <input type="text" class="form-control" id="last_name" placeholder="Soyad" required>
        </div>

        <div class="form-group">
            <label for="phone">Telefon</label>
            <input type="tel" class="form-control" id="phone" placeholder="Telefon">
        </div>

        <div class="form-group">
            <label for="role">Rol</label>
            <select class="form-control" id="role" required>
                <option value="admin">Admin</option>
                <option value="user">Kullanıcı</option>
            </select>
        </div>

        <div class="form-group">
            <label for="status">Durum</label>
            <select class="form-control" id="status" required>
                <option value="1">Aktif</option>
                <option value="0">Pasif</option>
            </select>
        </div> 
    </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
          <button type="button" class="saveButton btn btn-primary">Kaydet</button>
      </div>

      </div>
    </div>
  </div>

</div>

<script>
    $(document).ready(function () {
        $('.saveButton').click(function () {
           
            var formData = {
                username: $('#username').val(),
                email: $('#email').val(),
                password: $('#password').val(),
                first_name: $('#first_name').val(),
                last_name: $('#last_name').val(),
                phone: $('#phone').val(),
                role: $('#role').val(),
                status: $('#status').val()  
            };
          
            $.ajax({
                url: '<?= base_url("/admin/user-add"); ?>',
                type: 'POST',
                data: JSON.stringify(formData),
                contentType: 'application/json',
                dataType: 'json',
                success: function (response) {
                    console.log(response);
                },
                error: function (xhr, status, error) {
                  
                    console.error("Hata:", error);
                    
                }
            });
        });
    });
</script>
