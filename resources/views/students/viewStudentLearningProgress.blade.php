@extends('layout')

@section('content')
<title>Student Learning Progress Dashboard</title>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="{{ asset('css/studentLearningProgress.css') }}">

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

<h3 style="margin-left: 10%">Record Chart for 2023</h3>
  <div class="chart-card">
    <canvas id="myChart" style="width:100%;max-width:1000px;"></canvas>
  </div>
  <h1 style="padding-bottom: 50px;"></h1>
  <script>
    const xValues = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    const yValues = [
        @foreach ($juzukData as $month => $juzuk)
            {{ $juzuk ?? 'null' }},
        @endforeach
    ];

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
