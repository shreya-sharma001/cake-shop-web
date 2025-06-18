<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Students Data</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col">
                <table class="table table-responsive-lg">
                    <thead>
                      <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Class</th>
                        <th scope="col">Requirements</th>
                        <th scope="col">Edit Student</th>
                        <th scope="col">Delete Student</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($userscake as $u)
                        <tr>
                            <th scope="row">{{$u->id}}</th>
                            <td>{{$u->name}}</td>
                            <td>{{$u->phone}}</td>
                            <td>{{$u->class}}</td>
                            <td>{{$u->requirements}}</td>
                            <td><a class="btn btn-primary" href="{{ route('editCakeUsers', ['id' => $u->id]) }}">Edit Users</a></td>
                            <td><a class="btn btn-primary" href="{{ route('deleteUsers', ['id' => $u->id]) }}">Delete Users</a></td>
                          </tr>
                        @endforeach

                    </tbody>
                  </table>
              </div>
        </div>
    </div>

</body>
</html>
