@extends('layout')

@section('content')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
<style>
  /* Style the dropdown container */
.dropdown {
  display: inline-block;
  position: relative;
  margin-left: 5%;
}

/* Style the label */
.dropdown label {
  display: block;
  font-weight: bold;
  margin-bottom: 5px;
}

/* Style the dropdown wrapper */
.dropdown-wrapper {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

/* Style the select element */
.dropdown-select select {
  display: block;
  width: 100%;
  padding: 10px;
  border-radius: 5px;
  border: 1px solid #ccc;
  appearance: none;
  background-color: white;
  font-size: 16px;
}

/* Style the dropdown icon */
.dropdown-select i {
  position: absolute;
  top: 50%;
  right: 10px;
  transform: translateY(-50%);
  pointer-events: none;
}

/* Style the submit button */
.dropdown button {
  display: inline-block;
  padding: 10px 20px;
  background-color: #1abc9c;
  border: none;
  color: white;
  font-size: 16px;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.2s ease-in-out;
}

/* Hover styles for the submit button */
.dropdown button:hover {
  background-color: #148f77;
}

  .text-center .progress-bar {
		background-color: #f5f5f5;
		border-radius: 20px;
		box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
		height: 1.5em;
		position: relative;
		overflow: hidden;
		margin: 0 auto;
		width: 80%;
		max-width: 300px;
	}
	.text-center .progress-bar .progress {
		background-color: #7cb342;
		position: absolute;
		top: 0;
		bottom: 0;
		left: 0;
		width: 50%;
		animation: progress-animation 2s ease-out;
		animation-fill-mode: forwards;
	}
    canvas {
        width: 100%;
        height: auto;
        margin-bottom: 10px;
    }

    .kontainer {
        display: flex;
        flex-wrap: wrap;
    }

    .chart-container {
        padding: 10px;
    }

    .chart-container h2 {
        text-align: center;
        margin-bottom: 10px;
    }

    @media only screen and (min-width: 600px) {
        .chart-container {
            width: 50%;
        }
    }

    @media only screen and (min-width: 900px) {
        .chart-container {
            width: 33.33%;
        }
    }
</style>
<main>
    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/list.css') }}" >
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <div class="dropdown">
      <form>
        <label for="select-option">Choose class:</label>
        <div class="dropdown-wrapper">
          <div class="dropdown-select">
            <select id="select-option" name="option">
              <option value="">Choose CLass</option>
              <option value="1">Class 1</option>
              <option value="2">Class 2</option>
              <option value="3">Class 3</option>
              <option value="4">Class 4</option>
              <option value="5">Class 5</option>
              <option value="6">Class 6</option>
              <option value="7">Class 7</option>
              <option value="8">Class 8</option>
              <option value="9">Class 9</option>
              <option value="10">Class 10</option>
              <option value="11">Class 11</option>
              <option value="12">Class 12</option>
            </select>
            {{-- <i class="fa fa-caret-down"></i> --}}
          </div>
          <button type="submit">Submit</button>
        </div>
      </form>
    </div>    
    <div class="kontainer">
        <div class="chart-container">
          <h2>Juzuk 1 -10</h2>
          <canvas id="chart1"></canvas>
        </div>
        <div class="chart-container">
          <h2>Juzuk 11 -20</h2>
          <canvas id="chart2"></canvas>
        </div>
        <div class="chart-container">
          <h2>Juzuk 21 -30</h2>
          <canvas id="chart3"></canvas>
        </div>
      </div>
    <div class="container">
        <div class="row"> 
            <div class="col-lg-12">
                <div class="main-box clearfix">
                    <div class="table-responsive">
                        <div class="input-group">
                            <div class="input-group-btn search-panel">
                              <form action="{{ url()->current() }}">
                                </div>
                                <input type="hidden" name="search_param" value="all" id="search_param">         
                                <input type="text" class="form-control" name="search" id="myInput" placeholder="Search term..." value="{{ request('search') }}">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                                </span>
                            </form>
                        </div>
                        <br>
                        <table class="table user-list">
                          <thead>
                            <tr>
                              <th><span>User</span></th>
                              <th><span>Class</span></th>
                              <th class="text-center"><span>Progress</span></th>
                              <th><span>Juzuk</span></th>
                              <th><span>Update at</span></th>
                            </tr>
                          </thead>
                          <tbody id="myTable">
                            @foreach ($students as $student)
                              @php
                                $latestProgress = $student->learningProgress->last();
                                $latestDate = $latestProgress ? $latestProgress->updated_at->format('Y-m-d') : null;
                              @endphp
                              <tr>
                                <td>
                                  <img src="{{ $student->ProfileImage ? asset('/profileImages/' . $student->ProfileImage) : asset('/images/no-image.jpg') }}">
                                  <a href="/students/learning-progress/{{ $student['id'] }}" class="user-link">{{ $student['FullName'] }}</a><span class="user-subhead">Student</span>
                                </td>
                                <td>
                                  {{ $student->Class_id }}
                                </td>
                                <td class="text-center">
                                  <div class="progress-bar">
                                    <div class="progress" style="width: {{ $latestProgress->percentage }}%;">{{ $latestProgress->percentage }}%</div>
                                  </div>
                                </td>
                                <td>
                                  {{ $latestProgress->juzuk }}
                                </td>
                                <td style="width: 20%;">
                                  {{ $latestDate }}
                                </td>
                              </tr>
                            @endforeach
                          </tbody>
                        </table>
                        
                    </div>
                    <div class="pagination pull-right">
                        {{$students->links()}}
                    </div>
                </div>
            </div>  
        </div>
    </div>
    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script type="text/javascript"></script>
    <script>
        $(document).ready(function(){
          $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
              $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
          });
        });
    </script>
    <script>
        $('.danger').click(function(e){
            e.preventDefault() // Don't post the form, unless confirmed
            if (confirm('Are you sure?')) {
                // Post the form
                $(e.target).closest('form').submit() // Post the surrounding form
            }
        });
    </script>
     <script>
        var data1 = {
          labels: ["Juz 1", "Juz 2", "Juz 3", "Juz 4", "Juz 5", "Juz 6", "Juz 7", "Juz 8", "Juz 9", "Juz 10"],
          datasets: [{
            data: [
              {{$countJuzukTotal[1]}}, 
              {{$countJuzukTotal[2]}}, 
              {{$countJuzukTotal[3]}}, 
              {{$countJuzukTotal[4]}}, 
              {{$countJuzukTotal[5]}}, 
              {{$countJuzukTotal[6]}}, 
              {{$countJuzukTotal[7]}}, 
              {{$countJuzukTotal[8]}}, 
              {{$countJuzukTotal[9]}}, 
              {{$countJuzukTotal[10]}}],
            backgroundColor: ["#FF6384", "#36A2EB", "#FFCE56", "#3cba9f", "#8e5ea2", "#ff8c00","#ff69b4", "#808080", "#a52a2a", "#A0F1EC"]
          }]
        };
    
        var data2 = {
          labels: ["Juz 11", "Juz 12", "Juz 13", "Juz 14", "Juz 15", "Juz 16", "Juz 17", "Juz 18", "Juz 19", "Juz 20"],
          datasets: [{
            data: [
              {{$countJuzukTotal[11]}}, 
              {{$countJuzukTotal[12]}}, 
              {{$countJuzukTotal[13]}}, 
              {{$countJuzukTotal[14]}}, 
              {{$countJuzukTotal[15]}}, 
              {{$countJuzukTotal[16]}}, 
              {{$countJuzukTotal[17]}}, 
              {{$countJuzukTotal[18]}}, 
              {{$countJuzukTotal[19]}}, 
              {{$countJuzukTotal[20]}}],
            backgroundColor: ["#FF6384", "#36A2EB", "#FFCE56", "#3cba9f", "#8e5ea2", "#ff8c00","#ff69b4", "#808080", "#a52a2a", "#A0F1EC"]
          }]
        };
    
        var data3 = {
          labels: ["Juz 21", "Juz 22", "Juz 23", "Juz 24", "Juz 25", "Juz 26", "Juz 27", "Juz 28", "Juz 29", "Juz 30"],
          datasets: [{
            data: [
              {{$countJuzukTotal[21]}}, 
              {{$countJuzukTotal[22]}}, 
              {{$countJuzukTotal[23]}}, 
              {{$countJuzukTotal[24]}}, 
              {{$countJuzukTotal[25]}}, 
              {{$countJuzukTotal[26]}}, 
              {{$countJuzukTotal[27]}}, 
              {{$countJuzukTotal[28]}}, 
              {{$countJuzukTotal[29]}}, 
              {{$countJuzukTotal[30]}}],
            backgroundColor: ["#FF6384", "#36A2EB", "#FFCE56", "#3cba9f", "#8e5ea2", "#ff8c00","#ff69b4", "#808080", "#a52a2a", "#A0F1EC"]
          }]
        };
    
        var options = {
          tooltips: {
            callbacks: {
              label: function(tooltipItem, data) {
                var dataset = data.datasets[tooltipItem.datasetIndex];
                var total = dataset.data.reduce(function(previousValue, currentValue, currentIndex, array) {
                  return previousValue + currentValue;
                });
                var currentValue = dataset.data[tooltipItem.index];
                var percentage = Math.floor(((currentValue/total) * 100)+0.5);
                return percentage + "%";
              }
            }
          }
        };
    
        var chart1 = new Chart($("#chart1"), {
          type: 'pie',
          data: data1,
          options: options
        });
    
        var chart2 = new Chart($("#chart2"), {
          type: 'pie',
          data: data2,
          options: options
        });
    
        var chart3 = new Chart($("#chart3"), {
          type: 'pie',
          data: data3,
          options: options
        });
      </script>
    {{-- @endunless --}}
</main>
@endsection