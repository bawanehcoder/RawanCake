<!DOCTYPE html>
<html lang="{{ \Config::get('app.locale') == 'en' ? 'en' : 'ar' }}" dir="{{ \Config::get('app.locale') == 'en' ? 'ltr' : 'rtl' }}">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@langucw('reset password')</title>
    @include('admin.layout.head')
</head>

<body >
<div class="container d-flex flex-column">
    <div class="row align-items-center justify-content-center
          min-vh-100">
        <div class="col-12 col-md-8 col-lg-4">
            <div class=" card table-list-card shadow-sm">
                <div class=" card-body table-list-card-body">
                    <div class="mb-4">
                        <h5>@langucw('reset password')</h5>

                    </div>
                    <form>
                        <div class="mb-3">
                            <label for="email" class="form-label">@langucw('email')</label>
                            <input type="email" id="email" class="form-control" name="email" placeholder="@langucw('your email') " required="">
                        </div>
                        <div class="mb-3 d-grid"><button type="submit" class="btn btn-primary">@langucw('reset password')</button></div>
                        <span> <a href="{{route('dashboard.login')}}">@langucw('log in')</a></span>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

</html>
