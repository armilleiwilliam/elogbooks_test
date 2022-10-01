<div class="col-md-12 text-center">
    @if (isset($errors) && $errors->any())
        <div class="alert alert-danger text-center">
            <div class="nectar-fancy-ul">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li style="list-style-type: none;"><i
                                class="icon-default-style fa-times accent-color"></i>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    @if (Session::has('success'))
        <div class="alert alert-success text-center">
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
