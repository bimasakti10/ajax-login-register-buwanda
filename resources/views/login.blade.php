<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login Akun</title>
</head>
<body>

<div class="container" style="margin-top: 50px">
    <div class="row">
        <div class="col-md-5 offset-md-3">
            <div class="card">
                <div class="card-body">
                    <label>LOGIN</label>
                    <hr>

                    <div class="form-group">
                        <label>Alamat Email</label>
                        <input type="email" class="form-control" id="email" placeholder="Masukkan Alamat Email">
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" id="password" placeholder="Masukkan Password">
                    </div>

                    <button class="btn btn-login btn-block btn-success">LOGIN</button>

                </div>
            </div>

            <div class="text-center" style="margin-top: 15px">
                Belum punya akun? <a href="{{ route('register.index') }}">Silahkan Register</a>
            </div>

        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {

    $(".btn-login").click(function() {

        var email = $("#email").val();
        var password = $("#password").val();
        var token = $("meta[name='csrf-token']").attr("content");

        if(email === "") {
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'Alamat Email Wajib Diisi !'
            });
            return;
        }

        if(password === "") {
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'Password Wajib Diisi !'
            });
            return;
        }

        $.ajax({
            url: "{{ route('login.check') }}", // sesuai web.php
            type: "POST",
            dataType: "JSON",
            cache: false,
            data: {
                email: email,
                password: password,
                _token: token
            },

            success: function(response){
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Login Berhasil!',
                        text: 'Anda akan diarahkan dalam 3 detik',
                        timer: 3000,
                        showCancelButton: false,
                        showConfirmButton: false
                    }).then(function() {
                        window.location.href = "{{ route('dashboard.index') }}";
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Login Gagal!',
                        text: response.message || 'Silahkan coba lagi!'
                    });
                }
                console.log(response);
            },

            error: function(response){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops!',
                    text: 'Server error!'
                });
                console.log(response);
            }
        });

    });

});
</script>

</body>
</html>