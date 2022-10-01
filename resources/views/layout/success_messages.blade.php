<div class="col-md-12 text-center mb-1">

    <!-- Report any error -->
    @if (isset($errors) && $errors->any())
        <div class="alert alert-danger text-center m-auto w-75 h-25">
            <div class="nectar-fancy-ul">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li style="list-style-type: none;">
                            <i class="icon-default-style fa-times accent-color"></i>{{ $error }}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <!-- Report any success message -->
    @if (Session::has('success'))
        <div class="alert alert-success text-center m-auto w-75 h-25">
            <div class="nectar-fancy-ul">
                <ul>
                    <li style="list-style-type: none;">
                        <i class="icon-default-style fa-times accent-color"></i>{{ Session::get('success') }}
                    </li>
                </ul>
            </div>
        </div>
    @endif
</div>
