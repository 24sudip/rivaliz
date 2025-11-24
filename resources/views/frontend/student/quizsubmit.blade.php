@extends('frontend.student.studentmaster')
@section('title', 'Enrolled Courses')
@section('content')

    <style>
        @import url("https://fonts.googleapis.com/css2?family=Hanken+Grotesk:ital,wght@0,100..900;1,100..900&display=swap");

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --bg-left: linear-gradient(to bottom,
                    hsl(252, 100%, 67%) 0%,
                    hsl(241, 81%, 54%) 100%);
            --bg-circle: linear-gradient(to bottom,
                    hsla(256, 72%, 46%, 1) 0%,
                    hsla(241, 72%, 46%, 0) 100%);

            --text-white: hsl(0, 0%, 100%);
            --text-light: hsl(221, 100%, 96%);
            --text-light-blue: hsl(241, 100%, 89%);
            --text-dark: hsl(224, 30%, 27%);

            --text-primary: hsl(0, 0%, 30%);
            --bg-primary: hsl(0, 0%, 66%);

            --font-weight-normal: 500;
            --font-weight-bold: 700;
            --font-weight-extra-bold: 900;

            font-size: 18px;
            font-family: "Hanken Grotesk", sans-serif;
            font-weight: var(--font-weight-normal);
        }

        .reaction {
            --text-primary: hsl(0, 100%, 67%);
            --bg-primary: hsla(0, 100%, 67%, 0.15);
        }

        .memory {
            --text-primary: hsl(39, 100%, 56%);
            --bg-primary: hsla(39, 100%, 56%, 0.15);
        }

        .verbal {
            --text-primary: hsl(166, 100%, 37%);
            --bg-primary: hsla(166, 100%, 37%, 0.15);
        }

        .visual {
            --text-primary: hsl(234, 85%, 45%);
            --bg-primary: hsla(234, 85%, 45%, 0.15);
        }

        html,
        body,
        main,
        .result {
            width: 100%;
        }

        body,
        main,
        .result {
            display: flex;
            flex-direction: column;
        }

        html,
        body {
            min-height: 100vh;
        }

        .result {
            padding: 1.5rem 1.5rem 2.5rem;
            background: var(--bg-left);
            border-radius: 0 0 30px 30px;
            flex-direction: column;
            align-items: center;
        }

        .subtitle {
            font-size: 1rem;
            margin-bottom: 1.5rem;
        }

        .result .subtitle {
            color: var(--text-light-blue);
        }

        .circle {
            width: 150px;
            aspect-ratio: 1 / 1;
            border-radius: 50%;
            background: var(--bg-circle);
            display: grid;
            place-content: center;
        }

        .circle_numbers {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .circle_numbers_result {
            font-size: 3.5rem;
            font-weight: var(--font-weight-extra-bold);
            color: var(--text-white);
        }

        .circle_numbers_total {
            color: var(--text-light-blue);
        }

        .title {
            font-size: 1.5rem;
            margin-top: 1rem;
            color: var(--text-white);
        }

        .paragraph {
            margin-top: 0.5rem;
            color: var(--text-light-blue);
            text-align: center;
        }

        .summary {
            padding: 1.5rem 1.5rem 2.5rem;
        }

        .summary .subtitle {
            color: var(--text-dark);
            font-weight: var(--font-weight-extra-bold);
        }

        .summary_list {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .summary_list_item {
            width: 100%;
            height: 45px;
            padding: 0 0.8rem;
            background-color: var(--bg-primary);
            border-radius: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .summary_list_item_title_container {
            display: flex;
            gap: 0.5rem;
        }

        .summary_list_item_title {
            font-size: 1rem;
            color: var(--text-primary);
        }

        .summary_list_item_result_numbers_result {
            color: var(--text-dark);
            font-weight: var(--font-weight-extra-bold);
        }

        .summary_list_item_result_numbers_total {
            color: var(--text-light-blue);
        }

        .summary_button {
            width: 100%;
            height: 45px;
            margin-top: 1rem;
            background-color: var(--text-dark);
            border-radius: 50px;
            color: var(--text-light);
            font-size: 1rem;
            font-weight: var(--font-weight-bold);
            border: none;
            display: grid;
            place-content: center;
            cursor: pointer;
            transition: 0.25s ease;
        }

        .summary_button:hover {
            background: var(--bg-left);
        }

        @media (min-width: 768px) {
            body {
                justify-content: center;
            }

            main {
                width: fit-content;
                padding: 0;
                margin: 0 auto;
                border-radius: 30px;
                box-shadow: 0px 20px 20px 0px var(--text-light);
                flex-direction: row;
                align-items: stretch;
                justify-content: center;
            }

            .result {
                width: fit-content;
                border-radius: 30px;
                justify-content: center;
            }

            .paragraph {
                width: 250px;
            }

            .summary_list {
                width: 250px;
            }
        }
    </style>

    <div class="container-fluid page-body-wrapper">
        <div class="main-panel">
            <div class="content-wrapper container">
                <main class="bg-white rounded py-4 px-5">
                    <section class="result">
                        <h2 class="subtitle">Your Result</h2>
                        <div class="circle">
                            <p class="circle_numbers">
                                @php $percent = $correct*100/$totalQuestion @endphp
                                <span class="circle_numbers_result">{{ number_format($percent) }}%</span>
                            </p>
                        </div>
                        <h1 class="title">Great</h1>
                        <p class="paragraph">Quiz: {{ $quiz->name }} <br> Duration: {{ $quiz->timer }} </p>
                    </section>
                    <section class="summary">
                        <h2 class="subtitle">Summary</h2>
                        <ul class="summary_list p-0">
                            <li class="summary_list_item visual">
                                <div class="summary_list_item_title_container">
                                    <h3 class="summary_list_item_title">Total Questions</h3>
                                </div>
                                <div class="summary_list_item_result">
                                    <p class="summary_list_item_result_numbers">
                                        <span class="summary_list_item_result_numbers_result">{{ $totalQuestion }}</span>
                                        {{-- <span class="summary_list_item_result_numbers_total">/ 100</span> --}}
                                    </p>
                                </div>
                            </li>

                            <li class="summary_list_item memory">
                                <div class="summary_list_item_title_container">
                                    <h3 class="summary_list_item_title">Answer Submit</h3>
                                </div>
                                <div class="summary_list_item_result">
                                    <p class="summary_list_item_result_numbers">
                                        <span class="summary_list_item_result_numbers_result">{{ $totalAnswer }}</span>
                                        {{-- <span class="summary_list_item_result_numbers_total">/ 100</span> --}}
                                    </p>
                                </div>
                            </li>


                            <li class="summary_list_item verbal">
                                <div class="summary_list_item_title_container">
                                    <h3 class="summary_list_item_title">Correct Answers</h3>
                                </div>
                                <div class="summary_list_item_result">
                                    <p class="summary_list_item_result_numbers">
                                        <span class="summary_list_item_result_numbers_result">{{ $correct }}</span>
                                        {{-- <span class="summary_list_item_result_numbers_total">/ 100</span> --}}
                                    </p>
                                </div>
                            </li>

                            <li class="summary_list_item reaction">
                                <div class="summary_list_item_title_container">
                                    <h3 class="summary_list_item_title">Wrong Answers</h3>
                                </div>
                                <div class="summary_list_item_result">
                                    <p class="summary_list_item_result_numbers">
                                        <span
                                            class="summary_list_item_result_numbers_result">{{ $totalAnswer - $correct }}</span>
                                        {{-- <span class="summary_list_item_result_numbers_total">/ 100</span> --}}
                                    </p>
                                </div>
                            </li>
                        </ul>
                        <a href="{{ route('student.quizanswer', $quiz->id) }}"
                            class="summary_button text-decoration-none text-white">View Answers</a>
                    </section>
                </main>
            </div>

        </div>
    </div>

@endsection
