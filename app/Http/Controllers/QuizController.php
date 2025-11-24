<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\{Quiz, McqQuestion};
use App\Models\QuizCategory;
use App\Models\Course;
use App\Models\Category;
use App\Models\Slider;
use App\Models\Page;
use App\Models\Subcategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Quizsubmit;
use App\Models\QuizsubmitAnswer;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Enroll;
use App\Models\Ebookenroll;
use App\Models\Ebook;
use Illuminate\Support\Carbon;

class QuizController extends Controller
{
    public function quiz()
    {
        $quiz = Quiz::with('questions.options')->get();
        return response()->json([
            'data' => $quiz
        ]);
    }

    public function quizcatgeory() {
        // Load quiz categories with subcategory quiz counts
        $data = QuizCategory::with([
            'subcategories' => function ($query) {
                $query->withCount('quiz');
            },
            'quiz' // load quizzes (but not questions yet)
        ])->withCount('quiz')->get();

        if ($data->isEmpty()) {
            return response()->json([
                'message' => 'No data found',
            ], 404);
        }

        // Add pagination: 100 questions per quiz
        foreach ($data as $category) {
            foreach ($category->quiz as $quiz) {
                $quiz->questions = McqQuestion::with('options')
                    ->where('quiz_id', $quiz->id)
                    ->paginate(100);
            }
        }

        // Return JSON
        return response()->json([
            'message' => 'Data retrieved successfully',
            'quizcategories' => $data,
        ], 200);
    }

    // public function quizcatgeory() {
    //     $data = QuizCategory::with([
    //         'subcategories' => function ($query) {
    //             $query->withCount('quiz'); // This adds `quiz_count` to each subcategory
    //         }
    //     ])->with('quiz.questions.options')->withCount('quiz')->get();

    //     if ($data->isEmpty()) {
    //         return response()->json([
    //             'message' => 'No  data found',
    //         ], 404);
    //     }

    //     return response()->json([
    //         'message' => 'Data retrieved successfully',
    //         'quizcategories' => $data,
    //     ], 200);
    // }

    // $categories = QuizCategory::with([
    //     'subcategories.quiz.questions.options'
    // ])->get();

    // if ($categories->isEmpty()) {
    //     return response()->json([
    //         'message' => 'No data found',
    //     ], 404);
    // }

    // // Add quiz count manually
    // $categories->each(function ($category) {
    //     $category->quiz_count = $category->subcategories->sum(function ($subcat) {
    //         return $subcat->quiz->count();
    //     });
    // });

    // return response()->json([
    //     'message' => 'Data retrieved successfully',
    //     'data' => $categories,
    // ], 200);



public function quizcatgeoryCOUNT()
{
    $categories = QuizCategory::with([
        'quiz.questions.options',
        'subcategories.quiz.questions.options',
    ])->get();

    if ($categories->isEmpty()) {
        return response()->json([
            'message' => 'No data found',
        ], 404);
    }

    $data = $categories->map(function ($category) {
        $categoryQuestionCount = 0;

        // Count questions in quizzes directly under this category
        foreach ($category->quiz as $quiz) {
            $categoryQuestionCount += $quiz->questions->count();
        }

        // Enhance subcategories with their own question count
        $subcategories = $category->subcategories->map(function ($subcategory) use (&$categoryQuestionCount) {
            $subQuestionCount = 0;

            foreach ($subcategory->quiz as $quiz) {
                $subQuestionCount += $quiz->questions->count();
            }

            // Add to the parent category's total
            $categoryQuestionCount += $subQuestionCount;

            return [
                'id' => $subcategory->id,
                'name' => $subcategory->name,
                'question_count' => $subQuestionCount,
                'quizzes' => $subcategory->quiz,
            ];
        });

        return [
            'id' => $category->id,
            'name' => $category->name,
            'question_count' => $categoryQuestionCount,
            'quizzes' => $category->quiz,
            'subcategories' => $subcategories,
        ];
    });

    return response()->json([
        'message' => 'Data retrieved successfully',
        'data' => $data,
    ],200);
}

    public function catgeorywiseqquiz($id) {
        // Get quizzes
        $quizzes = Quiz::where('category_id', $id)->get();

        if ($quizzes->isEmpty()) {
            return response()->json([
                'message' => 'No data found',
            ], 404);
        }

        // Paginate questions for each quiz
        foreach ($quizzes as $quiz) {
            $quiz->questions = McqQuestion::with('options')
                ->where('quiz_id', $quiz->id)
                ->paginate(100);   // ⬅️ pagination here
        }

        return response()->json([
            'message' => 'Data retrieved successfully',
            'quizzes_of_category' => $quizzes
        ], 200);
    }

