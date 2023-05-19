<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
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
                <h2>List of countries and languages</h2>
            </div>
        </div>
    </div>
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif
    <div class="row">
        <div class="col-md-6">
            <input type="text" name="searchInput" id="searchInput" class="form-control" placeholder="Search CountryLanguage">
        </div>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Country Code</th>
                <th>Language</th>
                <th>Is official</th>
                <th>Percentage</th>
            </tr>
        </thead>
        <tbody id="searchResults">
            @foreach ($Countrylanguage as $countrylanguage)
            <tr>
                <td>{{ $countrylanguage->CountryCode }}</td>
                <td>{{ $countrylanguage->Language }}</td>
                <td>{{ $countrylanguage->IsOfficial }}</td>
                <td>{{ $countrylanguage->Percentage }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $Countrylanguage->links('pagination::bootstrap-4') }}
</div>

<!-- Include Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    var searchInput = document.getElementById('searchInput');
    var searchResults = document.getElementById('searchResults');

    searchInput.addEventListener('keyup', function () {
        var query = this.value;

        fetch('{{ route('lsearch') }}?query=' + query)
            .then(function (response) {
                return response.json();
            })
            .then(function (results) {
                var output = '';

                if (results.length === 0) {
                    output = '<tr><td colspan="4">No countries found with that name.</td></tr>';
                } else {
                    results.forEach(function (result) {
                        output += '<tr>';
                        output += '<td>' + result.CountryCode + '</td>';
                        output += '<td>' + result.Language + '</td>';
                        output += '<td>' + result.IsOfficial + '</td>';
                        output += '<td>' + result.Percentage + '</td>';
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
