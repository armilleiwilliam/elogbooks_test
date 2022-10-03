<div class="col-md-12 text-center mb-1">

    <!-- Report any error -->
    @if (isset($errors) && $errors->any())
        <div class="alert alert-danger text-center m-auto w-75 h-25  text-center">
            <div class="nectar-fancy-ul">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li style="list-style-type: none; text-align: center;">
                            <i class="icon-default-style fa-times accent-color"></i>{{ $error }}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <!-- Report any success message -->
    @if (Session::has('success'))
        <div class="alert alert-success text-center" role="alert">{{ Session::get('success') }}</div>
    @endif
</div>