    // public function catgeorywiseqquiz($id){
    //     $data =   Quiz::with('questions.options')->where('category_id', $id)->get();
    //     if ($data->isEmpty()) {
    //         return response()->json([
    //             'message' => 'No  data found',
    //         ], 404);
    //     }
    //     return response()->json([
    //         'message' => 'Data retrieved successfully',
    //         'quizzes_of_category' => $data
    //     ], 200);
    // }

    public function subcatgeorywiseqquiz($id) {
        $data = Quiz::with('questions.options')
            ->where('subcategory_id', $id)
            ->get();

        if ($data->isEmpty()) {
            return response()->json([
                'message' => 'No data found',
                'quiz_count' => 0,
            ], 404);
        }

        return response()->json([
            'message' => 'Data retrieved successfully',
            'quiz_count' => $data->count(),
            'quizzes_of_subcategory' => $data
        ], 200);
    }


    // , 'lesson.module.course'
    public function calculateScore($quizId, Request $request) {
        $quiz = Quiz::with(['questions.options'])->findOrFail($quizId);
        $score = 0;
        $totalPoints = 0;

        $student = auth('api')->user();

        if (!$student) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // ✅ Check if the student already attempted this quiz
        // $alreadySubmitted = Quizsubmit::where('student_id', $student->id)
        //     ->where('quiz_id', $quizId)
        //     ->exists();

        // if ($alreadySubmitted) {
        //     return response()->json([
        //         'message' => 'You have already attempted this exam. Submission not allowed.',
        //     ], 403); // Forbidden
        // }

        // Process answers
        $answersData = [];

        foreach ($request->input('answers') as $answer) {
            $question = $quiz->questions->where('id', $answer['question_id'])->first();

            if ($question) {
                $correctOption = $question->options->where('isAnswer', 1)->first();
                $isRight = $correctOption && $answer['selected_option_id'] == $correctOption->id;

                if ($isRight) {
                    $score++;
                }

                $totalPoints++;

                $answersData[] = [
                    'question_id'  => $answer['question_id'],
                    'option_id'    => $answer['selected_option_id'],
                    'right_option' => $correctOption ? $correctOption->id : null,
                    'isRight'      => $isRight,
                ];
            }
        }

        $percentage = $totalPoints > 0 ? ($score / $totalPoints) * 100 : 0;
        $formattedScore = "{$score}/{$totalPoints}";

        // ✅ Store to quizsubmits table
        $quizSubmit = Quizsubmit::create([
            'student_id'    => $student->id,
            'quiz_id'       => $quizId,
            'totalquestion' => $totalPoints,
            'rightanswer'   => $score,
        ]);

        // ✅ Store individual answers
        foreach ($answersData as $data) {
            QuizsubmitAnswer::create([
                'student_id'   => $student->id,
                'quiz_id'      => $quizId,
                'question_id'  => $data['question_id'],
                'option_id'    => $data['option_id'],
                'right_option' => $data['right_option'],
                'isRight'      => $data['isRight'],
                'submit_id'    => $quizSubmit->id,
            ]);
        }

        // ✅ Increment module_completed in enroll table if course_id found
        // $courseId = optional(optional(optional($quiz->lesson)->module)->course)->id;

        // if ($courseId) {
        //     Enroll::where('student_id', $student->id)
        //         ->where('course_id', $courseId)
        //         ->increment('module_completed');
        // }

        return response()->json([
            'message'        => 'Quiz submitted successfully',
            'formattedScore' => $formattedScore,
            'score'          => $score,
            'totalPoints'    => $totalPoints,
            'percentage'     => round($percentage, 2),
        ]);
    }

    public function getTopStudents() {
        $topStudents = Quizsubmit::
            with('student')
            ->whereBetween('created_at', [
                Carbon::now()->startOfMonth(),
                Carbon::now()->endOfMonth(),
            ])
            // ->whereHas('quiz', function ($query) {
            //     $query->whereNull('category_id')
            //           ->whereNull('subcategory_id');
            // })
            ->select('student_id')
            ->selectRaw('COUNT(*) as total_attempts')
            ->selectRaw('SUM(totalquestion) as total_questions')
            ->selectRaw('SUM(rightanswer) as total_right_answers')
            ->groupBy('student_id')
            ->orderByDesc('total_right_answers')
            // ->take(10)
            ->get()
            ->map(function ($item, $index)  {
                // use ($defaultImage)
                //  $student = $item->student;
                return [
                    'rank' => $index + 1,
                    'student_id' => $item->student_id,
                    'student' => $item->student,
                    //  'image' => $student->image ? asset($student->image) : $defaultImage,
                    'total_attempts' => (int) $item->total_attempts,
                    'total_questions' => (int) $item->total_questions,
                    'total_right_answers' => (int) $item->total_right_answers,
                ];
            });
        return response()->json($topStudents);
    }


