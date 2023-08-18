<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>File Sharing</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/assets/favicon.ico') }}" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Tinos:ital,wght@0,400;0,700;1,400;1,700&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&amp;display=swap"
        rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>







    <!-- Background Video-->
    <video class="bg-video" playsinline="playsinline" autoplay="autoplay" muted="muted" loop="loop">
        <source src="{{ asset('assets/assets/mp4/bg.mp4') }}" type="video/mp4" />
    </video>
    <!-- Masthead-->
    <div class="masthead">
        <div class="masthead-content text-white">
            <div class="container-fluid px-4 px-lg-0">
                <h1 class="fst-italic lh-1 mb-4">Welcome to Your File Sharing App</h1>
                <p class="mb-5">Share and download files securely and easily.</p>


                <form method="POST" action="{{ route('upload') }}" enctype="multipart/form-data">
                    @csrf

                    <!-- Email address input-->
                    <div class="row input-group-newsletter">
                        <div class="col">
                            <input class="form-control @error('file') is-invalid @enderror" id="file"
                                type="file" name="file" required />
                            @error('file')
                                <small class="feedback-invalid">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-auto">
                            <button class="btn btn-primary " id="submitButton" type="submit">Upload</button>
                        </div>

                    </div>

                    <div class="">
                        <div class="text-center mb-3 mt-2">
                            <div class="fw-bolder"><a href="{{ route('files') }}">See your uploaded files</a></div>

                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>


    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="{{ asset('assets/js/scripts.js') }}"></script>

    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
