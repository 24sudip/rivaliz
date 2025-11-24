<?php

namespace App\Http\Controllers;

use App\Models\Childcategory;
use App\Models\Childsubcategory;
use App\Models\{Subcategory, QuizSubCategory};

class GeneralController extends Controller {

    public function subcategory($id) {
        $subcategory = Subcategory::where('category_id', $id)->where('status', 1)->get();

        return json_encode($subcategory);
    }

    public function quizsubcategory($id) {
        $subcategory = QuizSubCategory::where('category_id', $id)->get();

        return json_encode($subcategory);
    }

    public function childcategory($id) {
        $childcategory = Childcategory::where('subcategory_id', $id)->where('status', 1)->get();

        return json_encode($childcategory);
    }

    public function childsubcategory($id) {
        $child = Childsubcategory::where('childcategory_id', $id)->where('status', 1)->get();

        return json_encode($child);
    }
}