    public function coursecatgeory()
    {
        try {
            $data = Category::with([
                'subcategories' => function ($query) {
                    $query->withCount('courses'); // count courses by subcategory
                },
                'courses' => function ($query) {
                    $query->with([
                        'modules.lessons.videos',
                        'modules.lessons.quizzes'
                    ])
                    ->withCount('review')
                    ->withAvg('review', 'rating');
                }
            ])->get();

            if ($data->isEmpty()) {
                return response()->json([
                    'message' => 'No category data found',
                ], 404);
            }

            // Count quizzes and videos for each course
            foreach ($data as $category) {
                foreach ($category->courses as $course) {
                    $quizCount = 0;
                    $videoCount = 0;

                    foreach ($course->modules as $module) {
                        foreach ($module->lessons as $lesson) {
                            $quizCount += $lesson->quizzes->count();
                            $videoCount += $lesson->videos->count();
                        }
                    }
                    $course->review_avg_rating = $course->review_avg_rating ?? 0;
                    $course->quiz_count = $quizCount;
                    $course->class_count = $videoCount;
                    unset($course->modules);
                }
            }

            return response()->json([
                'message' => 'Data retrieved successfully',
                'data' => $data
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something went wrong',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // 'modules.lessons.quizzes',
    // 'modules.lessons.videos',
    public function subcatgeorywisecourse($id) {
        $data = Course::where('subcategory_id', $id)
            ->with([
                'modules.lessons.pdf_items'
                // 'instructor',
                // 'faqs',
                // 'review.student'
            ])
            // ->withCount([
            //     'review',
            //     'enrolls as enrolled_count'
            // ])
            // ->withAvg('review', 'rating')
            ->get();

        if ($data->isEmpty()) {
            return response()->json([
                'message' => 'No data found',
                'course_count' => 0,
                'data' => []
            ], 404);
        }

        // Count quizzes and videos manually
        // $data->map(function ($course) {
        //     $quizCount = 0;
        //     $videoCount = 0;

        //     foreach ($course->modules as $module) {
        //         foreach ($module->lessons as $lesson) {
        //             $quizCount += $lesson->quizzes->count();
        //             $videoCount += $lesson->videos->count();
        //         }
        //     }
        //     $course->review_avg_rating = $course->review_avg_rating ?? 0;
        //     $course->quiz_count = $quizCount;
        //     $course->class_count = $videoCount;
        //     // Optionally remove heavy nested data
        //     unset(
        //         $course->modules,
        //         $course->instructor,
        //         $course->faqs,
        //         $course->review
        //     );
        //     return $course;
        // });

        return response()->json([
            'message' => 'Data retrieved successfully',
            'courses_count' => $data->count(),
            'courses' => $data
        ], 200);
    }

    public function trendingcourse(){
        $data = Course::where('trending', 1)
            ->with([
                'modules.lessons.videos', // Load videos
                'modules.lessons.quizzes', // Load quizzes
                'instructor',
                'faqs',
                'review.student',

            ])
            ->withCount([
                'review',
                'enrolls as enrolled_count'
            ])
            ->withAvg('review', 'rating')
            ->orderBy('id','desc')
            ->get();

        if ($data->isEmpty()) {
            return response()->json([
                'message' => 'No data found',
            ], 404);
        }

        // Count quizzes and videos manually
        $data->map(function ($course) {
            $quizCount = 0;
            $videoCount = 0;

            foreach ($course->modules as $module) {
                foreach ($module->lessons as $lesson) {
                    $quizCount += $lesson->quizzes->count();
                    $videoCount += $lesson->videos->count();
                }
            }

            $course->quiz_count = $quizCount;
            $course->class_count = $videoCount;
            $course->review_avg_rating = $course->review_avg_rating ?? 0;
                // Optionally remove heavy nested data
            unset(
                $course->modules,
                $course->instructor,
                $course->faqs,
                $course->review
            );
            return $course;
        });

        return response()->json([
            'message' => 'Data retrieved successfully',
            'data' => $data
        ], 200);
    }



public function coursedetails($id)
{
    $student = auth('api')->user();
    if (! $student) {
        return response()->json([
            'message' => 'Unauthorized. Invalid or missing token.',
        ], 401);
    }

    $data = Course::where('id', $id)
        ->with([
            'instructor',
            'modules.lessons.videos',
            'modules.lessons.quizzes.questions.options',
            'faqs',
            'review.student',
            'syllabusFiles'
        ])
        ->withCount([
            'review',
            'enrolls as enrolled_count'
        ])
        ->withAvg('review', 'rating')
        ->get();

    if ($data->isEmpty()) {
        return response()->json([
            'message' => 'No data found',
        ], 404);
    }

    $data->map(function ($course) use ($student) {
        $quizCount = 0;
        $videoCount = 0;

        foreach ($course->modules as $index => $module) {
            foreach ($module->lessons as $lesson) {
                $quizCount += $lesson->quizzes->count();
                $videoCount += $lesson->videos->count();
            }
        }

        $course->quiz_count = $quizCount;
        $course->class_count = $videoCount;
        $course->syllabuslist = $course->syllabusFiles->pluck('file_path');
        unset($course->syllabusFiles);
$course->review_avg_rating = $course->review_avg_rating ?? 0;

        // ✅ Get enrollment info
        $enrollment = \App\Models\Enroll::where('student_id', $student->id)
            ->where('course_id', $course->id)
            ->first();

        $course->already_enrolled = !is_null($enrollment);
        $completedIndex = $enrollment->module_completed ?? 0;
        $course->module_completed = $completedIndex;

        // ✅ Mark each module's completion status
        foreach ($course->modules as $index => $module) {
            $module->completed = ($index + 1) <= $completedIndex;
        }

        return $course;
    });

    return response()->json([
        'message' => 'Data retrieved successfully',
        // 'user' => $student,
        'data' => $data,
    ], 200);
}

  //sliderwisecourse
  public function sliderwisecourse($id){
      $data =   Course::where('id',$id)->with('instructor','modules.lessons.videos','modules.lessons.quizzes.questions.options','faqs','review.student')->get();
               if ($data->isEmpty()) {
            return response()->json([

                'message' => 'No  data found',
            ], 404);
        }
    return response()->json([
        'message' => 'Data retrieved successfully',
      'data' => $data
    ],200);

  }


public function reviewStore(Request $request, $courseId)
{
    $student = auth('api')->user();

    if (! $student) {
        return response()->json([
            'message' => 'Unauthorized. Invalid or missing token.',
        ], 401);
    }

    $request->validate([
        'rating' => 'required|integer|min:1|max:5',
        'review_text' => 'nullable|string|max:1000',
    ]);

    $course = Course::find($courseId);
    if (!$course) {
        return response()->json([
            'message' => 'Course not found'
        ], 404);
    }

    $review = Review::create([
        'student_id' => $student->id,
        'course_id' => $course->id,
        'rating' => $request->rating,
        'review_text' => $request->review_text,
    ]);

    return response()->json([
        'message' => 'Review submitted successfully',
        'review' => $review,
    ], 200);
}

   public function sliders(){
        $data =   Slider::where('status','Active')->get();
               if ($data->isEmpty()) {
            return response()->json([

                'message' => 'No  data found',
            ], 404);
        }
    return response()->json([
        'message' => 'Data retrieved successfully',
      'data' => $data
    ],200);
   }

   public function pages(){
            $data =   Page::where('status',1)->get();
               if ($data->isEmpty()) {
            return response()->json([

                'message' => 'No  data found',
            ], 404);
        }
    return response()->json([
        'message' => 'Data retrieved successfully',
      'data' => $data
    ],200);
   }


public function orderSaveApi(Request $request)
{
    // 1. Get authenticated student
    $student = auth('api')->user();
    if (! $student) {
        return response()->json([
            'message' => 'Unauthorized. Invalid or missing token.',
        ], 401);
    }

    // 2. Validation (removed student_id)
    $validator = Validator::make($request->all(), [
        'total_amount'     => 'required|numeric|min:0',
        'course_price'     => 'required|numeric|min:0',
        'discount_amount'  => 'nullable|numeric|min:0',
        'coupon_code'      => 'nullable|string',
        'course_id'        => 'nullable|integer|exists:courses,id',
        'ebook_id'         => 'nullable|integer|exists:ebooks,id',
        'payment_method'   => 'required|string',
        'note'             => 'nullable|string',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status'  => 'error',
            'message' => 'Validation failed',
            'errors'  => $validator->errors(),
        ], 422);
    }

    // 3. Require either course_id or ebook_id
    if (! $request->filled('course_id') && ! $request->filled('ebook_id')) {
        return response()->json([
            'status'  => 'error',
            'message' => 'Provide either course_id or ebook_id.',
        ], 400);
    }

    $studentId = $student->id;
    $courseId = $request->course_id;
    $ebookId = $request->ebook_id;

    // 4. Check existing enrollment
    if ($request->filled('course_id')) {
        if (Enroll::where('student_id', $studentId)->where('course_id', $courseId)->exists()) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Student is already enrolled in this course.',
            ], 409);
        }
    } else {
        if (Ebookenroll::where('student_id', $studentId)->where('ebook_id', $ebookId)->exists()) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Student is already enrolled in this ebook.',
            ], 409);
        }
    }

    // 5. Create order
    $order = Order::create([
        'student_id'     => $studentId,
        'total'          => $request->total_amount,
        'subtotal'       => $request->course_price,
        'discount'       => $request->discount_amount ?? 0,
        'coupon_code'    => $request->coupon_code,
        'note'           => $request->note,
        'payment_method' => $request->payment_method,
    ]);

    // 6. Create order details
    $details = OrderDetails::create([
        'order_id'   => $order->id,
        'course_id'  => $courseId,
        'ebook_id'   => $ebookId,
        'price'      => $request->total_amount,
    ]);

    // 7. Enrollment & stats
    if ($request->filled('course_id')) {
        Enroll::create([
            'student_id' => $studentId,
            'course_id'  => $courseId,
        ]);

        $course = Course::findOrFail($courseId);
        $comm = ($course->instructor_commision / 100) * $details->price;
        $course->increment('enrolled');
        $course->increment('revenue', $details->price - $comm);
        $course->increment('commision_amount', $comm);
        $course->increment('commision_due', $comm);
        $course->commision_paystatus = null;
        $course->save();
    } else {
        Ebookenroll::create([
            'student_id' => $studentId,
            'ebook_id'   => $ebookId,
        ]);

        $ebook = Ebook::findOrFail($ebookId);
        $ebook->increment('enrolled');
        $ebook->increment('revenue', $details->price);
        $ebook->save();
    }

    // 8. Response
    return response()->json([
        'status'  => 'success',
        'message' => 'Enrollment successful',
        'data'    => [
            'order'         => $order,
            'order_details' => $details,
            'student_id'    => $studentId,
        ],
    ], 201);
}

    public function examscore(){
        $student = auth('api')->user();

        if (! $student) {
            return response()->json([
                'message' => 'Unauthorized. Invalid or missing token.',
            ], 401);
        }

        $quizSubmissions = Quizsubmit::with([
            'quiz:id,name',
            'quiz.questions.options'
            // Load questions and their options ,lesson_id
        ])
        ->where('student_id', $student->id)
        // ->whereHas('quiz', function ($query) {
        //     $query->whereNull('lesson_id');
        // })
        ->select('quiz_id', 'rightanswer', 'totalquestion')
        ->get()
        ->map(function ($submission) {
            $correctAnswers = [];

            foreach ($submission->quiz->questions as $question) {
                $correctOption = $question->options->firstWhere('isAnswer', 1);
                if ($correctOption) {
                    $correctAnswers[] = [
                        'question'        => $question->question, // ✅ show question text
                        'correct_option'  => $correctOption->option,
                    ];
                }
            }

            return [
                'quiz_id'         => $submission->quiz_id,
                'quiz_name'       => $submission->quiz->name ?? 'N/A',
                'rightanswer'     => $submission->rightanswer,
                'totalquestion'   => $submission->totalquestion,
                'correct_answers' => $correctAnswers, // ✅ question + correct option
            ];
        });

        $attemptCount      = $quizSubmissions->count();
        $rightAnswerCount  = $quizSubmissions->where('rightanswer', '>', 0)->count();
        $wrongAnswerCount  = $quizSubmissions->where('rightanswer', '=', 0)->count();
        $totalQuestions    = $quizSubmissions->sum('totalquestion');

        return response()->json([
            'status'  => 'success',
            'message' => 'Data retrieved successfully',
            'data'    => [
                'attempt_count'       => $attemptCount,
                'total_questions'     => $totalQuestions,
                'right_answer_count'  => $rightAnswerCount,
                'wrong_answer_count'  => $wrongAnswerCount,
                'quiz_scores'         => $quizSubmissions,
            ],
        ], 200);
    }

    public function writtenOfSubcatgeory($quizsubcategory_id) {

    }
}
