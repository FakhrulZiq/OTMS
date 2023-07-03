@extends('layout')

@section('content')
<head>
    <title>Student Learning Progress Dashboard</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/studentLearningProgress.css') }}">
</head>
<h4 style="margin-left: 10%;"><a href="{{ url()->previous() }}"><i class="fa fa-angle-double-left" style="font-size:25px;"></i> Back</a></h4>
<h2 style="margin-left: 10%">Student Learning Progress</h2>

<form method="POST" action="/students/learning-progress" enctype="multipart/form-data">
    @csrf
    <div class="containers">
        <div class="profile">
            <img class="profile-image" src="{{$student->ProfileImage ? asset('/profileImages/' .$student->ProfileImage) : asset('/images/no-image.jpg')}}" alt="Profile Image">
            <div>
                <h2>{{$student->FullName}}</h2>
                <p>Teacher: {{$teacher->FullName}}</p>
                <p>Last Update: {{ date('d-m-Y', strtotime($learningProgress->updated_at)) }}</p>
                <p>Class {{ $class->className}}</p>
            </div>
        </div>
        <input type="hidden" name="students_id" value="{{$student->id}}">
        <input type="hidden" name="class_id" value="1">
        <div class="progress">
            <div class="progress-bar" id="progress-bar" role="progressbar" style="width: {{ $learningProgress->percentage }}%;" aria-valuenow="{{ $learningProgress->percentage }}" aria-valuemin="0" aria-valuemax="100">{{ $learningProgress->percentage }}%</div>
        </div>
        <div>
            <label for="chapter-select"><h4>Juzuk:</h4></label>
            <select name="juzuk" id="chapter-select">
                <option value="" disabled selected>Juzuk {{$learningProgress->juzuk}}</option>
                <option value="1">Juzuk 1</option>
                <option value="2">Juzuk 2</option>
                <option value="3">Juzuk 3</option>
                <option value="4">Juzuk 4</option>
                <option value="5">Juzuk 5</option>
                <option value="6">Juzuk 6</option>
                <option value="7">Juzuk 7</option>
                <option value="8">Juzuk 8</option>
                <option value="9">Juzuk 9</option>
                <option value="10">Juzuk 10</option>
                <option value="11">Juzuk 11</option>
                <option value="12">Juzuk 12</option>
                <option value="13">Juzuk 13</option>
                <option value="14">Juzuk 14</option>
                <option value="15">Juzuk 15</option>
                <option value="16">Juzuk 16</option>
                <option value="17">Juzuk 17</option>
                <option value="18">Juzuk 18</option>
                <option value="19">Juzuk 19</option>
                <option value="20">Juzuk 20</option>
                <option value="21">Juzuk 21</option>
                <option value="22">Juzuk 22</option>
                <option value="23">Juzuk 23</option>
                <option value="24">Juzuk 24</option>
                <option value="25">Juzuk 25</option>
                <option value="26">Juzuk 26</option>
                <option value="27">Juzuk 27</option>
                <option value="28">Juzuk 28</option>
                <option value="29">Juzuk 29</option>
                <option value="30">Juzuk 30</option>
            </select>
            <label for="page-select"><h4>Page:</h4></label>
            <select name="page" id="page-select" disabled>
                <option value="">Page {{$learningProgress->page}}</option>
            </select>
        </div>
        <div style="text-align: right;">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</form>
<h3 style="margin-left: 10%">History</h3>
<table id="customers">
    <tr>
        <th>Progress</th>
        <th>Juzuk</th>
        <th>Page</th>
        <th>Time update</th>
        <th style="width: 10%">Action</th>
    </tr>
    @foreach($student->learningProgress()->orderBy('updated_at', 'desc')->paginate(10) as $progress)
        <tr>
            <td class="text-center">
                <div class="progress-bar">
                    <div class="progress" style="width: {{ $progress->percentage }}%;">{{ $progress->percentage }}%</div>
                </div>
            </td>
            <td>{{ $progress->juzuk }}</td>
            <td>{{ $progress->page }}</td>
            <td>{{ date('d-m-Y', strtotime($progress->updated_at)) }}</td>
            <td>
                <form method="POST" action="/students/learning-progress/{{$progress->id}}" id="deleteForm_{{$progress->id}}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm deleteBtn" data-form-id="deleteForm_{{$progress->id}}">
                        Delete
                    </button>
                </form>
            </td>
        </tr>
    @endforeach
</table>
<div class="pagination-container">
    <div class="pagination-links">
        {{ $student->learningProgress()->orderBy('updated_at', 'desc')->paginate(10)->links() }}
    </div>
</div>


<h3 style="margin-left: 10%">Chart Record for 2023</h3>
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
<script>
    // Add event listener to delete buttons
    const deleteButtons = document.querySelectorAll('.deleteBtn');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault();
            const formId = button.getAttribute('data-form-id');
            const confirmation = confirm('Are you sure you want to delete this Learning Progress?');
            if (confirmation) {
                document.getElementById(formId).submit();
            }
        });
    });
</script>
@endsection
