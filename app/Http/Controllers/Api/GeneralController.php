<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AffiliateClickCount;
use App\Models\Category;
use App\Models\Childcategory;
use App\Models\Childsubcategory;
use App\Models\Coupon;
use App\Models\Course;
use App\Models\RatingReview;
use App\Models\ShareLink;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GeneralController extends Controller {
    public function category() {
        return Category::where('status', 1)->orderBy('name', 'asc')->get();
    }

    public function subcategory($category_id) {
        return Subcategory::where('category_id', $category_id)->where('status', 1)->orderBy('name', 'asc')->get();
    }

    public function childcategory($subcategory_id) {
        return Childcategory::where('subcategory_id', $subcategory_id)->where('status', 1)->orderBy('name', 'asc')->get();
    }

    public function childsubcategory($childcategory_id) {
        return Childsubcategory::where('childcategory_id', $childcategory_id)->where('status', 1)->orderBy('name', 'asc')->get();
    }

    public function details(Request $request, $id) {
        $data           = [];
        $data['course'] = Course::where('id', $id)
            ->with(
                'instructor',
                'category',
                'subcategory',
                'childcategory',
                'childsubcategory',
                'videos',
                'quizzes.quizOptions',
                'written',
                'authors'
                
                
            )
            ->first();
        $data['review'] = RatingReview::where('course_id', $id)->where('status', 1)
            ->with('user')
            ->get();
            
        $data['my_review'] = RatingReview::where('course_id', $id)->where('user_id', $request->user_id)
            ->with('user')
            ->get();
            
        $a_ref = $request->query('a_ref');

        if ($a_ref) {
            $link_owner = ShareLink::where('shareable_link', $a_ref)
                ->where('validity', '>=', today())
                ->where('course_id', $id)
                ->first();

            if ($link_owner) {
                $check = AffiliateClickCount::where('affiliate_id', $link_owner->affiliate_id)->first();

                if ($check) {
                    $check->click = $check->click + 1;
                    $check->save();
                } else {
                    AffiliateClickCount::create([
                        'affiliate_id' => $link_owner->affiliate_id,
                        'click'        => 1,
                    ]);
                }

            } else {
                return response()->json([
                    'status'  => false,
                    'message' => 'Invalid link',
                ]);
            }

            $data['link_owner'] = $link_owner;
        }

        return response()->json([
            'status'  => true,
            'message' => 'Valid link',
            'data'    => $data,
        ]);
    }

    public function offerCourses() {
        return Course::whereNotNull('discount')
            ->with(
                'instructor',
                'category',
                'subcategory',
                'childcategory',
                'childsubcategory',
                'videos',
                'quizzes.quizOptions',
                'written',
                'authors',
                'ratingReview'
            )
            ->paginate();
    }

    public function categoryCourses($category_id, $subcategory_id, $childcategory_id, $childsubcategory_id = null) {

        if (
            $category_id &&
            $subcategory_id &&
            $childcategory_id &&
            $childsubcategory_id
        ) {
            $coursesCollection = Course::where([
                'category_id'         => $category_id,
                'subcategory_id'      => $subcategory_id,
                'childcategory_id'    => $childcategory_id,
                'childsubcategory_id' => $childsubcategory_id,
            ])
                ->with(
                    'instructor',
                    'category',
                    'subcategory',
                    'childcategory',
                    'childsubcategory',
                    'videos',
                    'quizzes.quizOptions',
                    'written',
                    'authors'
                    
                )
                ->get();
        } elseif (
            $category_id &&
            $subcategory_id &&
            $childcategory_id &&
            $childsubcategory_id == null
        ) {
            $coursesCollection = Course::where([
                'category_id'      => $category_id,
                'subcategory_id'   => $subcategory_id,
                'childcategory_id' => $childcategory_id,
            ])
                ->with(
                    'instructor',
                    'category',
                    'subcategory',
                    'childcategory',
                    'childsubcategory',
                    'videos',
                    'quizzes.quizOptions',
                    'written',
                    'authors'
                    
                )
                ->get();
        } else {
            $coursesCollection = [];
        }
        
        foreach ($coursesCollection as $course) {
                    $reviews = RatingReview::where('course_id', $course->id)->where('status', 1)->get();
                    $numReviews = count($reviews);
                    $sumScores = $reviews->sum('rating');
                    $avgScore = $numReviews > 0 ? $sumScores / $numReviews : 0;
                    $avgScore = round($avgScore, 1);
    
                    $courseData = new \stdClass();
                    $courseData->course = $course;
                    $courseData->numReviews = $numReviews;
                    $courseData->avgScore = $avgScore;
    
                    $courses[] = $courseData;
                }

        return response()->json([
            'status'  => true,
            'data'    => $courses,
        ]);

    }

    public function searchCourses(Request $request) {
        $data['search']  = $search  = $request->input('search');
        $coursesCollection = Course::query()
            ->where('name', 'LIKE', "%{$search}%")
            ->orWhere('details', 'LIKE', "%{$search}%")
            ->with(
                'instructor',
                'category',
                'subcategory',
                'childcategory',
                'childsubcategory',
                'videos',
                'quizzes.quizOptions',
                'written',
                'authors',
                'ratingReview'
            )
            ->get();
            
            foreach ($coursesCollection as $course) {
                    $reviews = RatingReview::where('course_id', $course->id)->where('status', 1)->get();
                    $numReviews = count($reviews);
                    $sumScores = $reviews->sum('rating');
                    $avgScore = $numReviews > 0 ? $sumScores / $numReviews : 0;
                    $avgScore = round($avgScore, 1);
    
                    $courseData = new \stdClass();
                    $courseData->course = $course;
                    $courseData->numReviews = $numReviews;
                    $courseData->avgScore = $avgScore;
    
                    $data['courses'] = $courseData;
                }

        return $data;
    }

    public function applyCoupon(Request $request) {
        $coupon_code = $request->coupon_code;

        $check = Coupon::where('coupon_code', $coupon_code)->first();

        if (!$check || $check->coupon_date <= today()) {

            return response()->json([
                'status'  => false,
                'message' => 'Invalid Coupon or Date Has Been Expaired!!',
            ]);

        }

        return response()->json([
            'status'  => true,
            'message' => 'Coupon applyed successfully!!',
            'coupon'  => $check,
        ]);

    }

    public function storeRatingReview(Request $request) {
        DB::beginTransaction();

        try {

            $data = RatingReview::create([
                'user_id'   => Auth::id(),
                'course_id' => $request->course_id,
                'rating'    => $request->rating,
                'review'    => $request->review,
            ]);

            DB::commit();

            return response()->json([
                'status'  => true,
                'message' => 'Your review created successfully!!',
                'data'    => $data->with('user', 'course')->first(),
            ]);
        } catch (\Throwable$th) {
            DB::rollBack();

            return response()->json([
                'status'  => false,
                'message' => $th,
            ]);
        }

    }
    
    public function updateRatingReview(Request $request, $id) {
        DB::beginTransaction();

        try {
            $review = RatingReview::findOrFail($id);
            
            if ($review->user_id !== Auth::id()) {
                return response()->json([
                    'status'  => false,
                    'message' => 'You are not authorized to edit this review',
                ]);
            }
    
            $review->rating = $request->rating;
            $review->review = $request->review;
            $review->save();
        DB::commit();
            return response()->json([
                'status'  => true,
                'message' => 'Your review has been updated successfully!',
                'data'    => $review->with('user', 'course')->first(),
            ]);
            
        } catch (\Throwable$th) {
            DB::rollBack();

            return response()->json([
                'status'  => false,
                'message' => $th,
            ]);
        }
        }
        
        public function deleteRatingReview($id) {
        $review = RatingReview::findOrFail($id);
        if ($review->user_id !== Auth::id()) {
            return response()->json([
                'status'  => false,
                'message' => 'You are not authorized to delete this review',
            ]);
        }
        $review->delete();
    
        return response()->json([
            'status'  => true,
            'message' => 'Your review has been deleted successfully!',
        ]);
    }
    
    public function instructorCourse($id) {
    $courses = Course::where('instructor_id', $id)->where('status', 1)->orderBy('id', 'desc')->paginate(20);

    return response()->json($courses);
}

}
