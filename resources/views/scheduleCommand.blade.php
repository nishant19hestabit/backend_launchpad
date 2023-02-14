<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Schedule Command!</title>
</head>

<body>
    <div class="container">
        <div class="row justify-content-end">
            <div class="col-lg-2">
                <a href="{{ url('/') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Go to homepage</a>
            </div>
        </div>
        <div class="row justify-content-center">

            <div class="col-lg-3">
                @include('errors')
                <h1 class="bg-info text-center text-white">Schedule Command!</h1>
                <form action="{{url('command-save')}}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Command</label>
                        <select name="command" class="form-control" required>
                            @if(count($commands)>0)
                            <option value="">Select</option>
                            @foreach($commands as $command)
                            <option value="{{$command->id}}">{{ucfirst($command->name)}}</option>
                            @endforeach
                            @else
                            <option value="">Select</option>
                            @endif
                        </select>
                        @error('command')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Schedule At</label>
                        <input type="time" class="form-control @error('time') is-invalid @enderror" name="time" value="{{old('time')}}" required>
                        @error('time')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>