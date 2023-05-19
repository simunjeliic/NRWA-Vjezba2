
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="#">Grupa 5</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="{{ url('/') }}">Početna <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('city.index') }}">City</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('country.index') }}">Country</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('countrylanguage.index') }}">Country Language</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.index') }}">Roles</a>
        </li>
    </div>
</nav>
<div class="container mt-2">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>List of countries</h2>
            </div>
            <div class="pull-right mb-2">
                <a class="btn btn-primary" href="{{ route('country.create') }}">Add new country</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <input type="text" name="searchInput" id="searchInput" class="form-control" placeholder="Search Country">
        </div>
    </div>
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Code</th>
                <th>Name</th>
                <th>Continent</th>
                <th>Region</th>
                <th>Population</th>
                <th width="150px">Action</th>
            </tr>
        </thead>
        <tbody id="searchResults">
            @foreach ($countries as $country)
                <tr>
                    <td>{{ $country->Code }}</td>
                    <td>{{ $country->Name }}</td>
                    <td>{{ $country->Continent }}</td>
                    <td>{{ $country->Region }}</td>
                    <td>{{ $country->Population }}</td>
                    <td>
                        <form action="{{ route('country.destroy',$country->Code) }}" method="Post">
                            <a class="btn btn-primary" href="{{ route('country.edit',$country->Code) }}">Edit</a>
                            @csrf
                            @method('DELETE')
                            <!-- button type="submit" class="btn btn-danger">Delete</button -->
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    {{ $countries->links('pagination::bootstrap-4') }}
</div>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    var searchInput = document.getElementById('searchInput');
    var searchResults = document.getElementById('searchResults');

    searchInput.addEventListener('keyup', function () {
        var query = this.value;

        axios.get('{{ route('search') }}', {
            params: {
                query: query
            }
        })
        .then(function (response) {
            var results = response.data;
            var output = '';

            if (results.length === 0) {
                output = '<tr><td colspan="6">No countries found with that name.</td></tr>';
            } else {
                results.forEach(function (result) {
                    output += '<tr>';
                    output += '<td>' + result.Code + '</td>';
                    output += '<td>' + result.Name + '</td>';
                    output += '<td>' + result.Continent + '</td>';
                    output += '<td>' + result.Region + '</td>';
                    output += '<td>' + result.Population + '</td>';
                    output += '<td>';
                    output += '<form action="' + result.delete_route + '" method="Post">';
                    output += '<a class="btn btn-primary" href="' + result.edit_route + '">Edit</a>';
                    output += '@csrf';
                    output += '@method('DELETE')';
                    // output += '<button type="submit" class="btn btn-danger">Delete</button>';
                    output += '</form>';
                    output += '</td>';
                    output += '</tr>';
                });
            }

            searchResults.innerHTML = output;
        })
        .catch(function (error) {
            console.log(error);
        });
    });
</script>




</body>
</html>