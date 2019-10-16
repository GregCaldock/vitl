<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .position-ref {
                padding-top: 40px;
                position: relative;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }
            .error {
                font-weight: 600;
                color: red;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            .row {
                width: 100%;
                clear: both;
            }

            .col {
                width: 50%;
                float: left;
                text-align: left;
            }

            .form-group {
                max-width: 500px;
                margin: 30px auto;
            }

            .result-group {
                max-width: 360px;
                margin: auto;
            }

            input {
                display: block;
                box-sizing: border-box;
                width: 100%;
                outline: none;
                border: none;
                border-radius: 0;
                -webkit-appearance: none;
                -moz-appearance: none;
                appearance: none;
            }

            .label, .checkbox-label {
                display: block;
                margin-bottom: 0.25em;
            }

            .input, .checkbox-label:before, .checkbox-label:after {
                padding: 10px;
                border-width: 1px;
                border-style: solid;
                border-color: lightgray;
                background-color: white;
            }
            .input:focus, .checkbox-label:focus:before, .checkbox-label:focus:after {
                border-color: gray;
            }
            .input::-webkit-input-placeholder {
                color: gray;
            }
            .input:-ms-input-placeholder {
                color: gray;
            }
            .input::-ms-input-placeholder {
                color: gray;
            }
            .input::placeholder {
                color: gray;
            }

            .checkbox {
                position: absolute;
                width: auto;
                opacity: 0;
            }
            .checkbox:focus + .checkbox-label:before, .checkbox:focus + .checkbox-label:after {
                border-color: gray;
            }
            .checkbox:checked + .checkbox-label:after {
                opacity: 1;
            }

            .checkbox-label {
                position: relative;
                display: inline-block;
                margin-right: 0.5em;
                padding-left: 28px;
            }
            .checkbox-label:before, .checkbox-label:after {
                position: absolute;
                top: 50%;
                left: 0;
                display: inline-block;
                margin-top: -9px;
                padding: 0;
                width: 18px;
                height: 18px;
                content: "";
            }
            .checkbox-label:after {
                border-color: transparent;
                background-color: transparent;
                background-image: url("data:image/svg+xml,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20version%3D%221.1%22%20x%3D%220%22%20y%3D%220%22%20width%3D%2213%22%20height%3D%2210.5%22%20viewBox%3D%220%200%2013%2010.5%22%20enable-background%3D%22new%200%200%2013%2010.5%22%20xml%3Aspace%3D%22preserve%22%3E%3Cpath%20fill%3D%22%23424242%22%20d%3D%22M4.8%205.8L2.4%203.3%200%205.7l4.8%204.8L13%202.4c0%200-2.4-2.4-2.4-2.4L4.8%205.8z%22%2F%3E%3C%2Fsvg%3E");
                background-position: center;
                background-size: 13px;
                background-repeat: no-repeat;
                opacity: 0;
            }

            .input, .checkbox-label:before, .checkbox-label:after, .checkbox-label {
                margin-bottom: 1em;
            }
            .submit {
                width: auto;
                margin: 10px auto;
                border: 1px solid gray;
                font-size: 1.2rem;
                color: grey;
                border-radius: 3px;
                cursor: pointer;
            }
            .submit:hover {
                background: rgba(0,0,0, 0.2);
            }
        </style>
    </head>
    <body>
        <div class="position-ref full-height">
            <div class="content">
                <div class="title m-b-md">
                    Vitl People Search
                </div>

                <form action="/" method="get">
                    <div class="form-group">
                        <div class="form-item">
                            <label class="label" for="term">Search for people</label>
                            <input class="input" type="text" placeholder="enter first or last name" name="term" id="term">
                            <div class="error" id="error"></div>
                        </div>
                        <div class="form-item">
                            <input class="checkbox" type="checkbox" id="dupes" name="dupes">
                            <label class="checkbox-label" for="dupes">De-dupe search</label>
                        </div>
                        <div class="form-item">
                            <input type="submit" class="submit" value="SEARCH" onclick="search(); return false;">
                        </div>
                    </div>
                </form>

                <div id="results" class="result-group">

                </div>
            </div>
        </div>
    </body>
<script type="application/javascript">
  function search()
  {
    /* clear the search results */
    document.getElementById('results').innerHTML = '';
    document.getElementById('error').innerHTML = '';

    /* set up the form constants */
    const term = document.getElementById('term').value;
    if (term === '') {
      document.getElementById('error').innerHTML = '<p>Please enter a search term</p>';
      return;
    }
    const dupes = document.getElementById('dupes').checked;
    const formData = new FormData();
    formData.append('term', term);
    formData.append('dupes', dupes);

    const xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function()
    {
      if(xmlHttp.readyState === 4 && xmlHttp.status === 200)
      {
        const response = JSON.parse(xmlHttp.responseText);
        let results = '';
        if (response.length < 1) {
          results = 'Sorry, nothing match your search please try again';
        } else {
          response.forEach(function(person) {
            results += '<div class="row"><div class="col">' + person.first_name + '</div><div class="col">' + person.last_name + '</div></div>';
          });
        }
        document.getElementById('results').innerHTML = results;
      }
    }
    xmlHttp.open("post", "/api/search");
    xmlHttp.send(formData);
  }
</script>
</html>
