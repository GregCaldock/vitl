<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function search(Request $request): JsonResponse
    {
        /* get the request variables */
        $term = $request->get('term');
        $dupes = $request->get('dupes');

        /* set the initial Person query */
        $people = Person::select('first_name', 'last_name')->orderBy('last_name')->orderBy('first_name');

        /* only search if there's a term to search for */
        if ($term) {
            $people->where('first_name', 'like', "%$term%")->orWhere('last_name', 'like', "%$term%");
        }

        /* de-dupe if required */
        if ($dupes === 'true') {
            $people->distinct();
        }

        /* return the results as JSON */
        return response()->json($people->get());
    }
}
