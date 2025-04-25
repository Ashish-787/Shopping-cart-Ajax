<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body class="bg-light">

        @if(Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif

        @if(Session::has('error'))
            <div class="alert alert-danger">
                {{ Session::get('error') }}
            </div>
        @endif

    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="card p-4 shadow-lg"  style="width: 350px;">
            
        <h3 class="text-center mb-3">Register</h3>
            <form action="{{route('registerStore')}}" method="Post">
                @csrf
                <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Enter your name" required>
                @error('name')
                   <p style="color:red;">{{$message}}</p>
                @enderror
               </div>

                <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="Enter your email" required>
                @error('email')
                   <p style="color:red;">{{$message}}</p>
                @enderror
                </div>

                <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Enter your password" required>
              
                @error('password')
                    <p style="color: red;">{{ $message }}</p>
                @enderror
                
                </div>


                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Confirm Password" required>
                    @error('password_confirmation')
                        <p style="color:red;">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary w-100">Submit</button>
                <p class="text-center mt-2">
                    <a href="#">login</a>
                </p>
            </form>



        </div>

    </div>



           

            <!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

        
    </body>
</html>