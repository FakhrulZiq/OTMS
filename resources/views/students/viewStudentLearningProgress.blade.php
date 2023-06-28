@extends('layout')

@section('content')
<title>Student Learning Progress Dashboard</title>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    .containers {
    margin: 50px auto;
    padding: 20px;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
    border-radius: 10px;
    max-width: 80%;
}

.profile {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
}

.profile-image {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    margin-right: 20px;
    object-fit: cover;
}

.progress {
    background-color: #f2f2f2;
    height: 20px;
    width: 100%;
    display: inline-block;
    margin-bottom: 20px;
    position: relative;
    border-radius: 10px;
    overflow: hidden;
}

.progress-bar {
    background-color: #1F6E8C;
    position: absolute;
    top: 0;
    left: 0;
    width: 0%;
    height: 100%;
    border-radius: 10px;
    transition: width 0.3s ease-in-out;
}

select {
    padding: 10px;
    border-radius: 5px;
    border: none;
    background-color: #f2f2f2;
    font-size: 16px;
    margin-right: 10px;
    color: #1F6E8C;
}

#customers {
    font-family: Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 80%;
    margin-left: auto;
    margin-right: auto;
    margin-bottom: 50px;
    margin-top: 30px;
}

#customers td,
#customers th {
    border: 1px solid #ddd;
    padding: 8px;
}

#customers tr:nth-child(even) {
    background-color: #f2f2f2;
}

#customers tr:hover {
    background-color: #ddd;
}

#customers th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #1F6E8C;
    color: white;
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
    background-color: #1F6E8C;
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    width: 50%;
    animation: progress-animation 2s ease-out;
    animation-fill-mode: forwards;
}

@keyframes progress-animation {
    0% {
        width: 0;
    }
}

</style>
</head>
<h4 style="margin-left: 10%"><a href="{{ url()->previous() }}"><i class="fa fa-angle-double-left" style="font-size:25px;"></i> Back</a></h4>
<h2 style="margin-left: 10%">Student Learning Progress</h2>

<div class="containers">
    <div class="profile">
        <img class="profile-image" src="{{$student->ProfileImage ? asset('/profileImages/' .$student->ProfileImage) : asset('/images/no-image.jpg')}}" alt="Profile Image">
        <div>
            <h2>{{$student->FullName}}</h2>
            <p>Teacher: {{$teacher->FullName}}</p>
            <p>Last Update: {{ date('d-m-Y', strtotime($learningProgress->updated_at)) }}</p>
        </div>
    </div>
    <div class="progress">
        <div class="progress-bar" id="progress-bar" role="progressbar" style="width: {{ $learningProgress->percentage }}%;" aria-valuenow="{{ $learningProgress->percentage }}" aria-valuemin="0" aria-valuemax="100">{{ $learningProgress->percentage }}%</div>
    </div>
    <div>
        <label for="chapter-select"><h4>Juzuk:</h4></label>
        <select name="juzuk" id="chapter-select" disabled>
            <option value="">Juzuk {{$learningProgress->juzuk}}</option>
        </select>
        <label for="page-select"><h4>Page:</h4></label>
        <select name="page" id="page-select" disabled>
            <option value="">Page {{$learningProgress->page}}</option>
        </select>
    </div>
</div>

<h3 style="margin-left: 10%">History</h3>
<table id="customers">
    <tr>
        <th>Progress</th>
        <th>Juzuk</th>
        <th>Page</th>
        <th>Time update</th>
    </tr>
    @foreach($student->learningProgress()->orderBy('updated_at', 'desc')->get() as $progress)
        <tr>
            <td class="text-center">
                <div class="progress-bar">
                    <div class="progress" style="width: {{ $progress->percentage }}%;">{{ $progress->percentage }}%</div>
                </div>
            </td>
            <td>{{ $progress->juzuk }}</td>
            <td>{{ $progress->page }}</td>
            <td>{{ date('d-m-Y', strtotime($progress->updated_at)) }}</td>
        </tr>
    @endforeach
</table>
{{ $student->learningProgress()->orderBy('updated_at', 'desc')->paginate(10)->links() }}

  <canvas id="myChart" style="width:100%;max-width:600px; margin: 0 auto; margin-top:"></canvas>
  <h1 style="padding-bottom: 50px;"></h1>
  <script>
    const xValues = [1,2,3,4,5,6,7,8,9,10,11,12];
    const yValues = [1,2,4,4, {{$learningProgress->juzuk}}];

    new Chart("myChart", {
      type: "line",
      data: {
        labels: xValues,
        datasets: [{
          fill: false,
          lineTension: 0,
          backgroundColor: "rgba(0,0,255,1.0)",
          borderColor: "rgba(0,0,255,0.1)",
          data: yValues
        }]
      },
      options: {
        legend: {display: false},
        scales: {
          yAxes: [{ticks: {min: 1, max:30}}],
        }
      }
    });
</script>
<script>
    const chapterSelect = document.getElementById('chapter-select');
    const pageSelect = document.getElementById('page-select');
    const progressBar = document.getElementById('progress-bar');

    chapterSelect.addEventListener('change', () => {
        // Get the selected chapter number
        const chapter = chapterSelect.value;

        // Clear the page select dropdown
        pageSelect.innerHTML = '<option value="">Select Page</option>';

        // Disable the page select dropdown if no chapter is selected
        if (!chapter) {
            pageSelect.disabled = true;
            return;
        }

        // Populate the page select dropdown based on the selected chapter
        for (let i = 1; i <= 20; i++) {
            const option = document.createElement('option');
            option.value = (chapter - 1) * 20 + i;
            option.text = `Page ${(chapter - 1) * 20 + i}`;
            pageSelect.add(option);
        }

        // Enable the page select dropdown
        pageSelect.disabled = false;
    });

    pageSelect.addEventListener('change', () => {
        // Get the selected page number
        const page = pageSelect.value;

        // Calculate the progress as a percentage
        const progress = page / 600 * 100;

        // Update the progress bar width
        progressBar.style.width = `${progress}%`;
    });
</script>
@endsection
