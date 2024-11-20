<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=base_url('assets/admin')?>/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?=base_url('assets/admin')?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url('assets/admin')?>/dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><b>HOTEL</b>REZ</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form>
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Username" id="username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" id="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Giriş Yap</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mb-1">
        <a href="forgot-password.html">Şifremi Unuttum?</a>
      </p>

    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?=base_url('assets/admin')?>/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?=base_url('assets/admin')?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?=base_url('assets/admin')?>/dist/js/adminlte.min.js"></script>

<!-- AJAX -->

<script>
    $(document).ready(function() {
   
    $('form').on('submit', function(e) {
        e.preventDefault(); 

        
        var username = $('#username').val();
        var password = $('#password').val();

        // AJAX isteği
        $.ajax({
            url: '<?= base_url('admin/login') ?>',
            method: 'POST',
            data: {
                username: username,
                password: password
            },
            success: function(response) {
                // Başarılı yanıt durumu
                if (response.success) {
                    localStorage.setItem('authToken', response.token)
                    alert('Giriş başarılı!');
                    // Başarılı girişte yapılacak işlem (örneğin, yönlendirme)
                    window.location.href = '<?=base_url('admin')?>';
                } else {
                    // Başarısız giriş
                    alert(response.message || 'Giriş başarısız. Lütfen bilgilerinizi kontrol edin.');
                }
            },
            error: function(xhr, status, error) {
                // Hata durumu
                console.error('Hata:', error);
                alert('Bir hata oluştu. Lütfen daha sonra tekrar deneyin.');
            }
        });
    });
});

</script>


</body>
</html>
